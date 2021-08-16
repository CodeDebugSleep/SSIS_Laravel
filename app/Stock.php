<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stocks";
    //protected $primaryKey = "stock_pk_id";

    protected $fillable = [
        'item_id',
        'user_id',
        'add_stock',
        'subtract_stock',
        'unit',
        'restock_out_date',
    ];

    protected $dates = [
        'created_at',
        'restock_out_date',
        'updated_at'
    ];

    public function users() {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

    public function items() {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}


