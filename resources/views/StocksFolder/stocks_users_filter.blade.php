@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002)
    @include('includes.userNav')
@elseif(Auth::user()->position_id == 2003)
    @include('includes.userNav')
@endif

@section('title')View Item @endsection

@section('myBody')
<div class = "container-fluid">
    <div class = "container slide2">
        @include('includes.messages')
    </div>

    <div class = "row justify-content-center">
        <div class = "col-md-3">
            <div class="card">
                <div class="card-header">
                    ITEM INFORMATION
                </div>
                <div class="card-body">
                    <p class="card-text"><b>Type: </b>{{$items->itemtypes->item_type}}</p>
                    <p class="card-text"><b>Item Name: </b>{{$items->item_name}}</p>
                    <p class="card-text">
                        <b>Item Price: </b>
                        Php {{number_format ($items->item_price, 2)}}
                        @if($items->item_type_id == 6001)
                            @if($items->id == 4004)
                                Per Pack
                            @else
                                Per Kilo
                            @endif
                        @elseif($items->item_type_id == 6002)
                            Per Canister
                        @elseif($items->item_type_id == 6003)
                            Per Piece
                        @endif
                    </p>
                    <p class="card-text">
                        <b>Current Stock: </b>
                        @if(Auth::user()->position_id == 2002)
                            {{$items->kitchen_stock}}
                            @if($items->item_type_id == 6001)
                                @if($items->id == 4004)
                                    Packs
                                @elseif($items->id == 4020)
                                    Bottles
                                @else
                                    Kilos
                                @endif
                            @elseif($items->item_type_id == 6002)
                                Canisters
                            @elseif($items->item_type_id == 6003)
                                Pieces
                            @endif
                        @elseif(Auth::user()->position_id == 2003)
                            {{$items->inventory_stock}}
                            @if($items->item_type_id == 6001)
                                @if($items->id == 4004)
                                    Packs
                                @elseif($items->id == 4020)
                                    Bottles
                                @else
                                    Kilos
                                @endif
                            @elseif($items->item_type_id == 6002)
                                Canisters
                            @elseif($items->item_type_id == 6003)
                                Pieces
                            @endif
                        @endif
                    </p>
                    
                    
                    <!-- PERISHABLE OR NON-PERISHABLE -->
                    @if($items->perishable_state == "perishable")
                        <!-- DRY OR WET STATE -->
                        @if($items->dry_wet_state == "dry")
                            <p class="card-text"><b>State: </b> Perishable - Dry</p>
                            <p class = "indent bold">Note: 
                                <p class = "indent2 bold2">PLEASE DISCARD AFTER 3 DAYS</p>
                            </p>
                            <p class = "indent2 bold2">KEEP IT IN DRY AREA/SHELVES</p>
                        @elseif($items->dry_wet_state == "wet")
                            <p class="card-text"><b>State: </b> Perishable - Wet</p>
                            <p class = "indent bold">Note: 
                                <p class = "indent2 bold2">PLEASE DISCARD AFTER 5 DAYS</p>
                            </p>
                            <p class = "indent2 bold2">KEEP IN REFRIGERATOR</p>
                        @endif
                    @elseif($items->perishable_state == "non-perishable")
                        <p class="card-text"><b>State: </b> Non-Perishable</p>
                    @endif

                </div>
            </div>
        </div>
        <div class = "col-md-8">
            <div class = "row">
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <select name = "in_out" id = "in_out" class = "form-control filter-select" type = "dropdown-toggle" onchange = "top.location.href = this.options[this.selectedIndex].value">
                                    <option selected disabled>--select filter--</option>
                                    <option class = "types" value = "{{ route('stocks.filter_in', $items->id) }}">All</option>
                                    <option value = "{{ route('items.show', $items->id) }}">Stock In</option>
                                    <option class = "types" value = "{{ route("stocks.filter_out", $items->id) }}">Stock Out</option>
                                </select> 
                            </th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th>Discard Date</th>
                            <th>Updated By</th>
                            <th>Status</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($stocks) > 0)
                <div class = "float-right">
                    {{$stocks->links()}}
                    </div>
                            @foreach($stocks as $viewStock)
                                <tr>
                                    <td>{{$viewStock->formatted_dob}}</td>
                                    <td>
                                        @if($viewStock->subtract_stock == null)
                                            @if($viewStock->items->perishable_state == "perishable")
                                                <!-- DRY OR WET STATE -->
                                                @if($viewStock->items->dry_wet_state == "dry")
                                                    {{\Carbon\Carbon::parse($viewStock->restock_out_date)->addDays(3)->format('M-d-Y h:i A')}}
                                                @elseif($viewStock->items->dry_wet_state == "wet")
                                                    {{\Carbon\Carbon::parse($viewStock->restock_out_date)->addDays(5)->format('M-d-Y h:i A')}}
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{$viewStock->users->name}}</td>
                                    <td>
                                        @if($viewStock->add_stock == null)
                                            STOCK OUT
                                        @else
                                            STOCK IN
                                        @endif
                                    </td>
                                    <td>{{$viewStock->add_stock}} {{$viewStock->subtract_stock}} {{$viewStock->unit}}</td>
                                </tr>
                            @endforeach
                    @endif
                </tbody>
                </table>
            </div>
        </div>

            <!-- ADD NEW ITEM -->
        <div class = "container-fluid" style = "margin-top: 3%">
            <div class = "float-right">
                <a href = "/items/{{$items->id}}/addStock" class = "btn bg-OwnSuccess">Update Stock</a>
            </div>
        </div>
    </div>
</div>
@endsection