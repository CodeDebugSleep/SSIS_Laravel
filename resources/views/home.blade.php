@extends('masterlayout')
@if(Auth::user()->position_id == 2001)  
    @include('includes.adminNav') 
@elseif(Auth::user()->position_id == 2002 || 2003)
    @include('includes.userNav')
@endif

<!-- INCASE NA AYAW ULIT MAMAYA, LAGAY: IF(AUTH::USER()->DELETED_AT == NULL) -->

@section('myBody')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
