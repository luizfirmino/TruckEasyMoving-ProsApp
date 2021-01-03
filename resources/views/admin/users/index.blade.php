@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Users</h2>
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
            
            @if(!empty($users)) 
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell">ID</td>
                        <td></td>
                      <td>Name</td>
                      <td class="d-none d-sm-table-cell">Email</td>
                      <td class="d-none d-sm-table-cell">Phone Number</td>
                      <td class="d-none d-sm-table-cell">Profile</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $item)
                <tr>
                    <td class="d-none d-sm-table-cell">{{ $item->id }}</td>
                    <td style="width: 100px;">
                        @if (!empty($item->profilePicture))
                            <img src="/storage/app/public/{{ $item->profilePicture }}" class="img-fluid rounded-circle">
                        @else
                            <img src="/resources/img/no-avatar.png" alt="..." class="img-fluid rounded-circle">
                        @endif                    
                    </td>
                    
                    <td>{{ $item->firstName }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->email }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->phoneNumber }}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->profile }}</td>
                    <td>
                        <a href="{{ route('users.edit', $item->id)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="7">{{ $users->links() }}</td>
                </tr>
            </table>
            
            @else
                NO USERS FOUND
            @endif
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
