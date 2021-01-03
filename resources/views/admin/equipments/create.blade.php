@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Create an Equipment</h2>
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
            </div>
            <br /> 
            @endif
            <form method="post" action="{{ route('equipments.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" required />
                </div>

                <div class="form-group">
                    <label for="qtd">Qtd:</label>
                    <input type="number" class="form-control" name="qtd" required />
                </div>
                
                <div class="form-group">
                    <label for="value">Value:</label>
                    <input type="number" class="form-control" size="5" step="0.01" name="value" required>
                </div>
                
                <div class="form-group">
                    <label for="city">Address:</label>
                    <input type="text" class="form-control" name="address" />
                </div>
                <div class="form-group">
                    <label for="addressComp">Address Complement:</label>
                    <input type="text" class="form-control" name="addressComp" />
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" name="city" />
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" name="state" />
                </div>
                <div class="form-group">
                    <label for="zipcode">Zip code:</label>
                    <input type="number" class="form-control" name="zipcode" />
                </div>
                
                <button type="submit" class="btn btn-primary">Add</button><br><br>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
