<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $table = "items";
    //protected $primaryKey = "item_pk_id";

    protected $fillable = [
        'item_name',
        'item_type_id',
        'user_id',
        'item_price',
        'perishable_state',
        'dry_wet_state',
        'kitchen_stock',
        'inventory_stock'
    ];

    public function stocks() {
        return $this->hasMany('App\Stock');
    }

    public function itemtypes() {
        return $this->belongsTo('App\Itemtype', 'item_type_id');
    }

    public function users() {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }
}
