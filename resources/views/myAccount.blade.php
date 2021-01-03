@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">My Account</h2>
  </div>
</div>
        
<!-- MY ACCOUNT -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

                
        
        <div class="col-lg-6">
            
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif
            
            <div class="checklist-block block">
                @if(!empty($account))
                    <big>{{ $account->firstName }} {{ $account->lastName }}</big><br>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i> {{ $account->email }}<br>
                    <i class="fa fa-whatsapp" aria-hidden="true"></i> {{ $account->phoneNumber }}
                    @if(!empty($account->address))
                        <br>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $account->address }} {{ $account->addressComp }}<br>
                        &nbsp;&nbsp;&nbsp;<small>{{ $account->city }}, {{ $account->state }} {{ $account->zipcode }}</small>
                    @endif
                    <br><br>
                    <a href="{{ route('myAccount.edit', Auth::user()->id)}}" class="btn btn-primary">Update</a>
                @else
                    YOUR ACCOUNT IS NOT RELATED INTO PROS YET.
                @endif
            </div>
        </div>
                
    </div>
  </div>
</section>

@endsection
