@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Reports -> Orders By Source</h2>
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
                    <form method="post" name="search" id="search" action="{{ route('reports.ordersBySource')}}">
                    @csrf
                    <tr>
                        <td>
                            <div class="form-group">    
                            <select class="form-control" name="q_year" onchange="document.search.submit();">
                                <option value="">...</option>
                              @foreach($comboYears as $item)
                                <option value="{{$item->year}}" @if($item->year==Request('q_year'))selected @endif>{{$item->year}}</option>
                              @endforeach
                            </select>
                          </div>
                        </td>                        
                    </tr>
                    </form>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="12" align="center">Months</td>
                    </tr>
                    <tr>
                        <td>Sources</td>
                      @foreach($comboMonths as $item)
                        <td align="center">{{$item->month}}</td>
                      @endforeach
                    </tr>
                </thead>
                <tbody>
                
                <?php $source = ""; ?>
                @foreach ($results as $order)
                <?php 
                if ($source != $order->source){
                if (!($source == "")){ echo "</tr>"; }
                echo "<tr>";
                echo "<td>{$order->source}</td>";
                $source = $order->source;
                }?>
                <td align="center">
                    @if($order->orders == 0) 
                        -
                    @else
                        {{$order->orders}} 
                    @endif
                </td>
                @endforeach
                </tr>    
                </tbody>
            </table>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
