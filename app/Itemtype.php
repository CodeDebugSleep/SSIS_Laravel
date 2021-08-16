<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemtype extends Model
{
    protected $table = "itemtypes";
    //protected $primaryKey = 'itemtype_pk_id';

    public function items() {
        return $this->hasMany('App\Item');
    }
}
