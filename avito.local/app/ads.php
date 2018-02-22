<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ads extends Model
{
    protected $fillable = [ 'avito_id',
                            'href',
                            'price',
                            'etazh',
                            'maxetazh',
                            'district',
                            'address',
                            'title'];

    //
    public function price()
    {
        return $this->hasMany('App\Price');
    }
}
