@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Services</h2>
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
            
            
            @if(!empty($data)) 
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell" colspan="5">&nbsp;</td>
                        <td colspan="2">
                            <a href="{{route('services.create')}}" class="btn btn-primary">New service</a>
                        </td>
                    </tr>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Service</td>
                      <td class="d-none d-sm-table-cell">Hour Rate</td>
                      <td class="d-none d-sm-table-cell">Minimum Hours</td>
                      <td class="d-none d-sm-table-cell">Increments</td>
                      <td class="d-none d-sm-table-cell">Active</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                <tr>
                    <td class="d-none d-sm-table-cell">{{ $item->orderServiceId }}</td>
                    <td>{{ $item->service }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->hourRate }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->minimumHours }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->minuteIncrements }}</td>
                    <td class="d-none d-sm-table-cell">
                        @if($item->active=="1") 
                            <i class="fa fa-check" aria-hidden="true"></i>
                        @else 
                            <i class="fa fa-times active" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('services.edit',$item->orderServiceId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('services.destroy', $item->orderServiceId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8">{{ $data->links() }}</td>
                </tr>
            </table>
            
            @else
                NO SERVICES FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
