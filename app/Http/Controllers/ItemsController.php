<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Item;
use App\Itemtype;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('items')
            ->whereNull('deleted_at')
            ->paginate(4);
        $itemtypes = DB::table('itemtypes')->get();

        if(Auth::user()->position_id == 2001) {
            return view('ItemsFolder.items_admin')->with([
                'items' => $items,
                'itemtypes' => $itemtypes
            ]);
        }
        elseif(Auth::user()->position_id == 2002) {
            return view('ItemsFolder.items_kitchen')->with([
                'items' => $items,
                'itemtypes' => $itemtypes
            ]);
        }
        else {
            return view('ItemsFolder.items_inventory')->with([
                'items' => $items,
                'itemtypes' => $itemtypes
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
        if(Auth::user()->position_id == 2002) {
            $itemtypes = [''=>''] + Itemtype::pluck('item_type', 'id')->all();
            return view('ItemsFolder.item_kitchen_create')->with('itemtypes', $itemtypes);
        }
        else {
            $itemtypes = [''=>''] + Itemtype::pluck('item_type', 'id')->all();
            //$itemtypes = Itemtype::pluck('item_type', 'id');
            return view('ItemsFolder.item_inventory_create')->with('itemtypes', $itemtypes);
        }
    }

    public function search(Request $request) 
    {
        $search = $request->get('search');
        $items = DB::table('items')
            ->select('items.*', 'items.id as itemId')
            ->whereNull('deleted_at')
            ->WHERE('item_name', 'like', '%' .$search. '%')->paginate(4);
        $items->appends(['search' => $search]);
        $itemtypes = DB::table('itemtypes')->get();

        if(Auth::user()->position_id == 2002) {
            return view('ItemsFolder.items_stock_search_users')->with([
                'items' => $items,
                'itemtypes' => $itemtypes,
            ]);
        }
        elseif(Auth::user()->position_id == 2003) {
            return view('ItemsFolder.items_stock_search_users')->with([
                'items' => $items,
                'itemtypes' => $itemtypes,
            ]);
        }
        elseif(Auth::user()->position_id == 2001) {
                return view('ItemsFolder.items_stock_search_admin')->with([
                'items' => $items,
                'itemtypes' => $itemtypes,
            ]);
        }


    }

    public function dropdownItems($id)
    {
        $items = DB::table('items')
            ->join('itemtypes', 'itemtypes.id', '=', 'items.item_type_id')
            ->select('items.*', 'itemtypes.*', 'items.id as itemId', 'itemtypes.id as typeId')
            ->whereNull('deleted_at')
            ->where('itemtypes.id', '=', $id)->paginate(4);
        $itemtypes = DB::table('itemtypes')->get();


        if(Auth::user()->position_id == 2002) {
            return view('ItemsFolder.items_stock_search_users')->with([
                'items' => $items,
                'itemtypes' => $itemtypes,
            ]);
        }
        elseif(Auth::user()->position_id == 2003) {
            return view('ItemsFolder.items_stock_search_users')->with([
                'items' => $items,
                'itemtypes' => $itemtypes,
            ]);
        }
        elseif(Auth::user()->position_id == 2001) {
                return view('ItemsFolder.items_stock_search_admin')->with([
                'items' => $items,
                'itemtypes' => $itemtypes,
            ]);
        }
    }

    public function archive($id)
    {
        $items = Item::find($id);
        $items->delete();
    }

    public function archItem()
    {
        $items = DB::table('items')
            ->whereNotNull('deleted_at')
            ->paginate(4);
        
        return view('AdminFolder.itemsArchive')->with('items', $items);
    }

    public function restore($id)
    {
        Item::where('id', $id)->restore();
        return redirect('/viewArchItem');
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
            'type' => 'required',
            'item_name' => ['required','unique:items'],
            'item_price' => 'required',
            'perishable_state' => 'required',
            'dry_wet_state' => 'required',
            'current_stock' => 'required'
       ]);

       $items = new Item;
       $items->item_type_id = $request->input('type');
       $items->item_name = $request->input('item_name');
       $items->item_price = $request->input('item_price');
       $items->perishable_state = $request->input('perishable_state');
       $items->dry_wet_state = $request->input('dry_wet_state');
       $items->user_id = auth()->user()->id;
       if(Auth::user()->position_id == 2002) {
           $items->kitchen_stock = $request->input('current_stock');
       }
       elseif(Auth::user()->position_id == 2003) {
           $items->inventory_stock = $request->input('current_stock');
       }
       
       $items->save();

       return redirect('/items')->with('success', 'Item Added');
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
        $stocks = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'stocks.user_id', '=', 'users.id')
            ->select('items.*', 'items.id AS i_id', 'stocks.*', 'stocks.id AS s_id', 'users.*', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->where([
                ['stocks.item_id', '=', $id],
                ['users.position_id', '=', Auth::user()->position_id]
            ])
            ->whereNotNull('stocks.add_stock')
            ->orderBy('stocks.id')
            ->paginate(5);
        $stocks2 = Stock::join('items', 'stocks.item_id', '=', 'items.id')
            ->join('users', 'stocks.user_id', '=', 'users.id')
            ->select('items.*', 'items.id AS i_id', 'stocks.*', 'stocks.id AS s_id', 'users.*', DB::raw("DATE_FORMAT(stocks.restock_out_date, '%b-%d-%Y %h:%i %p') as formatted_dob"))
            ->where([
                ['stocks.item_id', '=', $id],
            ])
            ->whereNotNull('stocks.add_stock')
            ->orderBy('stocks.id')
            ->paginate(5);
        
        $in = "STOCK IN";
        
        if(Auth::user()->position_id == 2002) {
            return view('ItemsFolder.items_view_users')->with([
                'items' => $items,
                'stocks' => $stocks,
                'in' => $in
            ]);
        }
        elseif(Auth::user()->position_id == 2003) {
            return view('ItemsFolder.items_view_users')->with([
                'items' => $items,
                'stocks' => $stocks,
                'in' => $in
            ]);
        }
        elseif(Auth::user()->position_id == 2001) {
            return view('ItemsFolder.items_view_admin')->with([
                'items' => $items,
                'stocks2' => $stocks2
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Item::find($id);
        $itemtypes = [''=>''] + Itemtype::pluck('item_type', 'id')->all();
        //$itemtypes = Itemtype::pluck('item_type');
        return view('ItemsFolder.item_users_edit')->with(['items' => $items, 'itemtypes' => $itemtypes]);
        //return view('ItemsFolder.item_inventory_edit', compact('items', 'itemtypes'))->with('items', $items);
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
        $this->validate($request, [
            'type' => 'required',
            'item_name' => ['required','unique:items'],
            'item_price' => 'required',
            'perishable_state' => 'required',
            'dry_wet_state' => 'required',
       ]);

       $items = Item::find($id);
       $items->item_type_id = $request->input('type');
       $items->item_name = $request->input('item_name');
       $items->item_price = $request->input('item_price');
       $items->perishable_state = $request->input('perishable_state');
       $items->dry_wet_state = $request->input('dry_wet_state');
       $items->user_id = auth()->user()->id;
       $items->save();

       return redirect('/items')->with('updated', 'Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $items = DB::table('items')
        //     ->find($id)
        //     ->delete();
        $items = DB::table('items')
            ->where('id', '=', $id)->delete();
    }
}
