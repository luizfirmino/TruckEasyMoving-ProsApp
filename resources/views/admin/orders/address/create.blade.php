@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Add an Address</h2>
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
              <form method="post" action="{{ route('address.store', [request()->route('orderId')]) }}">
                  @csrf
                  <div class="form-group">    
                      <label for="first_name">Address:</label>
                      <input type="text" class="form-control" name="address"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Address Comp:</label>
                      <input type="text" class="form-control" name="addressComp"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">City:</label>
                      <input type="text" class="form-control" name="city" value="San Diego"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">State:</label>
                      <input type="text" class="form-control" name="state" value="CA"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Zipcode:</label>
                      <input type="text" class="form-control" name="zipcode"/>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Order:</label><br>
                      <input type="radio"  value="1" name="order"/> Pick-up &nbsp;
                      <input type="radio"  value="2" name="order"/> Drop-off
                  </div>
                  <div class="form-group">    
                      <label for="notes">Notes:</label>
                      <textarea name="notes" cols="150" rows="5" class="form-control"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Add Address</button>
              </form>
            <br>
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
