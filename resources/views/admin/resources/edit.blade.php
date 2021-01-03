@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit a Resource</h2>
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
            <form method="post" action="{{ route('resources.update', $resource->resourceId) }}">
                @method('PATCH') 
                @csrf
                <div class="form-group">
                    <label for="first_name">Active:</label>
                    <input type="radio" name="active" value="1" @if($resource->active=="1")checked @endif/> Yes
                    <input type="radio" name="active" value="0" @if($resource->active=="0")checked @endif /> No
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="firstName" value="{{ $resource->firstName }}" />
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="lastName" value="{{ $resource->lastName }}" />
                </div>
                
                <div class="form-group">
                    <label for="last_name">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" value="{{ $resource->phoneNumber }}" />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ $resource->email }}" />
                </div>
                <div class="form-group">
                    <label for="city">Address:</label>
                    <input type="text" class="form-control" name="address" value="{{ $resource->address }}" />
                </div>
                <div class="form-group">
                    <label for="city">Address Complement:</label>
                    <input type="text" class="form-control" name="addressComp" value="{{ $resource->addressComp }}" />
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" name="city" value="{{ $resource->city }}" />
                </div>
                <div class="form-group">
                    <label for="country">State:</label>
                    <input type="text" class="form-control" name="state" value="{{ $resource->state }}" />
                </div>
                <div class="form-group">
                    <label for="job_title">Zip code:</label>
                    <input type="number" class="form-control" name="zipcode" value="{{ $resource->zipcode }}" />
                </div>
                <div class="form-group">
                    <label for="job_title">Contract Number:</label>
                    <input type="text" class="form-control" name="zipcode" value="{{ $resource->contractNumber }}" />
                </div>
                <div class="form-group">
                    <label for="job_title">User:</label>
                    <select class="form-control" name="userId">
                         <option value="">Select</option>
                      @foreach($comboUsers as $item)
                        <option value="{{$item->id}}" @if($item->id==$resource->userId)selected @endif>{{$item->name}}</option>
                      @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="job_title">Roles associated to this resource:</label><br>
                    @foreach($comboRoles as $item)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="{{$item->roleId}}" name="roles[]" {{ in_array($item->roleId, $resourceRoles) ? "checked" : "" }} /> 
                        {{$item->name}}
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Update</button><br><br>
            </form>
            
        </div>
        
        
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
