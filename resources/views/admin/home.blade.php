@extends('layouts.admin')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Calendar</h2>
  </div>
</div>
        
<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
      
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
    @endif
      
    <div class="row">
        
        <!-- ORDERS IN PROGRESS -->
        <div class="col-lg-6">
            <div class="checklist-block block">
                <div class="title">
                    <strong>ORDERS IN PROGRESS</strong>
                </div>
                <div class="checklist">
                @if(count($ordersInProgress)>0)
                    <table class="table table-sm">
                        <tr>
                            <td>#</td>
                            <td class="d-none d-sm-table-cell">Time</td>
                            <td class="d-none d-sm-table-cell">Customer</td>
                            <td>Status</td>
                        </tr>
                    @foreach ($ordersInProgress as $order)
                        <tr>
                            <td><a href="{{ route('orders.edit', $order->orderId)}}">{{$order->contractNumber}}</a></td>
                            <td class="d-none d-sm-table-cell">{{$order->timeSchedule}}</td>
                            <td class="d-none d-sm-table-cell">{{$order->firstName}}</td>
                            <td>{{$order->status}}</td>
                        </tr>
                    @endforeach
                    </table>    
                @else
                    <div class="item">NO JOBS IN PROGRESS RIGHT NOW</div>
                @endif
                </div>
            </div>
        
            <div class="checklist-block block">
                <div class="title">
                    <strong>ORDERS RECEIVED</strong>
                </div>
                <div class="checklist">
                @if(count($ordersReceived)>0)
                    <table class="table table-sm">
                        <tr>
                            <td>#</td>
                            <td class="d-none d-sm-table-cell">Customer</td>
                            <td>Service</td>
                        </tr>
                    @foreach ($ordersReceived as $order)
                        <tr>
                            <td><a href="{{ route('orders.edit', $order->orderId)}}">{{$order->contractNumber}}</a></td>
                            <td class="d-none d-sm-table-cell">{{$order->firstName}}</td>
                            <td>{{$order->service}}</td>
                        </tr>
                    @endforeach
                    </table>    
                @else
                    <div class="item">NO JOBS IN PROGRESS RIGHT NOW</div>
                @endif
                </div>
            </div>
            
            <div class="checklist-block block">
                <div class="title">
                    <strong>REPLACEMENT(s) ACTIVE</strong>
                </div>
                <div class="checklist">
                @if(count($replacements)>0)
                    <table class="table table-sm">
                        <tr>
                            <td>#</td>
                            <td>Resource</td>
                            <td class="d-none d-sm-table-cell">Notes</td>
                        </tr>
                    @foreach ($replacements as $item)
                        <tr>
                            <td><a href="{{ route('replacements.show', $item->replacementId)}}">{{$item->contractNumber}}</a></td>
                            <td>{{$item->resourceName}}</td>
                            <td class="d-none d-sm-table-cell">{{$item->notes}}</td>
                        </tr>
                    @endforeach
                    </table>    
                @else
                    <div class="item">NO REPLACEMENTS ACTIVE</div>
                @endif
                </div>
            </div>
            
        </div>
        
        
        
        <!-- JOBS TO DO -->
        <div class="col-lg-6">
                    
            <link href='/resources/vendor/fullcalendar/packages/core/main.css' rel='stylesheet' />
            <link href='/resources/vendor/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
            <script src='/resources/vendor/fullcalendar/packages/core/main.js'></script>
            <script src='/resources/vendor/fullcalendar/packages/interaction/main.js'></script>
            <script src='/resources/vendor/fullcalendar/packages/daygrid/main.js'></script>
            <script>

                document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                  plugins: [ 'interaction', 'dayGrid' ],
                  defaultDate: '@php echo date("Y-m-d") @endphp',
                  editable: false,
                  eventLimit: true, // allow "more" link when too many events
                  navLinks: true,
                  navLinkDayClick: function(date, jsEvent) {
                    
                      document.formBooking['q_dateSchedule'].value = [date.getFullYear(), ('0' + (date.getMonth() + 1)).slice(-2), ('0' + date.getDate()).slice(-2)].join('-');
                      document.formBooking.submit();
                  },
                    events: [
                    @foreach ($orders as $order)
                    {
                      title: '{{ $order->firstName }}',
                      start: '{{ $order->dateSchedule }}T{{ $order->timeSchedule }}',
                        url: '/admin/orders/{{ $order->orderId }}/edit',
                    },
                    @endforeach

                  ]
                  
                });

                calendar.render();
              });

            </script>
            <div id='calendar'></div><br><br>
            
            <form id="formBooking" name="formBooking" action="{{Route('booking.index')}}">
                <input type="hidden" name="q_dateSchedule" id="q_dateSchedule" value="">
            </form>
            
        </div>
        
        
                
    </div>
      
      
      <div class="row">
      
      
      <!-- PENDING JOBS -->
        <div class="col-lg-6">
            <div class="checklist-block block">
                <div class="title">
                    <strong>PENDING JOB CONFIRMATIONS</strong>
                </div>
                <div class="checklist">
                @if(count($confirmations) > 0)
                    @foreach ($confirmations as $confirmation)
                        <div class="item">
                             <div class="row">
                                 <div class="col">
                                    {{ $confirmation->resource }}<br>
                                    <small>
                                        {{ $confirmation->customer }}<br>
                                        {{ $confirmation->dateScheduleFormated }}
                                    </small>
                                 </div>
                                 <div class="col">
                                     @if ($confirmation->accepted==="0")
                                        <a class="btn btn-primary" href="{{ route('orders.edit', $confirmation->orderId)}}"><i class="fa fa-times active" aria-hidden="true"></i></a>
                                     @else
                                         <form action="{{ route('home.reminder')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="orderId" value="{{ $confirmation->orderId }}">
                                          <input type="hidden" name="resourceId" value="{{ $confirmation->resourceId }}">
                                          <button class="btn btn-primary" type="submit" title="Reminder"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                        </form>
                                     @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="item">NO JOB CONFIRMATIONS PENDING</div>
                @endif
                </div>
            </div>
        <!-- /JOBS TO DO -->
        </div>
      
        <!-- NEW REVIEWS -->
        <div class="col-lg-6">
            <div class="checklist-block block">
                <div class="title">
                    <strong>NEW REVIEWS</strong>
                </div>
                <div class="checklist">
                @if(count($reviews) > 0)
                    @foreach ($reviews as $item)
                        <div class="item">
                             <div class="row">
                                 <div class="col-3"><small>{{$item->created_at}}</small></div>
                                 <div class="col-7 text-truncate"><small>{{$item->review}}</small></div>
                                 <div class="col-2">
                                     <a class="btn btn-primary" href="{{ route('reviews.edit', $item->orderId)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>                                     
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="item">NO NEW REVIEWS</div>
                @endif
                </div>
            </div>
        <!-- /JOBS TO DO -->
        </div>
          
          
      
      </div>
      
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection

                