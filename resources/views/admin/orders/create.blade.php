@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Create an Order</h2>
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
              <form method="post" action="{{ route('orders.store') }}">
                  @csrf
                  <div class="form-group">    
                      <label for="first_name">Status:</label>
                        <select class="form-control" name="orderStatusId">
                          @foreach($comboStatus as $item)
                            <option value="{{$item->orderStatusId}}">{{$item->status}}</option>
                          @endforeach
                        </select>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Service:</label>
                      <select class="form-control" name="orderServiceId">
                          @foreach($comboServices as $item)
                            <option value="{{$item->orderServiceId}}">{{$item->service}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Source:</label>
                      <select class="form-control" name="orderSourceId">
                          @foreach($comboSources as $item)
                            <option value="{{$item->orderSourceId}}">{{$item->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  
                    <div class="form-group">
                        <label for="Customer">Customer:</label>

                        <div class="form-row">
                            <div class="col">
                                <label for="first_name"><small>First Name:</small></label>
                                <input type="text" class="form-control form-control-sm" name="customer_firstName"/>
                            </div>

                            <div class="col">
                                <label for="last_name"><small>Last Name:</small></label>
                                <input type="text" class="form-control form-control-sm" name="customer_lastName"/>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label for="city"><small>Phone Number:</small></label>
                                <input type="text" class="form-control form-control-sm" name="customer_phoneNumber"/>
                            </div>
                            <div class="col">
                                <label for="email"><small>Email:</small></label>
                                <input type="text" class="form-control form-control-sm" name="customer_email"/>
                            </div>
                        </div>
                      
                        <div class="form-row">
                            <div class="col">
                              <label for="city"><small>Existing Customer:</small></label>
                              <select class="form-control form-control-sm" name="customerId">
                                  <option value="">...</option>
                                  @foreach($comboCustomers as $item)
                                    <option value="{{$item->customerId}}">{{$item->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        
                  </div>
                  
                  <div class="form-group">
                      <label for="date">Date:</label>
                      <input type="date" class="form-control" name="dateSchedule"/>
                  </div>
                  <div class="form-group">
                      <label for="time">Time:</label>
                      <input type="time" class="form-control" name="timeSchedule"/>
                  </div>
                  <div class="form-group">
                      <label for="notes">Notes:</label>
                      <textarea class="form-control" name="notes" cols="200" rows="2"></textarea>
                  </div>                 
                  <button type="submit" class="btn btn-primary">Add Order</button><br><br>
              </form>
            <br>
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
