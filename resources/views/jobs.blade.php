@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Past Jobs</h2>
  </div>
</div>
        
<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <!-- JOBS TO DO -->
        <div class="col-lg-12">
            <div class="checklist-block block">

                 @if(count($jobs) > 0) 
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <td>Customer</td>
                                <td class="d-none d-sm-table-cell">Service</td>
                                <td>Date</td>
                                <td class="d-none d-sm-table-cell">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($jobs as $item)
                        <tr>
                            <td>{{ $item->firstName }} {{ $item->lastName }}</td>
                            <td class="d-none d-sm-table-cell">{{ $item->service }}</td>
                            <td>{{ $item->dateScheduleFormated }}</td>
                            <td class="d-none d-sm-table-cell">{{ $item->status }}</td>
                            <td><a href="jobdetails/{{ $item->orderId }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">{{ $jobs->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                @else
                    NO JOBS PAST FOUND
                @endif
            </div>
        <!-- /JOBS TO DO -->
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
