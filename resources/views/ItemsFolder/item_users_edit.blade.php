@extends('masterlayout')
@if(Auth::user()->postion_id == 2001)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002 || 2003)
    @include('includes.userNav')
@endif

@section('title')Edit New Item @endsection

@section('myBody')
<div class = "container">
    <div class = "container slide2">
        @include('includes.messages')
    </div>
    <div class = "row justify-content-center">
        <h3 class = "myError">EDIT FORM</h3>
        <div class = "col-md-12 jumbotron">
            {!! Form::open(['action' => ['ItemsController@update', $items->id], 'method' => 'POST']) !!}
                <!-- EDIT ITEM TYPE -->
                <div class = "row">
                    <div class = "col-md-6">
                        <!-- INPUT FOR ITEM TYPE -->
                        <div class = "form-group">
                            {{Form::label('type', 'Type')}}
                            {{Form::select('type', $itemtypes, $items->itemtypes->id, ['class' => 'form-control'])}}
                        </div>
                

                        <!-- EDIT ITEM NAME -->
                        <div class = "form-group">
                            {{Form::label('item_name', 'Item Name')}}
                            {{Form::text('item_name', $items->item_name, ['class' => 'form-control'])}}
                        </div>

                        <!-- EDIT ITEM PRICE -->
                        <div class = "form-group">
                            {{Form::label('item_price', 'Price')}}
                            {{Form::text('item_price', $items->item_price, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class = "col-md-6">

                        <!-- EDIT FOR STATE -->
                        <div class = "form-group">
                            {{Form::label('perishable_state', 'Perishable State')}}
                            {{Form::select('perishable_state', ['perishable' => 'Perishable', 'non-perishable' => 'Non-Perishable'], $items->perishable_state, ['class' => 'form-control'])}}
                        </div>

                        <!-- EDIT FOR DRY OR WET STATE -->
                        <div class = "form-group">
                            {{Form::label('dry_wet_state', 'State')}}
                            {{Form::select('dry_wet_state', ['dry' => 'Dry Goods', 'wet' => 'Wet Goods', 'none' => 'N/A'], $items->dry_wet_state, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <div class = "row justify-content-center">
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Submit', ['class' => 'btn bg-OwnSuccess float-right'])}}
                </div>
            {!! Form::close() !!}
    </div>
</div>
@endsection