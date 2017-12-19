<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\zones_change;

class zonesController extends Controller
{

    public function index()
    {
        //
        return zones_change::all();
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $zone   =   zones_change::create($request->all());
        return $zone;
    }


    public function show($Number)
    {
        //
        return zones_change::findOrFail($Number);
    }


    public function edit($Number)
    {
        //
    }


    public function update(Request $request, $Number)
    {

        $zone   =   zones_change::findOrFail($Number);
        $zone->update($request->all());
    }


    public function destroy($Number)
    {
        //
        $zone   =   zones_change::findOrFail($Number);
        $zone->delete();
        return '';
    }
}
