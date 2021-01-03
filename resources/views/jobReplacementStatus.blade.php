@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Job Replacement Status</h2>
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

            <div class="checklist-block block">
                      
                <div class="title">
                    <strong>{{ $job->firstName }} {{ $job->lastName }}</strong><br>
                    {{ $job->service }}<br>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $job->dateScheduleFormated }}<br/>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeScheduleAMPM }}<br>                
                </div>
                
                @if ($replacement->active == 1)
                
                    <div class="alert alert-warning" role="alert">
                        While the process of replacement is not completely finished, you are still responsible and scheduled for doing the job.
                        Be advised that replacement requests will count on your records and it may affect your score for future jobs.
                    </div>

                    <form action="{{ route('jobReplacement.destroy', $replacement->replacementId)}}" method="post" id="form">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Cancel my request for replacement</button>
                    </form>
                
                @else    
                    <div class="alert alert-danger" role="alert">This replacement request is no longer active!</div>
                @endif
            </div>
            
            
            <div class="checklist-block block">

                <big>Replacements list</big><br>

                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>Phone Number</td>
                        <td class="text-center">Status</td>
                        <td>Notes</td>
                    </tr>
                    @foreach($replacements as $item)
                    <tr>
                        <td>{{$item->resourceName}}</td>
                        <td>{{$item->phoneNumber}}</td>
                        <td class="text-center">
                            @if($item->accepted === null)
                                <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                            @elseif($item->accepted=="1") 
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else 
                                <i class="fa fa-times active" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td>{{$item->notes}}</td>
                    </tr>
                    @endforeach
                </table>
            
                
            </div>
        </div>

    </div>
  </div>
</section>
@endsection
