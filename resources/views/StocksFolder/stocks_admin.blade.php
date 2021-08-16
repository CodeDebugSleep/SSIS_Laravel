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
<div class="container-fluid">
    <!-- SEARCH BAR -->
    <div class="col-md-4">
        <form action="/searchStock" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    </div>

    <!-- STOCKS TABLE -->
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Item</th>
                <th>Date Restocked</th>
                <th>Location</th>
                <th>Re-stock Quantity</th>
            </tr>
        </thead>
        <tbody>
            @if(count($stocks2) > 0)
            <div class="float-right">
                {{$stocks2->links()}}
            </div>
            @foreach($stocks2 as $viewStock)
            <tr id="record_id_{{$viewStock->id}}">
                <td>{{$viewStock->items->item_name}}</td>
                <td>{{\Carbon\Carbon::parse($viewStock->restock_out_date)->format('M d, Y h:i A')}}</td>
                <td>
                    @if($viewStock->position_id == 2002)
                    Kitchen
                    @elseif($viewStock->position_id == 2003)
                    Main Branch
                    @endif
                </td>
                <td>{{$viewStock->add_stock}} {{$viewStock->subtract_stock}} {{$viewStock->unit}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection