@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Create an User</h2>
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
            
            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="firstName" required/>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="lastName" required/>
                </div>
                
                <div class="form-group">
                    <label for="last_name">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" required/>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" required/>
                </div>
                
                <div class="form-group-material">
                    <label for="profilePicture">Profile Picture:</label>
                    <input id="profilePicture" type="file" class="form-control" name="profilePicture" required>
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
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
