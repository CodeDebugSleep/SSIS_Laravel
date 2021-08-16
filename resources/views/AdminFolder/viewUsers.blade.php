@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
@include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002 || 2003)
@endif
@section('title') View Users @endsection

@section ('myBody')
@if(Auth::user()->position_id == 2001)
<div class="container">
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>User Account</th>
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
                            <a href = "/users/{{$viewUsers->id}}" class = "btn bg-OwnInfo">View Profile</a>
                            <a class="btn bg-OwnWarning" role="button" id="btnArchive" data_id="{{ $viewUsers->id }}">Archive</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <!-- ADD BUTTON -->
    <div class="float-right">
        <a href="{{ route('users.create') }}" class="btn bg-OwnSuccess">Add New User</a>
    </div>

    <!-- VIEW MODAL -->
    <div id="viewUpdateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="headerModal">Title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/searchPosition" method="get">
                        <label>Fullname: </label>
                        <input type="text" class="form-control" name="name" id="name" disabled>

                        <label>Email: </label>
                        <input type="text" class="form-control" name="email" id="email" disabled>

                        <label>Contact #: </label>
                        <input type="text" class="form-control" name="contact" id="contact" disabled>

                        <label>Position: </label>
                        <select class="form-control" name="position" id="position" disabled>
                            @foreach($users as $viewUsers)
                            <option value="{{$viewUsers->position_id}}">{{$viewUsers->position}}</option>
                            @endforeach
                        </select>

                        <label>Note: </label>
                        <select name="position_note" id="position_note" class="form-control">
                            @foreach($users as $viewUsers)
                            <option value="{{$viewUsers->position_id}}">{{$viewUsers->note}}</option>
                            @endforeach
                        </select>

                        <input type="text" name="id" id="id" style="visibility:hidden">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->position_id == 2002 || 2003)
<div class="jumbotron">
    <h1 class="myError">YOU ARE NOT PERMITTED TO ACCESS THIS PAGE!</h1>
</div>
@endif

@include('AdminFolder.users_script')
@endsection