@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Reports</h2>
  </div>
</div>
        
<!-- CONTAINER -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

       
        <div class="col-lg-6">
            <div class="checklist-block block">
            <div class="title">
                <strong>Financial</strong>
            </div>

                <table class="table table-striped">
                    <tbody> 
                        <tr>
                            <td><a href="{{ route('reports.accountingGroups')}}">Accounting Groups</a></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('reports.earningsByOrder')}}">Earnings by Order</a></td>
                        </tr>
                    </tbody>     
                </table>         
            </div>    
        
        </div>
        
        
        <div class="col-lg-6">
            <div class="checklist-block block">
            <div class="title">
                <strong>Metrics</strong>
            </div>

            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><a href="{{ route('reports.earningsByOrder')}}">Orders By Days of the Week</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{ route('reports.ordersBySource')}}">Orders By Source</a></td>
                    </tr>
                </tbody>     
            </table>  
            </div>   
        
        </div>
        
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
