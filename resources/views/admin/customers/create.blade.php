@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Create a Customer</h2>
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
              <form method="post" action="{{ route('customers.store') }}">
                  @csrf
                  <div class="form-group">    
                      <label for="first_name">First Name:</label>
                      <input type="text" class="form-control" name="firstName"/>
                  </div>

                  <div class="form-group">
                      <label for="last_name">Last Name:</label>
                      <input type="text" class="form-control" name="lastName"/>
                  </div>
                  <div class="form-group">
                      <label for="phoneNumber">Phone Number:</label>
                      <input type="text" class="form-control" name="phoneNumber"/>
                  </div>
                  <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" name="email"/>
                  </div>
                   <div class="form-group">
                      <label for="city">Address:</label>
                      <input type="text" class="form-control" name="address"/>
                  </div>
                   <div class="form-group">
                      <label for="city">Address Complement:</label>
                      <input type="text" class="form-control" name="addressComp"/>
                  </div>
                  <div class="form-group">
                      <label for="city">City:</label>
                      <input type="text" class="form-control" name="city"/>
                  </div>
                   <div class="form-group">
                      <label for="city">State:</label>
                      <select class="form-control" name="state">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA" selected>California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>	
                  </div>
                  <div class="form-group">
                      <label for="country">Zip Code:</label>
                      <input type="number" class="form-control" name="zipcode"/>
                  </div>                        
                  <button type="submit" class="btn btn-primary">Add Customer</button>
              </form>
            <br>
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
