@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Orders</h2>
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
                    <form class="form-inline" method="get" name="search" id="search" action="{{ route('orders.index')}}">
                    @csrf
                        <div class="form-group mr-4">
                            <input type="number" name="q_contractNumber" value="{{Request('q_contractNumber')}}" class="form-control" placeholder="#">
                        </div>
                        <div class="form-group mr-4">
                            <select class="form-control" name="q_orderStatusId">
                                <option value="">Status</option>
                              @foreach($comboStatus as $item)
                                <option value="{{$item->orderStatusId}}" @if($item->orderStatusId==Request('q_orderStatusId'))selected @endif>{{$item->status}}</option>
                              @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mr-4">
                            <select class="form-control" name="q_orderServiceId">
                              <option value="">Service</option>
                              @foreach($comboServices as $item)
                                <option value="{{$item->orderServiceId}}" @if($item->orderServiceId==Request('q_orderServiceId'))selected @endif >{{$item->service}}</option>
                              @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mr-4">
                            <input type="text" name="q_customer" value="{{Request('q_customer')}}" class="form-control" placeholder="Customer name">
                        </div>
                        
                        <div class="form-group mr-4">
                            <input type="text" name="q_phoneNumber" value="{{Request('q_phoneNumber')}}" class="form-control" placeholder="Phone Number">
                        </div>
                        
                        <div class="form-group">
                            <a onclick="document.search.submit();" class="btn btn-primary mr-4"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="{{ route('orders.create')}}" class="btn btn-primary"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>
                        </div>
                    </form>        
                </div>
            </nav>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                      <td>#</td>
                      <td class="d-none d-sm-table-cell">Status</td>
                      <td class="d-none d-sm-table-cell">Service</td>
                      <td>Customer</td>
                      <td class="d-none d-sm-table-cell">Date Schedule</td>
                      <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                @if(count($orders)>0)
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->contractNumber }}</td>
                    <td class="d-none d-sm-table-cell">{{ $order->status }}</td>
                    <td class="d-none d-sm-table-cell">{{ $order->service }}</td>
                    <td>{{ $order->firstName }} {{ $order->lastName }}</td>
                    <td class="d-none d-sm-table-cell">{{ $order->dateSchedule }} {{ $order->timeSchedule }}</td>
                    <td>
                        <a href="{{ route('orders.edit',$order->orderId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8">{{ $orders->withQueryString()->links() }}</td>
                </tr>
                @else
                <tr>
                    <td colspan="8">NO ORDERS FOUND</td>
                </tr>
                @endif
            </table>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
