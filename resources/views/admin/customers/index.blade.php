@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Customers</h2>
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
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> Filters
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <form class="form-inline" method="get" name="search" id="search" action="{{ route('customers.index')}}">
                    @csrf
                        
                        <div class="form-group mr-4">
                            <input type="text" name="q_name" value="{{Request('q_name')}}" class="form-control" placeholder="Customer name">
                        </div>
                        
                        <div class="form-group mr-4">
                            <input type="text" name="q_phoneNumber" value="{{Request('q_phoneNumber')}}" class="form-control" placeholder="Phone Number">
                        </div>
                        
                        <div class="form-group mr-4">
                            <input type="text" name="q_email" value="{{Request('q_email')}}" class="form-control" placeholder="E-mail">
                        </div>
                        
                        <div class="form-group">
                            <a onclick="document.search.submit();" class="btn btn-primary mr-4"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="{{route('customers.create')}}" class="btn btn-primary">New customer</a>
                        </div>
                    </form>        
                </div>
            </nav>
            
            
            @if(!empty($customers)) 
            
            <table class="table table-striped">
                <thead>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Name</td>
                      <td class="d-none d-sm-table-cell">Email</td>
                      <td class="d-none d-sm-table-cell">Phone Number</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td class="d-none d-sm-table-cell">{{ $customer->customerId }}</td>
                    <td>{{ $customer->firstName }} {{ $customer->lastName }}</td>
                    <td class="d-none d-sm-table-cell">{{ $customer->email }}</td>
                    <td class="d-none d-sm-table-cell">{{ $customer->phoneNumber }}</td>
                    <td>
                        <a href="{{ route('customers.edit',$customer->customerId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('customers.destroy', $customer->customerId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6">{{ $customers->withQueryString()->links() }}</td>
                </tr>
            </table>
            
            @else
                NO CUSTOMERS FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
