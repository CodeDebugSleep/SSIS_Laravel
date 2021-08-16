@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
    @include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002)
    @include('includes.userNav')
@elseif(Auth::user()->position_id == 2003)
    @include('includes.userNav')
@endif

@section('title')Items @endsection

@section('myBody')
<div class = "container-fluid">
    <div class = "container slide2">
        @include('includes.messages')
    </div>

    <div class = "row justify-content-center">
        <h1>{{$items->item_name}} Stock Report</h1>
    </div>

    <!-- MONTHS -->
    <table class = "table table-light">
        <thead class = "thead-light">
            <tr>
                <th>MONTHLY</th>
            </tr>
            <tr>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
            </tr>
        </thead>
        <tbody>
            <td>{{$stocksJanuary}}</td>
            <td>{{$stocksFebruary}}</td>
            <td>{{$stocksMarch}}</td>
            <td>{{$stocksApril}}</td>
            <td>{{$stocksMay}}</td>
            <td>{{$stocksJune}}</td>
            <td>{{$stocksJuly}}</td>
            <td>{{$stocksAugust}}</td>
            <td>{{$stocksSeptember}}</td>
            <td>{{$stocksOctober}}</td>
            <td>{{$stocksNovember}}</td>
            <td>{{$stocksDecember}}</td>
        </tbody>
    </table>

    <!-- QUARTERLY -->
    <table class = "table table-light">
        <thead class = "thead-light">
            <tr>
                <th>QUARTERLY</th>
            </tr>
            <tr>
                <th>January - March</th>
                <th>April - June</th>
                <th>July - September</th>
                <th>October - December</th>
            </tr>
        </thead>
        <tbody>
            <td>{{$quarter1}}</td>
            <td>{{$quarter2}}</td>
            <td>{{$quarter3}}</td>
            <td>{{$quarter4}}</td>
        </tbody>
    </table>

    <!-- SEMESTER -->
    <table class = "table table-light">
        <thead class = "thead-light">
            <tr>
                <th>SEMESTRAL</th>
            </tr>
            <tr>
                <th>January - June</th>
                <th>July - September</th>
            </tr>
        </thead>
        <tbody>
            <td>{{$sem1}}</td>
            <td>{{$sem2}}</td>
        </tbody>
    </table>
    
</div>
@endsection