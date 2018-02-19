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
            $priceavito =   $array['price'];
            unset($array['price']);
//            $newads = new ads($array);
//
//            $newads->save();
//            $newprice   =   new price();
//            $newprice->ads()->associate($ads);
//            $newprice->price    =   $priceavito;
//            $newprice->save();
        } else {
            $newprice   =   new PriceController();
            $newprice->save($ads,$array['price']);
            //$newprice->save($ads,$array['price']);


            // $ads->fill($array);
            // $ads->save();

           // $price = $ads->price()->get();
//            $findprice  =   $ads->price()->max('id');
//            dd( $findprice);

//            if (count($price) > 0)
//            {
//               // dd($price);
//                if ($price[0]['price'] != $array['price']) {
//                    $newprice   =   new price();
//                    $newprice->ads()->associate($ads);
//                    $newprice->price    =   $array['price'];
//                    $newprice->save();
//                }
//            }
        }

    }

    public function parser()
    {


        $pattern = '/<(article)[^>]*data-item-id=\"(?<avito_id>\d+)\"[^>]*>(?<content>.*?)<\/\1>/su';
        $patternarray['href'] = '/<a href=\"(?<href>.*?)\"/>su';
        $patternarray['title'] = '/<span class=\"header-text\">(?<title>.*?)</su';
        $patternarray['etazh'] = '/<span class=\"nobr\">(?<etazh>.*?)<\/span>.*?/su';
        $patternarray['address'] = '/<span class=\"info-address info-text\">(?<address>.*?)<\/span>/su';
        $patternarray['district'] = '/<span class=\"info-text info-metro-district\">(?<district>.*?)<\/span>/su';
        $patternarray['price'] = '/<span class=\"item-price-value\">(?<price>[0-9].*?)&nbsp/su';
        $patternarray['href'] = '/<a href=\"(?<href>.*?)\"[^>]/su';
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


            if (count($matches["avito_id"]) == 0) return 'Похоже проблемы с парсингом';
            $i = 0;
            foreach ($matches['content'] as $content) {
                preg_match_all($patternarray['price'], $content, $price);
                preg_match_all($patternarray['district'], $content, $district);
                preg_match_all($patternarray['title'], $content, $title);
                preg_match_all($patternarray['address'], $content, $address);
                preg_match_all($patternarray['etazh'], $content, $etazh);
                preg_match_all($patternarray['href'], $content, $href);

                $record['avito_id'] = $matches['avito_id'][$i];
                $record['title'] = count($title['title']) > 0 ? $title['title'][0] : '';
                $record['href'] = count($href['href']) > 0 ? 'http://avito.ru' . $href['href'][0] : '';
                $record['price'] = count($price['price']) > 0 ? str_replace(" ", "", $price['price'][0]) : 0;
                $record['address'] = count($address['address']) > 0 ? $address['address'][0] : '';

                $record['district'] = count($district['district']) > 0 ? $district['district'][0] : '';
                if (count($etazh['etazh']) > 0) {
                    $array1 = explode('/', $etazh['etazh'][0]);
                    $array2 = explode(' ', $array1[1]);
                    $record['etazh'] = $array1[0];
                    $record['maxetazh'] = $array2[0];


                }

                $find = ads::where([ //ищем нет ли уже этого обьявления в базе
                    ['avito_id', '=', $record["avito_id"]],
                ]);
                if ($find->count() == 0) {
                    try {
                        $this->save($record);
                    } catch (Exception $e) {
                        dd($record);
                    }
                } else {

                    $this->save($record);
                }

                $i++;
                unset($record);
            }


            $numberlistint += 1;
            $numberlist = "p=" . (string)$numberlistint . "&";
            sleep(2);


        }

        return 'numberlistint=' . (string)($numberlistint);

    }

    public
    function reprice()
    {
        foreach (ads::all() as $ads_value) {
            $newprice = new price;
            $newprice->price = (int)$ads_value->price;
            $newprice->ads()->associate($ads_value);
            try {
                $newprice->save();
            } catch (Exception $e) {
                $e->getMessage();


            }


        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function index()
    {
        //
        $table = \DB::table('listads')
            ->whereRaw('etazh=maxetazh')
            ->where([
                   // ['price', '>', '2500000'],
                    ['etazh', '>', '3'],
                    ['district', 'not like', '%Кировский%'],
                    ['etazh', '>', '6'],
                    ['district', 'not like', '%Орджоникидзевский%'],
                ]

            )
         //   ->groupBy('ads.id')
            ->orderBy('created_at', 'desc')
            ->orderBy('district')
            ->orderBy('address')
            //->orderby('price')
            ->get();
//        Имя_мое_модели::orderby('id', 'desc')->first();
        return view('table')->with('table', $table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        //
        dd($request->input('request'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
