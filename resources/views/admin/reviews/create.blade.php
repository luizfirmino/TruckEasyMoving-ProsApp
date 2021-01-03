@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Create a Review</h2>
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
              </div><br />
            @endif
              <form method="post" action="{{ route('reviews.store', [request()->route('orderId')]) }}">
                  @csrf
                  <div class="form-group">
                      <label for="stars">Stars:</label>
                      <input type="radio" name="stars" value="1"> 1
                      <input type="radio" name="stars" value="2"> 2
                      <input type="radio" name="stars" value="3"> 3
                      <input type="radio" name="stars" value="4"> 4
                      <input type="radio" name="stars" value="5"> 5
                  </div>
                  <div class="form-group">    
                      <label for="review">Review:</label>
                      <textarea class="form-control" name="review"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="hourRate">Display on WebSite:</label>
                      <input type="checkbox" name="onwebsite" value="1"/> Yes
                      <input type="checkbox" name="onwebsite" value="0"/> No
                  </div>
                  <div class="form-group">    
                      <label for="review">Date:</label>
                      <input type="date" class="form-control" name="created_at" />
                  </div>
                  <button type="submit" class="btn btn-primary">Add Review</button>
              </form>
            <br>
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
