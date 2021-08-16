@extends('masterlayout')
@if(Auth::user()->postion_id == 2001)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002 || 2003)
    @include('includes.userNav')
@endif

@section('title')Add New Item @endsection

@section('myBody')
<div class = "container">
    <div class = "container slide2">
        @include('includes.messages')
    </div>
    <div class = "row justify-content-center">
        <div class = "col-md-12 jumbotron">
        <h3 class = "myError">ADD FORM</h3>
            {!! Form::open(['action' => 'ItemsController@store', 'method' => 'POST']) !!}
            <div class = "row">
                <div class = "col-md-6">
                    <!-- INPUT FOR ITEM TYPE -->
                    <div class = "form-group">
                        {{Form::label('type', 'Type')}}
                        {{Form::select('type', $itemtypes, '', ['class' => 'form-control'])}}

                    </div>

                    <!-- INPUT FOR ITEM NAME -->
                    <div class = "form-group">
                        {{Form::label('item_name', 'Item Name')}}
                        {{Form::text('item_name', '', ['class' => 'form-control', 'placeholder' => 'Onion'])}}
                    </div>

                    <!-- INPUT FOR ITEM PRICE -->
                    <div class = "form-group">
                        {{Form::label('item_price', 'Price')}}
                        {{Form::text('item_price', '', ['class' => 'form-control', 'placeholder' => '25.25'])}}
                    </div>
                </div>

                <div class = "col-md-6">
                    <!-- INPUT FOR STATE -->
                    <div class = "form-group">
                        {{Form::label('perishable_state', 'Perishable State')}}
                        {{Form::select('perishable_state', ['perishable' => 'Perishable', 'non-perishable' => 'Non-Perishable'], '', ['class' => 'form-control'])}}
                    </div>

                    <!-- INPUT FOR DRY OR WET STATE -->
                    <div class = "form-group">
                        {{Form::label('dry_wet_state', 'State')}}
                        {{Form::select('dry_wet_state', ['dry' => 'Dry Goods', 'wet' => 'Wet Goods', 'none' => 'N/A'], '', ['class' => 'form-control'])}}
                    </div>

                    <!-- INPUT FOR CURRENT STOCK -->
                    <div class = "form-group">
                        {{Form::label('current_stock', 'Current Stock')}}
                        {{Form::text('current_stock', '', ['class' => 'form-control', 'placeholder' => '5'])}}
                    </div>
                </div>
            </div>
            <div class = "row justify-content-center">
                {{Form::submit('Submit', ['class' => 'btn bg-OwnSuccess'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection