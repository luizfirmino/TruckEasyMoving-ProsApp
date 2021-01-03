@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Resources</h2>
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
            
            
            @if(!empty($resources)) 
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell" colspan="5">&nbsp;</td>
                        <td colspan="2">
                            <a href="{{route('resources.create')}}" class="btn btn-primary">New resource</a>
                        </td>
                    </tr>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Name</td>
                      <td class="d-none d-sm-table-cell">Email</td>
                      <td class="d-none d-sm-table-cell">Phone Number</td>
                      <td class="d-none d-sm-table-cell" align="center">Active</td>    
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($resources as $resource)
                <tr>
                    <td class="d-none d-sm-table-cell">{{ $resource->resourceId }}</td>
                    <td>{{ $resource->firstName }} {{ $resource->lastName }}</td>
                    <td class="d-none d-sm-table-cell">{{ $resource->email }}</td>
                    <td class="d-none d-sm-table-cell">{{ $resource->phoneNumber }}</td>
                    <td class="d-none d-sm-table-cell" align="center">
                        @if($resource->active=="1") 
                            <i class="fa fa-check" aria-hidden="true"></i>
                        @else 
                            <i class="fa fa-times active" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('resources.edit',$resource->resourceId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('resources.destroy', $resource->resourceId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="7">{{ $resources->links() }}</td>
                </tr>
            </table>
            
            @else
                NO RESOURCES FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
