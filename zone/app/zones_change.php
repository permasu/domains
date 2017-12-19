<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class zones_change extends Model
{
    //
    protected $table="zones_change";
    protected $primaryKey='Number';
    protected $fillable = ['Zone', 'Def', 'Number'];
}
