@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit a Customer</h2>
  </div>
</div>
        
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">

        <div class="col-lg-6">
        
            
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
            <form method="post" action="{{ route('services.update', $data->orderServiceId) }}">
                @method('PATCH') 
                @csrf
                
                <div class="form-group">
                    <label for="active">Active:</label>
                    <input type="radio" name="active" value="1" @if($data->active=="1")checked @endif/> Yes
                    <input type="radio" name="active" value="0" @if($data->active=="0")checked @endif /> No
                </div>
                
                
                <div class="form-group">    
                  <label for="service">Service Name:</label>
                  <input type="text" class="form-control" name="service" value="{{ $data->service }}" required />
              </div>
              <div class="form-group">    
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" required>{{ $data->description }}</textarea>
              </div>
                  
              <div class="form-group">
                  <label for="hourRate">Hour Rate:</label>
                  <input type="number" size="8" step="0.01" class="form-control" name="hourRate" value="{{ $data->hourRate }}" required />
              </div>
              <div class="form-group">
                  <label for="minimumHours">Minimum hours:</label>
                  <input type="number" class="form-control" name="minimumHours" value="{{ $data->minimumHours }}" required />
              </div>
                <div class="form-group">
                      <label for="minuteIncrements">Minute Increments:</label>
                      <input type="number" class="form-control" name="minuteIncrements" value="{{ $data->minuteIncrements }}" required />
                  </div>
                <div class="form-group">    
                   <label for="preparation">Preparation:</label>
                   <textarea class="form-control" name="preparation" required>{{ $data->preparation }}</textarea>
               </div>
                
                
                <div class="form-group">
                    <label for="roles">Roles associated to this service:</label><br>
                    <select id="comboRoles" name="comboRoles" class="form-control">
                    @foreach($comboRoles as $item)
                        <option value="{{$item->roleId}}">{{$item->name}}</option>
                    @endforeach
                    </select>
                    <button type="button" id="btnAddServiceRoles" class="btn btn-primary">Add Role</button>
                    <br />  <br />  

                    <select name="roles[]" id="roles" multiple class="form-control" required>
                    @foreach($serviceRoles as $item)
                        <option value="{{$item->roleId}}" selected>{{$item->name}}</option>
                    @endforeach
                    </select>
                    <button type="button" id="btnDeleteServiceRoles" class="btn btn-primary">Delete</button>
                 </div> 
                
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
