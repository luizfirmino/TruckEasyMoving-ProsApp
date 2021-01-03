@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Job Details</h2>
  </div>
</div>
        
<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <!-- JOBS TO DO -->
        <div class="col-lg-6">
            <div class="checklist-block block">
                
                <div class="title">
                    <strong>{{ $job->firstName }} {{ $job->lastName }}</strong><br>
                    {{ $job->service }}<br>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $job->dateSchedule }}<br/>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeSchedule }}<br/>
                    <i class="fa fa-hourglass-o" aria-hidden="true"></i> {{ $job->duration }} hours <br />
                    <i class="fa fa-check-square-o" aria-hidden="true"></i> {{ $job->status }}
                </div>
                
                @if(count($payments) > 0) 
                
                    <big>Payment Details</big><br><br>
                    
                    @php
                        $resourceGroupId = "";
                    @endphp
                    
                        @foreach ($payments as $payment)
                        
                            @php
                            
                            if($resourceGroupId != $payment->resourceId ){
                                if($resourceGroupId != "") print "<br>"; 
                                $resourceGroupId = $payment->resourceId;
                                print "<i class='fa fa-user-o' aria-hidden='true'></i> " . $payment->firstName . " " . $payment->lastName . " - ";
                                print $payment->role . " $" . $payment->hourRate . "/hour <br>";
                                print "<i class='fa fa-toggle-on' aria-hidden='true'></i> " . $payment->timeStarts . " ";
                                print "<i class='fa fa-toggle-off' aria-hidden='true'></i> " . $payment->timeEnds . "<br>";
                            }
                            @endphp
                            {{ $payment->payment }} - {{ $payment->type }}<br />
                    
                        @endforeach
                    
                    @else
                        NO PAYMENTS MADE
                    @endif
                    
               
                
            </div>
        <!-- /JOBS TO DO -->
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection
