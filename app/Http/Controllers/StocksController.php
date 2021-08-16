<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Item;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $stocks = Stock::join('users', 'users.id', 'stocks.user_id')
            ->join('items', 'stocks.item_id', '=', 'items.id')
            ->select('users.*', 'items.*', 'stocks.*')
            ->whereNotNull('stocks.add_stock')
            ->where('users.position_id', '=', Auth::user()->position_id)
            ->paginate(4);

        $stocks2 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'users.id', 'stocks.user_id')
            ->select('items.*', 'users.*', 'items.id AS i_id', 'stocks.*', 'stocks.id AS s_id', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->whereNotNull('stocks.add_stock')
            ->orderBy('stocks.id')
            ->paginate(5);


        //$outDate = $inDate->addDays(3);

        $items = Item::get();
        
        if(Auth::user()->position_id == 2001) {
            return view('StocksFolder.stocks_admin')-> with([
                'items' => $items,
                'stocks2' => $stocks2,
            ]);
        }
        elseif(Auth::user()->position_id == 2002) {
            return view('StocksFolder.stocks_users')-> with([
                'items' => $items,
                'stocks' => $stocks,
            ]);
        }
        elseif(Auth::user()->position_id == 2003) {
            return view('StocksFolder.stocks_users')-> with([
                'items' => $items,
                'stocks' => $stocks
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $items = [''=>''] + Item::pluck('item_name', 'id')->all();
        // return view('StocksFolder.stocks_users_create')->with('items', $items);
    }

    public function addStock($id)
    {
         $items = Item::find($id);
         return view('StocksFolder.stocks_users_create')->with('items', $items);
    }

    public function search(Request $request)
    {
       
    }

    public function dropdownIn($id)
    {
        $items = Item::find($id);
        $stocks = Stock::join('users', 'users.id', '=', 'stocks.user_id')
            ->select('stocks.*', 'users.*', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->where([
                ['stocks.item_id', '=', $id],
                ['users.position_id', '=', Auth::user()->position_id]
                ])
            ->paginate(4);
        $stocks2 = Stock::join('users', 'users.id', '=', 'stocks.user_id')
            ->select('stocks.*', 'users.*', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->where([
                ['stocks.item_id', '=', $id],
                ])
            ->paginate(4);
        $out = "ALL";
        if(Auth::user()->position_id == 2001) {
            return view('StocksFolder.stocks_admin_filter')->with([
                'items' => $items,
                'stocks2' => $stocks2,
                'out' => $out
            ]);
        }
        elseif(Auth::user()->position_id == 2002) {
            return view('StocksFolder.stocks_users_filter')->with([
                'items' => $items,
                'stocks' => $stocks,
                'out' => $out
            ]);
        }
        elseif(Auth::user()->position_id == 2003) {
            return view('StocksFolder.stocks_users_filter')->with([
                'items' => $items,
                'stocks' => $stocks,
                'out' => $out
            ]);
        }
    }

    public function dropdownOut($id)
    {
        $items = Item::find($id);
        $stocks = Stock::join('users', 'users.id', '=', 'stocks.user_id')
            ->select('stocks.*', 'users.*', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->whereNotNull('stocks.subtract_stock')
            ->where([
                ['stocks.item_id', '=', $id],
                ['users.position_id', '=', Auth::user()->position_id]
                ])
            ->paginate(4);
        $stocks2 = Stock::join('users', 'users.id', '=', 'stocks.user_id')
            ->select('stocks.*', 'users.*', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->where([
                ['stocks.item_id', '=', $id],
                ])
            ->whereNotNull('stocks.subtract_stock')
            ->paginate(4);
        $out = "STOCK OUT";
        if(Auth::user()->position_id == 2001) {
            return view('StocksFolder.stocks_admin_filter')->with([
                'items' => $items,
                'stocks2' => $stocks2,
                'out' => $out
            ]);
        }
        elseif(Auth::user()->position_id == 2002) {
            return view('StocksFolder.stocks_users_filter')->with([
                'items' => $items,
                'stocks' => $stocks,
                'out' => $out
            ]);
        }
        elseif(Auth::user()->position_id == 2003) {
            return view('StocksFolder.stocks_users_filter')->with([
                'items' => $items,
                'stocks' => $stocks,
                'out' => $out
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required',
            'unit' => 'required'
        ]);

        $update_item = $request->input('item_id');
        $add = $request->input('add_stock');
        $sub = $request->input('subtract_stock');

        $stocks = new Stock;
        $stocks->item_id = $request->input('item_id');
        $stocks->user_id = auth()->user()->id;
        if($request->input('stock') == "add") {
            $stocks->add_stock = $request->input('add_stock');
        }
        elseif($request->input('stock') == "subtract") {
            $stocks->subtract_stock = $request->input('subtract_stock');
        }
        $stocks->unit = $request->input('unit');
        $stocks->save();

        $items = Item::find($update_item);
        if(Auth::user()->position_id == 2002) {
            if($request->input('stock') == "add") {
                $items->kitchen_stock += $add;
            }
            elseif($request->input('stock') == "subtract") {
                $items->kitchen_stock -= $sub;
            }
        }
        elseif(Auth::user()->position_id == 2003) {
            if($request->input('stock') == "add") {
                $items->inventory_stock += $add;
            }
            elseif($request->input('stock') == "subtract") {
                $items->inventory_stock -= $sub;
            }
        }
            
        
        $items->save();

        return redirect('/stocks')->with('success', 'Stocks Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }
}
