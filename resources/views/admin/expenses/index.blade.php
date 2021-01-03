@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Administrative Expenses</h2>
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
            <table class="table table-striped">
                <thead>
                    <form action="{{ route('expenses.store') }}" method="post">
                    @csrf
                    <tr>
                        <td class="d-none d-sm-table-cell">&nbsp;</td>
                        <td>
                            <select class="form-control" name="revenueCategoryId">
                                <option value="">Select</option>
                              @foreach($comboRevenueCategories as $item)
                                <option value="{{$item->revenueCategoryId}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </td>
                        <td><input type="date" class="form-control" name="date"/></td>
                        <td><input type="number" step="0.01" class="form-control" name="value"/></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </td>
                    </tr>
                    </form>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Category</td>
                      <td>Date</td>
                      <td>Amount</td>
                      <td>Actions</td>
                    </tr>
                        
                </thead>
                <tbody>
            @if(!empty($expenses)) 
                
                @foreach ($expenses as $item)
                <tr>
                    <td class="d-none d-sm-table-cell">{{ $item->revenueId }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->date }}</td>
                    <td>${{ $item->value }}</td>
                    <td>
                        <form action="{{ route('expenses.destroy', $item->revenueId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>                   
                </tr>
                @endforeach
                <tr>
                    <td colspan="8">{{ $expenses->links() }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="8">NO EXPENSES FOUND</td>
                </tr>
            @endif    
                </tbody>
            </table>
            
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
