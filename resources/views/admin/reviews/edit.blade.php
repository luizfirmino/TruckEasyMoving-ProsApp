@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit a Review</h2>
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
            <form method="post" action="{{ route('reviews.update', $data->orderId) }}">
                @method('POST') 
                @csrf
              <div class="form-group">    
                  <label for="stars">Stars:</label>
                  <input type="radio" name="stars" value="1" @if($data->stars=="1") checked @endif > 1
                  <input type="radio" name="stars" value="2" @if($data->stars=="2") checked @endif > 2
                  <input type="radio" name="stars" value="3" @if($data->stars=="3") checked @endif > 3
                  <input type="radio" name="stars" value="4" @if($data->stars=="4") checked @endif > 4
                  <input type="radio" name="stars" value="5" @if($data->stars=="5") checked @endif > 5
              </div>
                  
              <div class="form-group">
                  <label for="review">Review:</label>
                  <textarea class="form-control" name="review">{{ $data->review }}</textarea>
              </div>
                <div class="form-group">
                    <label for="onwebsite">Display on WebSite:</label>
                    <input type="radio" name="onwebsite" value="1" @if($data->onwebsite=="1")checked @endif/> Yes
                    <input type="radio" name="onwebsite" value="0" @if($data->onwebsite=="0")checked @endif /> No
                </div>
                <div class="form-group">    
                      <label for="created_at">Date:</label>
                      {{ $data->created_at }}
                  </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
