@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Params - Services</h2>
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
            
            
            @if(!empty($services)) 
            
            <table class="table table-striped">
                <thead>
                    <form method="post" action="{{ route('services.store') }}">
                    @csrf
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="2">
                            <a href="{{route('services.store')}}" class="btn btn-primary">Add service</a>
                        </td>
                    </tr>
                    </form>
                    <tr>
                      <td>ID</td>
                      <td>Service</td>
                      <td>Hour rate</td>
                      <td align="center">Active</td>    
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>{{ $service->orderServiceId }}</td>
                    <td>{{ $service->service }}</td>
                    <td>{{ $service->email }}</td>
                    <td>{{ $service->phoneNumber }}</td>
                    <td align="center">
                        @if($service->active=="1") 
                            <i class="fa fa-check" aria-hidden="true"></i>
                        @else 
                            <i class="fa fa-times active" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('services.edit',$service->serviceId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('services.destroy', $service->serviceId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="7">{{ $services->links() }}</td>
                </tr>
            </table>
            
            @else
                NO serviceS FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
