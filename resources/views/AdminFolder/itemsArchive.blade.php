@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
@include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002 || 2003)
@include('includes.userNav')
@endif
@section('title')Items @endsection

@section('myBody')
<div class="container">

    <!-- SEARCH BAR -->
    <div class="col-md-4">
        <form action="/searchItem" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    </div>


    <!-- ITEMS TABLE -->
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Item</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($items) > 0)
            <div class="float-right">
                {{$items->links()}}
            </div>
            @foreach($items as $viewItem)
            <tr id="record_id_{{$viewItem->id}}">
                <td>{{$viewItem->item_name}}</td>
                <td>
                    <form action="/restoreItem" method="get">
                        <a class = "btn bg-OwnWarning" role = "button" id = "btnRestore" data_id="{{ $viewItem->id }}">Restore</a>
                        <a class="btn bg-OwnDanger" role="button" id="btnDelete" data_id="{{ $viewItem->id }}">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
@include('ItemsFolder.items_script')