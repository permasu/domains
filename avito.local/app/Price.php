<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //
    protected $table='Price';
    protected $fillable = [
        'Price',
       'ads_id',
        ];
    public function ads()
    {
        return $this->belongsto('App\Ads');
    }
}
