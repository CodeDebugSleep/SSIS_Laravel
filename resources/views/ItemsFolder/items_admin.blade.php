@extends('masterlayout')
@if(Auth::user()->postion_id == 2002 || 2003)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2001)
    @include('includes.userNav')
@endif

@section('title')Items @endsection

@section('myBody')
<div class = "container">
    <div class = "container slide2">
        @include('includes.messages')
    </div>
    <!-- SEARCH BAR -->
    <div class = "row">
        <div class = "col-md-4">
            <form action = "/searchItem" method = "get">
                <div class = "input-group">
                    <input type = "search" name = "search" class = "form-control">
                    <span class = "input-group-prepend">
                        <button type = "submit" class = "btn bg-OwnInfo">Search</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- DROPDOWN LIST OF ITEMS -->
        <div class = "col-md-4">
            <div class = "form-group row">
                <select name = "types" id = "types" class = "form-control filter-select" type = "dropdown-toggle" onchange="top.location.href = this.options[this.selectedIndex].value">
                    <option selected disabled>--select filter--</option>
                    <option value = "{{ route('items.index')}}">All</option>
                    @foreach($itemtypes as $viewTypes)
                        <option class = "types" value = "{{ route("items.filter", $viewTypes->id) }}">{{$viewTypes->item_type}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- TABLE OF ITEMS -->
    <table class = "table table-light">
        <thead class = "thead-light">
            <tr>
                <th>Item</th>
                <th>Actions</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($items) > 0)
                <div class = "float-right">
                    {{$items->links()}}
                </div>

                @foreach($items as $viewItem)
                    <tr id="record_id_{{$viewItem->id}}">
                        <td>{{$viewItem->item_name}}</td>
                        <td>
                            <a href = "/items/{{$viewItem->id}}" class = "btn bg-OwnInfo">View</a>
                        </td>
                        <td>
                             <a class="btn bg-OwnWarning" role="button" id="btnArchive" data_id="{{ $viewItem->id }}">Archive</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@include('ItemsFolder.items_script')
@endsection