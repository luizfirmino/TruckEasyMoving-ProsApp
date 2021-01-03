@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Replacements</h2>
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
            
            
             @if(count($replacements) > 0) 
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Resource</td>
                                <td>Notes</td>
                                <td class="d-none d-sm-table-cell">Created at</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($replacements as $item)
                        <tr>
                            <td>{{ $item->contractNumber }}</td>
                            <td>{{ $item->resourceName }}</td>
                            <td>{{ $item->notes }}</td>
                            <td class="d-none d-sm-table-cell">{{ $item->created_at }}</td>
                            <td>
                                @if ($item->active == '1')
                                    Active
                                @else
                                    Closed
                                @endif
                            </td>
                            <td><a href="{{ route ('replacements.show', $item->replacementId)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">{{ $replacements->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                @else
                    NO REPLACEMENTS FOUND
                @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
