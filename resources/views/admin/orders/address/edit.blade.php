@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit an Address</h2>
  </div>
</div>
        
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <div class="col-lg-6">
            
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div><br />
            @endif
              <form method="post" action="{{ route('address.update', [request()->route('orderId'), request()->route('addressId') ]) }}">
                  @csrf
                  <div class="form-group">    
                      <label for="first_name">Address:</label>
                      <input type="text" class="form-control" name="address" value="{{ $address->address }}" />
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Address Comp:</label>
                      <input type="text" class="form-control" name="addressComp" value="{{ $address->addressComp }}"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">City:</label>
                      <input type="text" class="form-control" name="city" value="{{ $address->city }}"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">State:</label>
                      <input type="text" class="form-control" name="state" value="{{ $address->state }}"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Zipcode:</label>
                      <input type="text" class="form-control" name="zipcode" value="{{ $address->zipcode }}"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Order:</label><br>
                      <input type="radio"  value="1" name="order" @if($address->order==1)checked @endif/> Pick-up &nbsp;
                      <input type="radio"  value="2" name="order" @if($address->order==2)checked @endif/> Drop-off
                  </div>
                  <div class="form-group">    
                      <label for="notes">Notes:</label>
                      <textarea name="notes" cols="150" rows="5" class="form-control">{{ $address->notes }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Address</button>
              </form>
            <br>
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
