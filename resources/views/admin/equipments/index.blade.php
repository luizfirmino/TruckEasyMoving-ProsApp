@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Equipments</h2>
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
            
            
            @if(!empty($equipments)) 
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell" colspan="5">&nbsp;</td>
                        <td colspan="2">
                            <a href="{{route('equipments.create')}}" class="btn btn-primary">New equipment</a>
                        </td>
                    </tr>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Name</td>
                      <td class="d-none d-sm-table-cell">Qtd</td>
                      <td class="d-none d-sm-table-cell">Address</td>
                      <td class="d-none d-sm-table-cell" align="left">Value</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($equipments as $item)
                <tr>
                    <td class="d-none d-sm-table-cell">{{ $item->equipmentId }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->qtd }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->address }}</td>
                    <td class="d-none d-sm-table-cell" align="center">{{ $item->value }}</td>
                    <td>
                        <a href="{{ route('equipments.edit', $item->equipmentId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('equipments.destroy', $item->equipmentId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="7">{{ $equipments->links() }}</td>
                </tr>
            </table>
            
            @else
                NO EQUIPMENTS FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
