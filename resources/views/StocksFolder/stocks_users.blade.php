@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002)
    @include('includes.userNav')
@elseif(Auth::user()->position_id == 2003)
    @include('includes.userNav')
@endif
@section('title') Stocks @endsection

@section ('myBody')
    <div class = "container-fluid">
        <!-- SEARCH BAR -->
    <div class = "col-md-4">
        <form action = "/searchStock" method = "get">
            <div class = "input-group">
                <input type = "search" name = "search" class = "form-control">
                <span class = "input-group-prepend">
                    <button type = "submit" class = "btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    </div>

    <!-- STOCKS TABLE -->
        <table class = "table table-light">
            <thead class = "thead-light">
                <tr>
                    <th>Item</th>
                    <th>Date Restocked</th>
                    <th>Re-stock Quantity</th>
                </tr>
            </thead>
            <tbody>
                @if(count($stocks) > 0)
               <div class = "float-right">
                {{$stocks->links()}}
                </div>
                    @foreach($stocks as $viewStock)
                        <tr id = "record_id_{{$viewStock->id}}">
                            <td>{{$viewStock->items->item_name}}</td>
                            <td>{{\Carbon\Carbon::parse($viewStock->restock_out_date)->format('M d, Y h:i A')}}</td>
                            <td>{{$viewStock->add_stock}} {{$viewStock->subtract_stock}} {{$viewStock->unit}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        


        <!-- ADD MODAL -->
        <div id="addUpdateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="headerModal">Title</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id = "addStockForm">
                            <label>Item: </label>
                            <input type = "text" class = "form-control" name = "item_name" id = "item_name">
                            <select name = "item_id" id = "item_id" class = "form-control">
                                @foreach($items as $viewItem)
                                    <option value = "{{$viewItem->id}}">{{$viewItem->item_name}}</option>
                                @endforeach
                            </select>

                            <label>Item On-hand: </label>
                            <div class = "form-group row">
                                <div class = "col-md-6">
                                    <input type = "number" class = "form-control" name = "item_qty" id = "item_qty">
                                </div>
                                <div class = "col-md-6">
                                    <input type = "text" class = "form-control" name = "unit" id = "unit" placeholder = "Kilo/Litre/Canister">
                                </div>
                            </div>
                            
                            <label>Item Price: </label>
                            <input type = "number" class = "form-control" name = "total_item_price" id = "total_item_price">

                            <label>Perishable State: </label>
                            <select name = "perishable_state" id = "perishable_state" class = "form-control">
                                <option value = "Perishable">Perishable</option>
                                <option value = "Non-Perishable">Non-Perishable</option>
                            </select>

                            <label>Purchase Date: </label>
                            <input type = "date" class = "form-control" name = "purchase_date" id = "purchase_date">

                            <label>Re-order Quantity: </label>
                            <input type = "number" class = "form-control" name = "reorder_qtty" id = "reorder_qtty">

                            <input type = "text" name = "id" id = "id" style = "visibility:hidden">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type = "button" class = "btn bg-OwnWarning" data-dismiss="modal">Close</button>
                        <button type = "button" class = "btn bg-OwnSuccess" id = "btnSave">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection