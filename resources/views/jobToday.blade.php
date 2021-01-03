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
        
        <div class="col-lg-12">
            
            @if(session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}  
                </div>
            @endif
            
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif
        </div>
        
        <!-- JOBS TO DO -->
        <div class="col-lg-6">

            <div class="checklist-block block">
                
                <form method="POST" action="{{ url('/jobToday/')}}/{{$job->orderId}}" id="form">
                @csrf
                     @method('PUT')
                    
                    <input type="hidden" name="orderId" value="{{$job->orderId}}">
                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                    
                    <div class="title">
                        <strong>{{ $job->firstName }} {{ $job->lastName }}</strong><br>
                        {{ $job->service }}<br>
                        @if ($leader or App\User::admin())
                            <i class="fa fa-phone" aria-hidden="true"></i> {{ $job->phoneNumber }} 
                            <a href="sms:{{ $job->phoneNumberSMS }}?&body=Hi {{ $job->firstName }}, this is {{ Auth::user()->firstName }} from Truck Easy, "><i class="fa fa-comments" aria-hidden="true"></i></a><br>
                        @endif
                        <i class="fa fa-calendar" aria-hidden="true"></i> {{ $job->dateScheduleFormated }}<br/>
                        <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeScheduleAMPM }}<br>
                        
                        @if(!empty($job->notes))
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notes: {{ $job->notes }}<br />
                        @endif
                    </div>

                    @if (App\User::admin())
                        <button type="submit" class="btn btn-primary" disabled>{{ __('Check in now') }}</button> 
                        <button type="submit" class="btn btn-primary" disabled>{{ __('Check out now') }}</button><br/><br/>    
                    @else
                    
                        @if($job->checkInAvailable)
                            @if ($check->timeStarts == null)
                                <button type="submit" class="btn btn-primary">{{ __('Check in now') }}</button><br/><br/>
                            @elseif ($check->timeEnds == null)
                                 <i class="fa fa-toggle-on" aria-hidden="true"></i> Check-in at: {{$check->timeStarts}}<br/>
                                 <button type="submit" class="btn btn-primary">{{ __('Check out now') }}</button><br/><br/>
                            @else
                                <i class="fa fa-toggle-on" aria-hidden="true"></i> Check-in at: {{$check->timeStarts}}<br />
                                <i class="fa fa-toggle-off" aria-hidden="true"></i> Check-out at: {{$check->timeEnds}}<br /><br />
                            @endif
                        @else
                            <button type="submit" class="btn btn-primary" disabled>{{ __('Check in now') }}</button><br>
                            <small class="text-muted"><i class="icon-info"></i> Available only 1 hour before the start time</small><br /><br />
                        @endif
                    
                    
                    @endif
                    
                    @foreach ($addresses as $address)
                        <i class="fa fa-map-marker" aria-hidden="true"></i> {{$address->direction}}<br>
                        @php
                            $link = str_replace(" ","+", $address->address) . "+";
                            $link = $link . str_replace(" ","+", $address->city) . "+" . $address->state . "+" . $address->zipcode;
                        @endphp

                        <a href="https://www.google.com/maps/place/{{ $link }}" target="_blank">
                            {{ $address->address }} {{ $address->addressComp }}<br />
                            <small>{{ $address->city }}, {{ $address->state }}, {{ $address->zipcode }}</small>
                        </a><br />

                        @if(!empty($address->notes))
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notes: {{ $address->notes }}<br />
                        @endif
                        <br />
                    @endforeach
                    
                    <big>Team</big><br>
                    @foreach ($resources as $resource)
                        <i class="fa fa-user-o" aria-hidden="true"></i> {{ $resource->firstName}} {{ $resource->lastName}} <br />
                        <small>{{ $resource->role }}<br />
                        <i class="fa fa-whatsapp" aria-hidden="true"></i> {{ $resource->phoneNumber }} </small><br /><br />
                    @endforeach
                
                    
                     <big>Equipment</big><br>
                
                    @if(count($jobEquipments)>0)

                        <small class="text-muted"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> The equipment location may change by the day of the job.</small><br><br>

                        @foreach ($jobEquipments as $item)

                            <i class="fa fa-wrench" aria-hidden="true"></i> {{$item->name}}<br/>

                            @if(!empty($item->address))
                                @php
                                    $link = str_replace(" ","+", $item->address) . "+";
                                    $link = $link . str_replace(" ","+", $item->city) . "+" . $item->state . "+" . $item->zipcode;
                                @endphp
                                <i class="fa fa-map-marker" aria-hidden="true"></i> <a href="https://www.google.com/maps/place/{{ $link }}" target="_blank">{{ $item->address }} {{ $item->addressComp }}</a><br />
                                &nbsp;&nbsp;&nbsp;<a href="https://www.google.com/maps/place/{{ $link }}" target="_blank" class="text-small">{{ $item->city }}, {{ $item->state }}, {{ $item->zipcode }}</a>
                                <br />
                            @endif

                            @if(!empty($item->notes))
                                <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notes: {{ $item->notes }}<br />
                            @endif
                            <br>
                        @endforeach
                    @else
                        NO EQUIPMENT ASSIGNED UP FOR THIS JOB YET
                    @endif
                    
                </form> 
                   
            </div>
        <!-- /JOBS TO DO -->
        </div>
        
        @if ($leader or App\User::admin())
        <!-- ACTION -->
        <div class="col-lg-6">
            <div class="checklist-block block">
                <div class="title"><strong>Actions</strong></div>        
                    <a href="{{route('job.calculator', $job->orderId )}}" class="btn btn-primary">Calculator</a><br><br>                    
            </div>
        </div>
        @endif
                
    </div>
    <div class="row">
        
        <div class="col-lg-6">
            
            <div class="checklist-block block">
            
                <div class="title"><strong>Photos</strong></div>
                <form method="post" action="{{route('job.photo', $job->orderId )}}" enctype="multipart/form-data">
                @method('POST')
                @csrf

                Use this function to upload photos, report an issue, or in any other case which needs proof.<br>
                <small class="text-muted"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Once uploaded into the system, only the administrator can delete or update the photos.</small><br><br>
                <input type="file" class="form-control" name="photo" required>
                <textarea name="notes" class="form-control" placeholder="Notes for the photo (not required)"></textarea>
                <button type="submit" class="btn btn-primary">Upload an image</button><br>
                </form>
                            
                @if(!empty($jobFiles))
                <div id="portfolio" class="mt-4">
                    <div class="row no-gutters">
                        @foreach ($jobFiles as $file)
                        <div class="col-lg-2 col-sm-6 m-1">
                            <a class="portfolio-box" href="/storage/app/{{$file->path}}">
                                @if (!empty($file->thumbnail))
                                    <img class="img-fluid img-thumbnail" src="/storage/app/{{$file->thumbnail}}" alt="" />
                                @else
                                    <img class="img-fluid img-thumbnail" src="/storage/app/{{$file->path}}" alt="" />
                                @endif
                            </a>
                            <small>{{$file->notes}}</small>
                        </div>
                         @endforeach
                    </div>                    
                </div>
                @endif
                
            </div>
            
        </div>
        
    </div>
      
      
  </div>
</section>
<!-- /TODAY'S JOB -->


@endsection
