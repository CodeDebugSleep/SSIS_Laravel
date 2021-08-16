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
</div>



@include('includes.profile_script')
@endsection