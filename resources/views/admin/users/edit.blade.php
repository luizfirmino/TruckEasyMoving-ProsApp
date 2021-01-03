@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit an user</h2>
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
            
            <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="firstName" value="{{ $user->firstName }}" />
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="lastName" value="{{ $user->lastName }}" />
                </div>
                
                <div class="form-group">
                    <label for="last_name">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" value="{{ $user->phoneNumber }}" />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" />
                </div>
                
                <div class="form-group-material">
                    <label for="profilePicture">Profile Picture:</label>
                     
                    @if (!(empty($user->profilePicture)))
                        <img src="/storage/app/public/{{ $user->profilePicture }}" class="img-fluid rounded-circle">
                        <input id="profilePicture" type="file" class="form-control" name="profilePicture">
                    @else
                        <input id="profilePicture" type="file" class="form-control" name="profilePicture" required>
                    @endif
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
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
