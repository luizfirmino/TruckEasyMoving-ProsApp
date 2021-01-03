@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Replacements</h2>
  </div>
</div>
        
<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <!-- JOBS TO DO -->
        <div class="col-lg-12">
            
            
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif
            
            
             <div class="checklist-block block">
                      
                <div class="title">
                    <strong>{{ $replacement->customerName }}</strong><br>
                    {{ $replacement->service }}<br>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $replacement->dateScheduleFormated }}<br/>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $replacement->timeScheduleAMPM }}<br>
                </div>
                                 
                @if ($replacement->active == 1)
                    <div class="alert alert-primary" role="alert">In progress</div>
                     <form action="{{ route('replacements.destroy', $replacement->replacementId)}}" method="post" id="form">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Cancel replacement</button>
                    </form> 
                @else    
                    <div class="alert alert-danger" role="alert">This replacement request is no longer active!</div>
                @endif
                 
                <strong>{{ $replacement->resourceName }}</strong><br> 
                {{ $replacement->notes }}<br> 
                 
                
                 
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
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
