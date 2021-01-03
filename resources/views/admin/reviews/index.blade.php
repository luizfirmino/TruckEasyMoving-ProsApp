@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Reviews</h2>
  </div>
</div>
        
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
            
            
            @if(!empty($data)) 
            
            <table class="table table-striped">
                <thead>
                    <tr>
                      <td nowrap>Order Id</td>
                      <td class="d-none d-sm-table-cell">Review</td>
                      <td class="d-none d-sm-table-cell">Stars</td>
                      <td class="d-none d-sm-table-cell text-nowrap">On Web Site</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                <tr>
                    <td><a href="{{ route('orders.edit',$item->orderId)}}">{{ $item->orderId }}</a></td>
                    <td class="d-none d-sm-table-cell">{{ $item->review }}</td>
                    <td class="d-none d-sm-table-cell text-center">{{ $item->stars }}</td>
                    <td class="d-none d-sm-table-cell text-center">
                        @if($item->onwebsite=="1") 
                            <i class="fa fa-check" aria-hidden="true"></i>
                        @else 
                            <i class="fa fa-times active" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('reviews.edit',$item->orderId)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('reviews.destroy', $item->orderId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6">{{ $data->links() }}</td>
                </tr>
            </table>
            
            @else
                NO REVIEWS FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
