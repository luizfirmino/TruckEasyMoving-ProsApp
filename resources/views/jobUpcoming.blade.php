@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Upcoming Job Details</h2>
  </div>
</div>
        
<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
        
        @if(session()->get('success'))
            <div class="col-lg-12">
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            </div>
        @endif
        
        @if(!empty($confirmation))
           @if($confirmation->accepted === null)
            <div class="col-lg-12">
                <div class="checklist-block block">
                    Please, review the details of the job below and confirm.<br><br>
                    <form action="{{ route('job.confirmation', $job->orderId)}}" method="post">
                      @csrf
                      <input type="hidden" name="accepted" value="1">
                      <button class="btn btn-primary" type="submit" {{ App\User::admin() ? 'disabled' : "" }}>Yes, I confirm the job!</button>
                    </form>
                    <br>
                    <a class="btn btn-primary {{ App\User::admin() ? 'disabled' : "" }}" href="{{ route('jobReplacement.show', $job->orderId)}}" >I need a replacement</a>
                </div>
            </div>
            @endif
        @endif
        
        
        @if(!empty($replacement))
            <div class="col-lg-12">
                <div class="checklist-block block">
                    {{$replacement->firstName}} is looking for a replacement.<br /> 
                    @if(!empty($replacement->notes))
                    <p class="font-italic"><i class="fa fa-quote-left" aria-hidden="true"></i> {{$replacement->notes}} <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                    @endif
                    Please, review the details of the job below and confirm or pass the job.<br><br>
                    <form action="{{ route('jobReplacement.update', $replacement->replacementId)}}" method="post">
                      @csrf
                      @method('PATCH') 
                      <input type="hidden" name="accepted" value="1">
                      <button class="btn btn-primary" type="submit" {{ App\User::admin() ? 'disabled' : "" }}>Yes, I confirm the job!</button>
                    </form>
                    <br>
                    <form action="{{ route('jobReplacement.update', $replacement->replacementId)}}" method="post">
                      @csrf
                      @method('PATCH') 
                      <input type="hidden" name="accepted" value="0">
                      <button class="btn btn-primary btn-sm" type="submit" {{ App\User::admin() ? 'disabled' : "" }}>I can't do the job!</button>
                    </form>        
                </div>
            </div>
           
        @endif
        
        
        <!-- JOBS TO DO -->
        <div class="col-lg-6">
            
            <div class="checklist-block block">
                      
                <div class="title">
                    <strong>{{ $job->firstName }} {{ $job->lastName }}</strong><br>
                    {{ $job->service }}<br>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $job->dateScheduleFormated }}<br/>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeScheduleAMPM }}<br>
                    
                    @if(!empty($job->notes))
                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notes: {{ $job->notes }}<br />
                    @endif
                </div>
                
                @if(!empty($addresses))
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
                @else
                    NO ADDRESSES ASSIGNED
                @endif
                
                <big>Team</big><br>
                @if(count($resources)>0)
                    @foreach ($resources as $resource)
                        <i class="fa fa-user-o" aria-hidden="true"></i> {{ $resource->firstName}} {{ $resource->lastName}} <br />
                        <small>{{ $resource->role }}<br />
                        <i class="fa fa-whatsapp" aria-hidden="true"></i> {{ $resource->phoneNumber }} </small><br /><br />
                    @endforeach
                @else
                    NO MOVERS ASSIGNED<br /><br />
                @endif
                
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
                   
            </div>
        <!-- /JOBS TO DO -->
        </div>

        
        @if(!empty($confirmation))
        @if($confirmation->accepted == 1)
        
        <div class="col-lg-6">
            <div class="checklist-block block">
                <div class="title"><strong>Actions</strong></div>
                
                @if ($job->replacementAvailable == '1')
                    @if (empty($replacementOwner))
                        <a class="btn btn-primary" href="{{ route('jobReplacement.show', $job->orderId)}}">I need a replacement</a>
                    @else
                        <a class="btn btn-primary" href="/replacement/{{$replacementOwner->replacementId}}/status">Replacement Status</a>
                    @endif
                @else
                    <a class="btn btn-primary disabled" href="#">I need a replacement (not available)</a>
                @endif
            </div>
        </div>
        @endif
        @endif
        
        
        @if(count($jobFiles)>0)
        <div class="col-lg-6">
            
            <div class="checklist-block block">
            
                <div class="title"><strong>Photos</strong></div>
                
                @if(!empty($jobFiles))
                <div id="portfolio" class="mt-4">
                    <div class="row no-gutters">
                        @foreach ($jobFiles as $file)
                        <div class="col-lg-2 col-sm-6 m-1">
                            <a class="portfolio-box" href="/storage/app/{{$file->path}}">
                                @if (!is_null($file->thumbnail))
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
        @endif
        
        
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->
@endsection
