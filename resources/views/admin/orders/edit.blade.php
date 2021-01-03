@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Edit Order #{{$order->contractNumber}}</h2>
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
            
            @if(session()->get('error'))
                <div class="alert alert-warning">
                    {{ session()->get('error') }}  
                </div>
            @endif
            
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
            @endif
            
            <form method="post" action="{{ route('orders.update', $order->orderId) }}">
                @method('PATCH') 
                @csrf
                
                
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                          <label for="first_name">Status:</label>
                            <select class="form-control" name="orderStatusId">
                              @foreach($comboStatus as $item)
                                <option value="{{$item->orderStatusId}}" @if($item->orderStatusId==$order->orderStatusId)selected @endif>{{$item->status}}</option>
                              @endforeach
                            </select>
                          </div>
                    </div>
                    
                    <div class="col">
                      <div class="form-group">
                          <label for="first_name">Service:</label>
                          <select class="form-control" name="orderServiceId">
                              @foreach($comboServices as $item)
                                <option value="{{$item->orderServiceId}}" @if($item->orderServiceId==$order->orderServiceId)selected @endif>{{$item->service}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                          <label for="city">Date:</label>
                          <input type="date" class="form-control" name="dateSchedule" value="{{$order->dateSchedule}}"/>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                          <label for="email">Time:</label>
                          <input type="time" class="form-control" name="timeSchedule" value="{{$order->timeSchedule}}"/>
                      </div>
                    </div>
                </div>
                
                
                <div class="form-row">
                    <div class="col">
                      <div class="form-group">    
                          <label for="first_name">Source:</label>
                          <select class="form-control" name="orderSourceId">
                              @foreach($comboSources as $item)
                                <option value="{{$item->orderSourceId}}" @if($item->orderSourceId==$order->orderSourceId)selected @endif>{{$item->name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="duration">Duration <smaill>(hours)</smaill>:</label>
                            <input type="number" class="form-control" size="4" step="0.01"  name="duration" value="{{$order->duration}}"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name">Customer:</label>
                            <div class="form-row">
                                <div class="col">
                                  <select class="form-control" name="customerId">
                                      @foreach($comboCustomers as $item)
                                        <option value="{{$item->customerId}}" @if($item->customerId==$order->customerId)selected @endif>{{$item->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col">
                                  <a href="{{ route('customers.edit',$order->customerId)}}" class="btn btn-primary"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>
                              </div>
                          </div>      
                      </div>
                    </div>    
                    <div class="col">
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                            <label class="form-control">{{$order->phoneNumber}}</label>
                        </div>
                    </div>
                </div>    
                  
                
                <div class="form-group">
                      <label for="email">Notes:</label>
                      <textarea class="form-control" name="notes" cols="200" rows="2">{{$order->notes}}</textarea>
                  </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('orders.payment',$order->orderId)}}" class="btn btn-primary">Process Payments</a>
                <a href="{{ route('reviews.create',$order->orderId)}}" class="btn btn-primary">Review</a>
            </form>
            <br><br>

            <big>Addresses</big>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell" colspan="7"></td>
                        <td colspan="2"><a href="{{ route('address.create', [$order->orderId])}}" class="btn btn-primary">New</a></td>
                    </tr>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Address</td>
                      <td class="d-none d-sm-table-cell">City</td>
                      <td class="d-none d-sm-table-cell">State</td>
                      <td class="d-none d-sm-table-cell">Zipcode</td>
                      <td class="d-none d-sm-table-cell">Order</td>
                      <td class="d-none d-sm-table-cell">Notes</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>

                <tbody>
                @if(!empty($orderAddresses)) 
                    @foreach ($orderAddresses as $address)
                    <tr>
                        <td class="d-none d-sm-table-cell">{{ $address->addressId }}</td>
                        <td>{{ $address->address }} {{ $address->addressComp }}</td>
                        <td class="d-none d-sm-table-cell">{{ $address->city }}</td>
                        <td class="d-none d-sm-table-cell">{{ $address->state }}</td>
                        <td class="d-none d-sm-table-cell">{{ $address->zipcode }}</td>
                        <td class="d-none d-sm-table-cell">{{ $address->order }}</td>
                        <td class="d-none d-sm-table-cell">{{ $address->notes }}</td>
                        <td>
                            <a href="{{ route('address.edit', [$address->orderId, $address->addressId])}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('address.destroy', [$order->orderId, $address->addressId])}}" method="post">
                                <input type="hidden" name="addressId" value="{{ $address->addressId }}">
                                <input type="hidden" name="orderId" value="{{ $order->orderId }}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">NO ADDRESSES ASSOCIATED TO THE ORDER YET</td>
                    </tr> 
                @endif
                </tbody>
            </table>
            <br><br>
            
            
            <big>Resources</big>
            
            <table class="table table-striped">
                <form method="post" action="{{ route('resource.store', $order->orderId) }}">
                <input type="hidden" name="orderId" value="{{ $order->orderId }}">
                @csrf
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell">&nbsp;</td>
                        <td>
                            <select class="form-control" name="resourceId">
                                 <option value="">Select</option>
                              @foreach($comboResources as $item)
                                <option value="{{$item->resourceId}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="roleId">
                                <option value="">Select</option>
                              @foreach($comboRoles as $item)
                                <option value="{{$item->roleId}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </td>
                        <td class="d-none d-sm-table-cell" colspan="2">&nbsp;</td>
                        <td colspan="3"><button type="submit" class="btn btn-primary">Add</button></td>
                    </tr>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Name</td>
                      <td>Role</td>
                      <td class="d-none d-sm-table-cell">Phone Number</td>
                      <td class="d-none d-sm-table-cell" align="center">Confirmed?</td>
                      <td class="d-none d-sm-table-cell">Check in/out</td>
                      <td colspan="2">Actions</td>
                    </tr>
                </thead>
                </form>
                <tbody>
                @if(!empty($orderResources)) 
                    @foreach ($orderResources as $resource)
                    <tr>
                        <td class="d-none d-sm-table-cell">{{ $resource->resourceId }}</td>
                        <td>{{ $resource->firstName }} {{ $resource->lastName }}</td>
                        <td>{{ $resource->role }}</td>
                        <td class="d-none d-sm-table-cell">{{ $resource->phoneNumber }}</td>
                        <td class="d-none d-sm-table-cell" align="center">
                            @if($resource->accepted==null) 
                                <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                            @elseif($resource->accepted=="1") 
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else 
                                <i class="fa fa-times active" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td class="d-none d-sm-table-cell">{{ $resource->timeStarts }} / {{ $resource->timeEnds }}</td>
                        <td>
                            <a href="{{ route('resource.edit', [$resource->orderId, $resource->resourceId])}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('resource.destroy', $order->orderId)}}" method="post">
                                <input type="hidden" name="resourceId" value="{{ $resource->resourceId }}">
                                <input type="hidden" name="orderId" value="{{ $order->orderId }}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">NO RESOURCES ASSOCIATED TO THE ORDER YET</td>
                    </tr> 
                @endif
                </tbody>
            </table>
            <br><br>
            
            
            <big>Equipment</big>
            
            <table class="table table-striped">
                <form method="post" action="{{ route('equipment.store', $order->orderId) }}">
                @csrf
                <thead>
                    <tr>
                        <td>
                            <select class="form-control" name="equipmentId">
                                 <option value="">Select</option>
                              @foreach($comboEquipments as $item)
                                <option value="{{$item->equipmentId}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </td>
                        <td colspan="2">
                            <textarea name="notes" class="form-control" placeholder="Notes (not required)"></textarea>
                        </td>
                        <td><button type="submit" class="btn btn-primary">Add</button></td>
                    </tr>
                </thead>
                </form>
                <tbody>
                @if(!empty($orderEquipments)) 
                    @foreach ($orderEquipments as $equipment)
                    <tr>
                        <td>{{ $equipment->name }}</td>
                        <td>{{ $equipment->address }} {{ $equipment->addressComp }} {{ $equipment->city }} {{ $equipment->state }} {{ $equipment->zipcode }}</td>
                        <td>{{ $equipment->notes }}</td>
                        <td>
                            <form action="{{ route('equipment.destroy', $order->orderId)}}" method="post">
                                <input type="hidden" name="equipmentId" value="{{ $equipment->equipmentId }}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">NO EQUIPMENTS ASSOCIATED TO THE ORDER YET</td>
                    </tr> 
                @endif
                </tbody>
            </table>
            <br><br>
            
            
            
            <big>Files</big>
            
            <table class="table">
                <form method="post" action="{{ route('file.store', $order->orderId) }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <thead>
                    <tr>
                        <td>
                            <input type="file" name="file" class="form-control" required>
                            <textarea name="notes" class="form-control" placeholder="Notes (not required)"></textarea>
                        </td>
                        <td><button type="submit" class="btn btn-primary">Add</button></td>
                    </tr>
                </thead>
                </form>
                <tbody>
                @if(!empty($orderFiles))
                <tr>
                    <td colspan="2">
                        <div class="row">
                            @foreach ($orderFiles as $file)
                             <div class="col-lg-2 col-sm-3">
                                <div class="card">
                                    <a href="/storage/app/{{ $file->path }}" target="_blank">
                                        @if (!is_null($file->thumbnail))
                                            <img src="/storage/app/{{ $file->thumbnail }}" class="card-img-top">
                                        @else
                                            <img src="/storage/app/{{ $file->path }}" class="card-img-top">
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">{{$file->notes}}</p>
                                        
                                        <form action="{{ route('file.destroy', $file->fileId)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="orderId" value="{{$file->orderId}}">
                                        <button class="btn btn-danger" style="position:absolute; right: 4px; top: 4px" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </form>
                                        <p class="card-text"><small class="text-muted">Created at {{$file->created_at}}</small></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @else
                    <tr>
                        <td colspan="2">NO FILES ASSOCIATED TO THE ORDER YET</td>
                    </tr> 
                @endif
                </tbody>
            </table>
            <br><br>
            
            
            <big>Cost/Expenses/Payments</big>
            
            <table class="table table-striped">
                <form method="post" action="{{ route('revenue.store', $order->orderId) }}">
                <input type="hidden" name="orderId" value="{{ $order->orderId }}">
                @csrf
                <thead>
                    <tr class="d-none d-sm-table-row">
                        <td>&nbsp;</td>
                        <td>
                            <select class="form-control" name="revenueCategoryId">
                                 <option value="">Select</option>
                              @foreach($comboRevenueCategories as $item)
                                <option value="{{$item->revenueCategoryId}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="resourceId">
                                <option value="">Select</option>
                              @foreach($orderResources as $item)
                                <option value="{{$item->resourceId}}">{{$item->firstName}} {{$item->lastName}}</option>
                              @endforeach
                            </select>
                        </td>
                        <td>&nbsp;</td>
                        <td><input type="number" class="form-control" size="5" step="0.01" name="value"></td>
                        <td><button type="submit" class="btn btn-primary">Add</button></td>
                    </tr>
                    <tr>
                      <td class="d-none d-sm-table-cell">ID</td>
                      <td>Category</td>
                      <td>Resource</td>
                      <td class="d-none d-sm-table-cell">Date</td>
                      <td>Amount</td>    
                      <td class="d-none d-sm-table-cell">Actions</td>
                    </tr>
                </thead>
                </form>
                <tbody>
                @if(!empty($orderRevenues)) 
                    @foreach ($orderRevenues as $item)
                    <tr>
                        <td class="d-none d-sm-table-cell">{{ $item->revenueId }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->resource }}</td>
                        <td class="d-none d-sm-table-cell">{{ $item->date }}</td>
                        <td>{{ $item->value }}</td>
                        <td class="d-none d-sm-table-cell">
                            <form action="{{ route('revenue.destroy', [$order->orderId, $item->revenueId])}}" method="post">
                                
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">NO AMOUNTS ASSOCIATED TO THE ORDER YET</td>
                    </tr> 
                @endif
                </tbody>
            </table>
            <br><br>
            
            
        </div>
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
