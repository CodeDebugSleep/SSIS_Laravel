@extends('masterlayout')
@if(Auth::user()->position_id == 2001)
@include('includes.adminNav')
@elseif(Auth::user()->position_id == 2002 || 2003)
@include('includes.userNav')
@endif
@section('title') View Users @endsection

@section ('myBody')
<link rel="stylesheet" href="{{URL::asset('css/bootstrap2.css')}}">

<div class="card">
  <img src="{{$users->picture_url}}" alt="{{$users->name}}" width = "100%" >
  <h1 class = "profile-text">{{$users->name}}</h1>
  <p class="contact">{{$users->positions->position}}</p>
  <p class = "text2">{{$users->positions->note}}</p>
  <p class = "contact">{{$users->contact}} / {{$users->email}}</p>
  <a class = "btn bg-OwnInfo" role = "button" id = "btnEdit" data_id = "{{$users->id }}">Edit</a>
</div>

<div id="editProfileModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Update Profile</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id = "updateProfileForm">
                    <label>Contact Number:</label>
                    <input type = "text" class = "form-control" name = "contact" id = "contact">

                    <label>Email:</label>
                    <input type = "text" class = "form-control" name = "email" id = "email">

                    <labe>Profile picture(url)</labe>
                    <input type = "text" class = "form-control" name = "picture_url" id = "picture_url">

                    <input type = "text" name = "id" id = "id" style = "visibility:hidden">
                </form>
            </div>
            <div class="modal-footer">
               <button type = "button" class = "btn bg-OwnSuccess" id = "btnSave">Update profile</button>
            </div>
        </div>
    </div>
</div>

@include('includes.profile_script')
@endsection