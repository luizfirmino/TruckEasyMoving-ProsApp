@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Reports -> Payment By Resource</h2>
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
                    <form method="post" name="search" id="search" action="{{ route('reports.paymentsByResource')}}">
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
                        <td>
                            <div class="form-group">    
                            <select class="form-control" name="q_resourceId">
                                <option value="">...</option>
                              @foreach($comboResources as $item)
                                <option value="{{$item->resourceId}}" @if($item->resourceId==Request('q_resourceId'))selected @endif>{{$item->name}}</option>
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
                      <td>Resource</td>
                      <td>Category</td>
                      <td align="right">Total</td>
                    </tr>
                </thead>
                <tbody>                
                @foreach ($results as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category }}</td>
                    <td align="right">${{ $item->total }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
