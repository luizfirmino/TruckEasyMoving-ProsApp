@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Orders Booking</h2>
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
            
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div><br />
            @endif
            
            <!-- JOBS TO DO -->
                    
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                      <td>
                        <form method="post" action="{{ route('booking.day') }}">
                        @csrf
                        <input type="hidden" name="q_dateSchedule" value="{{Request('q_prevDay')}}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        </form>
                    </td>
                      <td>{{Request('q_dateSchedule')}}</td>
                      <td>
                        <form method="post" action="{{ route('booking.day') }}">
                        @csrf
                            <input type="hidden" name="q_dateSchedule" value="{{Request('q_nextDay')}}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </form>
                        </td>
                    </tr>
                </thead>
            </table>
            
            
            @if(count($orders)>0)
            
            <form method="post" action="{{ route('booking.store') }}">
            @csrf
            <input type="hidden" name="q_dateSchedule" value="{{Request('q_dateSchedule')}}">
                
                                        
            <table class="table table-sm" border="0">
                <thead>
                    <tr>
                        <td>Start Time</td>
                        @foreach ($orders as $order)
                        <td class="text-center">
                            {{$order->firstName}} {{$order->lastName}} <br>
                            {{$order->service}}<br>
                            <a href="{{Route('orders.edit', $order->orderId)}}">{{$order->contractNumber}}</a>
                        </td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                @php 
                    $countTds = 0;
                    $timeControl = null;    
                @endphp
                @for ($i=0; $i<count($ordersToBook); $i++)
                                                         
                        @if ($timeControl == $ordersToBook[$i][1]['timeSchedule'])
                            
                            <td>
                                
                                <input type="hidden" name="ordersId[]" value="{{ $ordersToBook[$i][0]['orderId'] }}">
                                
                                @for ($role=0; $role < count($ordersToBook[$i][2]['roles']); $role++)
                                <select class="custom-select custom-select-sm" name="orderId_{{ $ordersToBook[$i][0]['orderId'] }}_num_{{$ordersToBook[$i][2]['roles'][$role]->number}}_roleId_{{ $ordersToBook[$i][2]['roles'][$role]->roleId }}_resourceId"> 
                                  <option value="">{{ $ordersToBook[$i][2]['roles'][$role]->name }}</option>
                                    @for ($resource=0; $resource < count($ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId]); $resource++)
                                        <option value="{{ $ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId][$resource]->resourceId }}" @if(Request("orderId_".$ordersToBook[$i][0]['orderId']."_num_" . $ordersToBook[$i][2]['roles'][$role]->number . "_roleId_".$ordersToBook[$i][2]['roles'][$role]->roleId."_resourceId")==$ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId][$resource]->resourceId) selected @endif>
                                            {{ $ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId][$resource]->resourceName }}
                                        </option>
                                    @endfor
                                </select>
                                
                                @endfor
                            </td>
                        
                        @php 
                            $countTds = $countTds+1;
                            
                        @endphp
                    
                        @else
                            <tr><td>{{ $ordersToBook[$i][1]['timeSchedule'] }}</td>
                            @for ($t=0; $t < $countTds; $t++)
                                <td>&nbsp;</td>
                            @endfor
                           <td>
                                
                                <input type="hidden" name="ordersId[]" value="{{ $ordersToBook[$i][0]['orderId'] }}">
                                
                                @for ($role=0; $role < count($ordersToBook[$i][2]['roles']); $role++)
                                <select class="custom-select custom-select-sm" name="orderId_{{ $ordersToBook[$i][0]['orderId'] }}_num_{{$ordersToBook[$i][2]['roles'][$role]->number}}_roleId_{{ $ordersToBook[$i][2]['roles'][$role]->roleId }}_resourceId"> 
                                  <option value="">{{ $ordersToBook[$i][2]['roles'][$role]->name }}</option>
                                    @for ($resource=0; $resource < count($ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId]); $resource++)
                                        <option value="{{ $ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId][$resource]->resourceId }}" @if(Request("orderId_".$ordersToBook[$i][0]['orderId']."_num_" . $ordersToBook[$i][2]['roles'][$role]->number . "_roleId_".$ordersToBook[$i][2]['roles'][$role]->roleId."_resourceId")==$ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId][$resource]->resourceId) selected @endif>
                                            {{ $ordersToBook[$i][3]['resources'][$ordersToBook[$i][2]['roles'][$role]->roleId][$resource]->resourceName }}
                                        </option>
                                    @endfor
                                </select>
                                
                                @endfor
                            </td>
                            @php
                                $timeControl = $ordersToBook[$i][1]['timeSchedule'];
                                $countTds = $countTds+1;
                            @endphp
                        @endif
                    
            
                    
                
                @endfor
                    
                </tbody>
            </table>
            
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <td><button type="submit" class="btn btn-primary">Save Changes</button></td>
                    </tr>
                </thead>
            </table>

            </form>

             @else
    
                <table class="table table-striped text-center">
                    
                    <tr>
                      <td>
                        NO ORDERS TO BOOK
                    </td>
                    
                    </tr>
                    
                </table>
    
    
                
             @endif
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection
