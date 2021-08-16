@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
@include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002 || 2003)
@endif
@section('title')
View Users
@endsection

@section ('myBody')
@if(Auth::user()->position_id == 2001)
<div class="container">
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Account User</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
            @foreach($users as $viewUsers)
            <tr id="record_id_{{$viewUsers->id}}">
                <td>{{$viewUsers->name}}</td>
                <td>{{$viewUsers->position}}</td>
                <td>
                    <form action = "/restoreUser" method = "get">
                        <a class = "btn bg-OwnWarning" role = "button" id = "btnRestore" data_id="{{ $viewUsers->id }}">Restore</a>
                        <a class="btn bg-OwnDanger" role="button" id="btnDelete" data_id="{{ $viewUsers->id }}">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@elseif(Auth::user()->position_id == 2002 || 2003)
<div class="jumbotron">
    <h1 class="myError">YOU ARE NOT PERMITTED TO ACCESS THIS PAGE!</h1>
</div>
@endif

@include('AdminFolder.users_script')
@endsection