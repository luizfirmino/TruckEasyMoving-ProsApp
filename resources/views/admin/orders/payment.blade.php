@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Add Payment</h2>
  </div>
</div>
        
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            
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
            
            @if(session()->get('error'))
                <div class="alert alert-warning">
                    {{ session()->get('error') }}  
                </div>
            @endif
            
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif
            
            <form method="post" action="{{ route('orders.processPayment', Request::route('id')) }}">
            @csrf
            
                
            @if(!empty($orderBilling))
            <big>Billing</big>
            <table class="table table-striped">
                <thead>
                    <tr>
                      <td>Start</td>
                      <td>End</td>
                      <td>Hour Rate</td>
                      <td>Minimum Hours</td>
                      <td>Total Hours</td>    
                      <td>Total Minutes</td>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$orderBilling->timeStart}}</td>
                        <td>{{$orderBilling->timeEnd}}</td>
                        <td>{{$orderBilling->hourRate}}</td>
                        <td>{{$orderBilling->minimumHours}}</td>
                        <td>{{$orderBilling->totalHours}}</td>
                        <td>{{$orderBilling->totalMinutes}}</td>
                        
                    </tr>
                </tbody>
            </table><br><br>
            
            
            <big>Charges</big>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Hours</td>
                        <td>Total </td>
                        <td>Total Card</td>
                        <td>Paid</td>
                        <td>Screenshot</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$orderBilling->hourCharges}}</td>
                        <td>{{$orderBilling->totalCharges}}</td>
                        <td>{{$orderBilling->totalChargesCard}}</td>
                        <td>{{$orderBilling->paid}}</td>
                        <td><a href="/storage/app/{{$orderBilling->proof_payment}}" target="_blank">Open</a></td>
                    </tr>
                </tbody>
            </table><br><br>
            
            <big>Transaction</big>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Service</td>
                        <td>Created at</td>
                        <td>Updated at</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="checkoutId" value="{{$orderBilling->checkoutId}}" required/></td>
                        <td><input type="text" class="form-control" name="checkoutService" value="{{$orderBilling->checkoutService}}" required/></td>
                        <td>{{$orderBilling->created_at}}</td>
                        <td>{{$orderBilling->updated_at}}</td>
                    </tr>
                </tbody>
            </table>
            <br><br>
                @endif
            
            
            <div class="form-group">
                <label for="duration">Duration <smaill>(hours)</smaill>:</label>
                <input type="number" class="form-control" size="4" step="0.01" name="duration" value="{{$order->duration}}" required />
            </div>

            <div class="form-group">
                <label for="payment">Payment Amount:</label>
                <input type="number" class="form-control" size="8" step="0.01" name="payment" required >
            </div>
                
            <div class="form-group">
                <label for="tip">Tip:</label>
                <input type="number" class="form-control" size="8" step="0.01" name="tip" />
            </div>

            <button type="submit" class="btn btn-primary">Process Payment</button>
            
            </form>
            <br><br>

        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
