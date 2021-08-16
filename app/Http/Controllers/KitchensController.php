<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Item;
use App\Itemtype;
use App\Position;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitchensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::whereNull('deleted_at')->paginate(5);
        $stocks = Stock::get();
        $num = Stock::groupBy('item_id')
            ->sum('add_stock');
        $positions = Position::get();
        $itemtypes = Itemtype::get();
        return view('AdminFolder.reports_kitchen')->with([
            'items' => $items,
            'positions' => $positions,
            'itemtypes' => $itemtypes,
            'stocks' => $stocks,
            'num' => $num
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Item::find($id);
        $itemtypes = Itemtype::get();
        $stocksJanuary = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '01')
            ->sum('add_stock');
        $stocksFebruary = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '02')
            ->sum('add_stock');
        $stocksMarch = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '03')
            ->sum('add_stock');
        $stocksApril = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '04')
            ->sum('add_stock');
        $stocksMay = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '05')
            ->sum('add_stock');
        $stocksJune = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '06')
            ->sum('add_stock');
        $stocksJuly = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '07')
            ->sum('add_stock');
        $stocksAugust = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '08')
            ->sum('add_stock');
        $stocksSeptember = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '09')
            ->sum('add_stock');
        $stocksOctober = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '10')
            ->sum('add_stock');
        $stocksNovember = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '11')
            ->sum('add_stock');
        $stocksDecember = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereMonth('restock_out_date', '=', '12')
            ->sum('add_stock');
        
        $Jan = date('2021-01-01');
        $March = date('2021-03-31'); 
        $quarter1 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereBetween('restock_out_date', [$Jan, $March])
            ->sum('add_stock');
        
        $April = date('2021-04-01');
        $June = date('2021-06-30'); 
        $quarter2 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereBetween('restock_out_date', [$April, $June])
            ->sum('add_stock');

        $July = date('2021-07-01');
        $Sept = date('2021-09-30'); 
        $quarter3 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereBetween('restock_out_date', [$July, $Sept])
            ->sum('add_stock');

        $Oct = date('2021-10-01');
        $Dec = date('2021-12-31'); 
        $quarter4 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereBetween('restock_out_date', [$Oct, $Dec])
            ->sum('add_stock');
        
        $sem1 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereBetween('restock_out_date', [$Jan, $June])
            ->sum('add_stock');
        
        $sem2 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', '=', 'stocks.user_id')
            ->select('items.*', 'stocks.*', 'users.*')
            ->where([
                ['item_id', '=', $id],
                ['users.position_id', '=', 2002]
            ])
            ->whereBetween('restock_out_date', [$July, $Dec])
            ->sum('add_stock');

        
        return view('AdminFolder.reports_kitchen')->with([
            'items' => $items,
            'itemtypes' => $itemtypes,
            'stocksJanuary' => $stocksJanuary,
            'stocksFebruary' => $stocksFebruary,
            'stocksMarch' => $stocksMarch,
            'stocksApril' => $stocksApril,
            'stocksMay' => $stocksMay,
            'stocksJune' => $stocksJune,
            'stocksJuly' => $stocksJuly,
            'stocksAugust' => $stocksAugust,
            'stocksSeptember' => $stocksSeptember,
            'stocksOctober' => $stocksOctober,
            'stocksNovember' => $stocksNovember,
            'stocksDecember' => $stocksDecember,
            'quarter1' => $quarter1,
            'quarter2' => $quarter2,
            'quarter3' => $quarter3,
            'quarter4' => $quarter4,
            'sem1' => $sem1,
            'sem2' => $sem2
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dropdownItems($id)
    {
        $items = Item::join('itemtypes', 'itemtypes.id', '=', 'items.item_type_id')
            ->select('items.*', 'itemtypes.*')
            ->whereNull('deleted_at')
            ->where('itemtypes.id', '=', $id)->paginate(5);
        $itemtypes = Itemtype::get();
        $stocks = Stock::get();

        return view('AdminFolder.kitchen_filter_types')->with([
            'items' => $items,
            'itemtypes' => $itemtypes,
            'stocks' => $stocks
        ]);
    }
}
