@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002)
    @include('includes.userNav')
@elseif(Auth::user()->position_id == 2003)
    @include('includes.userNav')
@endif

@section('title')Add New Stock @endsection

@section('myBody')
<div class = "container">
    <div class = "container slide2">
        @include('includes.messages3')
    </div>
    <div class = "row justify-content-center">
        <div class = "col-md-4 jumbotron">
            {!! Form::open(['action' => 'StocksController@store', 'method' => 'POST']) !!}
                <!-- INPUT FOR ITEM NAME -->
                <div class = "form-group">
                    <div class = "row justify-content-center bold size_text">
                        {{Form::label('item_name', $items->item_name)}}
                    </div>
                    

                </div>

                <!-- INPUT FOR ITEM STOCK QUANTITY -->
                <div class = "form-group">
                    {{Form::label('add_subtract_stock', 'Stock Quantity')}}
                    <div class = "row justify-content-center">
                        <div class = "col-md-5">
                            <label for="add">
                                <input type="radio" id="add" name="stock" value = "add" onclick="ShowHideDiv()" />
                                Add
                            </label>
                        </div>
                        <div class = "col-md-5">
                            <label for="subtract">
                                <input type="radio" id="subtract" name="stock" value = "subtract" onclick="ShowHideDiv()" />
                                Subtract
                            </label>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-md-6">
                            <div id = "dvAddStock">
                                {{Form::text('add_stock', '', ['class' => 'form-control', 'placeholder' => 'Add #'])}}
                            </div>
                            <div id = "dvSubStock" style = "display: none">
                                {{Form::text('subtract_stock', '', ['class' => 'form-control', 'placeholder' => 'Subtract #'])}}
                            </div>
                        </div>
                        <div class = "col-md-6">
                            {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Packs/Litre/Canister'])}}
                        </div>
                    </div>
                </div>
                {{Form::text('item_id', $items->id, ['class' => 'form-control', 'style' => 'visibility:hidden'])}}

                {{Form::submit('Submit', ['class' => 'btn bg-OwnSuccess'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
<script>
    function ShowHideDiv() {
        var add = document.getElementById("add");
        var subtract = document.getElementById('subtract');
        dvAddStock.style.display = add.checked ? "block" : "none";
        dvSubStock.style.display = subtract.checked ? "block" : "none";
    }
</script>