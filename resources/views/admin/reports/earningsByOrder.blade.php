@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Reports -> Earnings By Order</h2>
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
            
            <table class="table table-striped">
                <thead>
                    <form method="post" name="search" id="search" action="{{ route('reports.earningsByOrder')}}">
                    @csrf
                    <tr>
                        <td>
                            <div class="form-group">    
                            <select class="form-control" name="q_year">
                                <option value="">...</option>
                              @foreach($comboYears as $item)
                                <option value="{{$item->year}}" @if($item->year==Request('q_year'))selected @endif>{{$item->year}}</option>
                              @endforeach
                            </select>
                          </div>
                        </td>
                        <td>
                            <div class="form-group">    
                            <select class="form-control" name="q_month">
                                <option value="">...</option>
                              @foreach($comboMonths as $item)
                                <option value="{{$item->month}}" @if($item->month==Request('q_month'))selected @endif>{{$item->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </td>
                        <td class="d-none d-sm-table-cell">&nbsp;</td>
                        <td>
                            <a onclick="document.search.submit();" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    </form>
                    <tr>
                      <td>#</td>
                      <td>Customer</td>
                      <td>Service</td>
                      <td>Duration</td>
                      <td align="right">Total</td>
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0; ?>
                @foreach ($results as $order)
                <?php $total = $total + $order->total ?>      
                <tr>
                    <td><a href="{{ route('orders.edit', $order->orderId)}}">{{ $order->contractNumber }}</a></td>
                    <td>{{ $order->customerName }}</td>
                    <td>{{ $order->service }}</td>
                    <td>{{ $order->duration }}</td>
                    <td align="right">${{ $order->total }}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">TOTAL</td>
                        <td colspan="4" align="right">$<?=number_format($total,2)?></td>
                    </tr>
                </tfoot>
            </table>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
