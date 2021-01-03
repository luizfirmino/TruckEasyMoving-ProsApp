@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Create a Resource</h2>
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
            <form method="post" action="{{ route('resources.store') }}">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="firstName" />
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="lastName" />
                </div>
                
                <div class="form-group">
                    <label for="last_name">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" />
                </div>
                <div class="form-group">
                    <label for="city">Address:</label>
                    <input type="text" class="form-control" name="address" />
                </div>
                <div class="form-group">
                    <label for="city">Address Complement:</label>
                    <input type="text" class="form-control" name="addressComp" />
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" name="city" />
                </div>
                <div class="form-group">
                    <label for="country">State:</label>
                    <input type="text" class="form-control" name="state" />
                </div>
                <div class="form-group">
                    <label for="job_title">Zip code:</label>
                    <input type="number" class="form-control" name="zipcode" />
                </div>
                <div class="form-group">
                    <label for="job_title">Contract Number:</label>
                    <input type="text" class="form-control" name="zipcode" />
                </div>
                <div class="form-group">
                    <label for="job_title">User:</label>
                    <select class="form-control" name="userId">
                         <option value="">Select</option>
                      @foreach($comboUsers as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="job_roles">Roles associated to this resource:</label><br>
                    @foreach($comboRoles as $item)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="{{$item->roleId}}" name="roles[]" /> 
                        {{$item->name}}
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Add</button><br><br>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
