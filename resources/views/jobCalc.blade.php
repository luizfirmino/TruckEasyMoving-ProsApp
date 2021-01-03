@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Job Calculator</h2>
  </div>
</div>
        
<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <!-- JOBS TO DO -->
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
            
            <div class="checklist-block block">
                
                <form method="POST" action="{{ url('/jobToday/')}}/{{$job->orderId}}/calculator" id="form">
                @csrf
                
                    
                    <input type="hidden" name="orderId" value="{{$job->orderId}}">
                    <div class="form-group">    
                      <label for="timeStarts">Start:</label>
                        <input type="time" class="form-control" required value="{{ old('timeStart', $job->timeSchedule) }}" name="timeStart"/>
                    </div>

                    <div class="form-group">
                        <label for="timeEnd">End:</label>
                        <input type="time" required class="form-control" value="{{ old('timeEnd') }}" name="timeEnd"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Calculate</button>
                
                </form> 
                   
            </div>
            
            @if(!empty($billing))
            
                @if ($billing->proof_payment)

                <div class="checklist-block block">
                    <img src="/storage/app/{{ $billing->proof_payment }}" class="img-fluid">
                </div>

                @else
                <div class="alert alert-success">
                The bill was sent to the customer by text to {{$job->phoneNumber}}.<br>
                Order number: {{$job->contractNumber}}<br>
                Please wait while payment is being made by the customer.<br>


                <form method="post" action="{{ route('job.upload', $job->orderId) }}" enctype="multipart/form-data" name="formUploadPayment">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="proof_payment">Proof of Payment:</label>
                    <input id="proof_payment" type="file" class="form-control" name="proof_payment" />
                </div>
                
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" onclick="document.formUploadPayment.submit();" class="custom-control-input" id="paid_cash" name="paid_cash" value="1">
                          <label class="custom-control-label" for="paid_cash">Paid cash</label>
                        </div>
                    </div>
                </div>
                    
                </form>
                </div>
                @endif

                
            
                                       
                <div class="checklist-block block">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td colspan="3"><big>${{ $billing->totalCharges }}</big><br></td>
                            </tr>
                            <tr>
                                <td>Start</td>
                                <td>End</td>
                                <td>Total Hours</td>
                            </tr>
                        </thead>
                        <tr>
                            <td>{{ $billing->timeStart }}</td>
                            <td>{{ $billing->timeEnd }}</td>
                            <td>{{ $billing->hourCharges }}</td>
                        </tr>
                    </table>
                </div>
            
            @endif
            
            
        <!-- /JOBS TO DO -->
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection
