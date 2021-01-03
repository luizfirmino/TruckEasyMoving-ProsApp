@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit a Resource</h2>
  </div>
</div>
        
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br /> 
            @endif
            <form method="post" action="{{ route('resource.update', [$resource->orderId,$resource->resourceId]) }}">
                @csrf
                
                <div class="form-group">    
                  <label for="first_name">Resource:</label>
                    <select class="form-control" name="resourceId" readonly>
                      @foreach($comboResources as $item)
                        <option @if($item->resourceId==$resource->resourceId)selected @endif>{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">    
                      <label for="first_name">Role:</label>
                      <select class="form-control" name="roleId">
                          @foreach($comboRoles as $item)
                            <option value="{{$item->roleId}}" @if($item->roleId==$resource->roleId)selected @endif>{{$item->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="city">Confirmed?:</label>
                      <input type="radio" name="accepted" value="1" @if($resource->accepted==1)checked @endif/> Yes 
                      <input type="radio" name="accepted" value="0" @if($resource->accepted==0)checked @endif/> No
                    </div>
                  <div class="form-group">
                      <label for="city">Check in:</label>
                      <input type="time" class="form-control" name="timeStarts" value="{{$resource->timeStarts}}"/>
                  </div>
                  <div class="form-group">
                      <label for="email">Check out:</label>
                      <input type="time" class="form-control" name="timeEnds" value="{{$resource->timeEnds}}"/>
                  </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <br><br>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
