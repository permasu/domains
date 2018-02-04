<?php

namespace App\Http\Controllers;

use App\ads;
use Illuminate\Http\Request;
use App\Price;
use Mockery\Exception;

class adscontroller extends Controller
{
    public function save(array $array)
    {
        $ads = ads::where('avito_id', $array['avito_id'])->first();
        if (!$ads) {

            $newads = new ads($array);

            $newads->save();
        }

    }

    public function parser()
    {


        /*  $pattern = "'<article.{0,10} class=\"(b-item js-catalog-item-enum |b-item js-catalog-item-enum item-highlight)\".{0,10}" .
              "data-item-id=\"(?<avito_id>.{7,10})\".{1,1000} <a href=\"(?<href>.*?)\".{1,1000}" .
              " <span class=\"header-text\">(?<title>.*?)<span class=\"nobr\">" .
              "(?<etazh>.*?)</span>.{1,1000}" .
              " <span class=\"item-price-value\">(?<price>.*?)</span>.{1,1000}" .
              "<span class=\"info-text info-metro-district\">(?<district>.{,30}?)</span>.{1,1000}" .
              "<span class=\"info-address info-text\">(?<address>.*?)</span>" .
              "'si";*/

        $pattern = "'<article.{0,10} class=\"(b-item js-catalog-item-enum |b-item js-catalog-item-enum item-highlight)\".{0,10}" .
            "data-item-id=\"(?<avito_id>.{7,10})\".{1,1000} <a href=\"(?<href>.*?)\".{1,1000}" .
            " <span class=\"header-text\">(?<title>.*?)<span class=\"nobr\">" .
            "(?<etazh>.*?)</span>.{1,1000}" .
            " <span class=\"item-price-value\">(?<price>.{1,300})</span>.{1,100}" .
            "<span class=\"info-text info-metro-district\">(?<district>.{1,300})</span>.{1,15}" .
            "<span class=\"info-address info-text\">(?<address>.*?)</span>" .
            "'si";

        ini_set('max_execution_time', 900);
        $flag = true;
        $numberlist = "";
        $numberlistint = 1;

        while ($flag) {
            $avitolink = '';
            $avitolink = 'https://m.avito.ru/perm/kvartiry/prodam?' . $numberlist . 'f=549_5697-5698.59_13990b';
            $ch = curl_init($avitolink);

            $headers = array('Content-type: text/html; charset=utf-8');
            $ch = curl_init($avitolink);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (!$result) {
                $flag = false;
                dd($avitolink);
            }
            curl_close($ch);
            preg_match_all($pattern, $result, $matches);

//dd($matches);

            unset($matches[0]);
            if (count($matches["avito_id"]) == 0) return 'Похоже проблемы с парсингом';
            for ($i = 0; $i < count($matches["avito_id"]); $i++) {

                $matches["price"][$i] = preg_replace('/[^\d]+/', '', strip_tags($matches["price"][$i]));
                $array1 = array(2);
                $array2 = array(2);
                $array1 = explode('/', $matches["etazh"][$i]);
                $array2 = explode(' ', $array1[1]);
                $matches["etazh"][$i] = $array1[0];
                $matches["sumetazh"][$i] = $array2[0];
                $matches["href"][$i] = "http://avito.ru" . $matches["href"][$i];

                $find = ads::where([ //ищем нет ли уже этого обьявления в базе
                    ['avito_id', '=', $matches["avito_id"][$i]],
                ]);
                if ($find->count() == 0) {

                    try {
                        $this->save(array(
                            "avito_id" => $matches["avito_id"][$i],
                            "href" => $matches["href"][$i],
                            "etazh" => $matches["etazh"][$i],
                            "maxetazh" => $matches["sumetazh"][$i],
                            "price" => $matches["price"][$i] != '' ? $matches["price"][$i] : 0,
                            "district" => $matches["district"][$i],
                            "address" => $matches["address"][$i],
                            "title" => $matches["title"][$i]


                        ));
                    } catch (Exception $e) {
                        dd($matches);
                    }

                }
            };

            $numberlistint += 1;
            $numberlist = "p=" . (string)$numberlistint . "&";
            sleep(2);


        }
        return 'numberlistint=' . string($numberlistint);

    }

    public function reprice()
    {
        foreach (ads::all() as $ads_value) {
            $newprice = new price;
            $newprice->price = (int) $ads_value->price;
            $newprice->ads()->associate($ads_value);
            try {
                $newprice->save();
            }catch (Exception $e){
                $e->getMessage();


            }




        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $table = \DB::table('ads')
            ->select('*')
            //   ->whereRaw('etazh=maxetazh-1')
            ->whereRaw('etazh=maxetazh')
            ->where([
                    ['price', '>', '2500000'],
                    ['etazh', '>', '3'],
                    ['district', 'not like', '%Кировский%'],
                    ['etazh', '>', '6'],
                    ['district', 'not like', '%Орджоникидзевский%'],
                ]

            )
            ->orderBy('created_at', 'desc')
            ->orderBy('district')
            ->orderBy('address')
            ->orderby('price')
            ->get();

        return view('table')->with('table', $table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
