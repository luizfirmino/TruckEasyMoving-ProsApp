@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Job Replacement</h2>
  </div>
</div>
        
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-6">
            
            @if(session()->get('success'))
                <div class="col-lg-12 alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif

            @if ($errors->any())
                <div class="col-lg-12 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br /> 
            @endif
            
            <div class="checklist-block block">
                      
                <div class="title">
                    <strong>{{ $job->firstName }} {{ $job->lastName }}</strong><br>
                    {{ $job->service }}<br>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $job->dateScheduleFormated }}<br/>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeScheduleAMPM }}<br>                
                </div>
                
                @if(count($resourcesAvailable)>0 and $job->replacementAvailable == '1')
                
                <form method="post" action="{{ route('jobReplacement.store') }}">
                @csrf
                    <input type="hidden" name="orderId" value="{{$job->orderId}}">
                    <div class="alert alert-warning" role="alert">
                        While the process of replacement is not completely finished, you are still responsible and scheduled for doing the job.
                        Be advised that replacement requests will count on your records and it may affect your score for future jobs.
                    </div>

                    <big>I want to:</big><br>
                    
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="replacedBy" value="anyone" onclick="resourceReplacementId.disabled = true;" required /> Be replaced by anyone available
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="replacedBy" value="specific" onclick="resourceReplacementId.disabled = false;" required /> Be replaced by 
                        </div>
                    </div>
                    
                    <select class="form-control" name="resourceReplacementId" disabled>
                         <option value="">Select</option>
                      @foreach($resourcesAvailable as $item)
                        <option value="{{$item->resourceId}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    <br>
                    <textarea class="form-control" name="notes" required placeholder="Notes about why you need a replacement may help"></textarea><br>
                
                    <button type="submit" class="btn btn-primary">Send my request for replacement</button><br><br>
                    
                </form>
                
                @else
                    AT THIS MOMENT THERE ARE NO RESOURCES AVAILABLE TO REPLACE YOU IN THIS JOB<br /><br />
                @endif
                
            </div>
        </div>

    </div>
  </div>
</section>
@endsection
