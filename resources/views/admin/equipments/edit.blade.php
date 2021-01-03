@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit an Equipment</h2>
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
            <form method="post" action="{{ route('equipments.update', $equipment->equipmentId) }}">
                @method('PATCH') 
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{$equipment->name}}" required />
                </div>

                <div class="form-group">
                    <label for="qtd">Qtd:</label>
                    <input type="number" class="form-control" name="qtd" value="{{$equipment->qtd}}" required />
                </div>
                
                <div class="form-group">
                    <label for="value">Value:</label>
                    <input type="number" class="form-control" size="5" step="0.01" value="{{$equipment->value}}" name="value" required>
                </div>
                
                <div class="form-group">
                    <label for="city">Address:</label>
                    <input type="text" class="form-control" name="address" value="{{$equipment->address}}" />
                </div>
                <div class="form-group">
                    <label for="addressComp">Address Complement:</label>
                    <input type="text" class="form-control" name="addressComp" value="{{$equipment->addressComp}}" />
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" name="city" value="{{$equipment->city}}" />
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" name="state" value="{{$equipment->state}}" />
                </div>
                <div class="form-group">
                    <label for="zipcode">Zip code:</label>
                    <input type="number" class="form-control" name="zipcode" value="{{$equipment->zipcode}}" />
                </div>
                <button type="submit" class="btn btn-primary">Update</button><br><br>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
