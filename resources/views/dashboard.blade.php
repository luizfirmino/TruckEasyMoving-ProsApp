@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Dashboard</h2>
  </div>
</div>


<!-- MENU DE NAVEGAÇÃO CONTEÚDO CENTRAL -->
<section class="no-padding-top no-padding-bottom">
  <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-sm-6">

                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Month overview</button>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu">
                    @foreach ($months as $m)
                        <a class="dropdown-item {{ ( $m->month == $overview_month) ? 'active' : "" }}" href="{{route('overview', $m->month)}}">{{$m->name}}</a>
                    @endforeach
                  </div>
                </div>
            </div>

        </div>    

        <div class="collapse show" id="collapseExample">

            <div class="row">

                <!-- COMPLETED JOBS -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <i class="fa fa-2x fa-check-square-o" aria-hidden="true"></i><strong class="d-none d-sm">Completed jobs</strong>
                            </div>
                            <div class="number dashtext-1">{{$overview[0]->completedJobs}}</div>
                            <a data-toggle="tooltip" data-placement="left" title="Number of jobs completed"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- TOTAL HOURS -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <i class="fa fa-2x fa-clock-o" aria-hidden="true"></i><strong class="d-none d-sm">Total Hours</strong>
                            </div>
                            <div class="number dashtext-1">{{$overview[0]->totalHours}}</div>
                            <a data-toggle="tooltip" data-placement="left" title="Total of hours worked"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- WALLET -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <i class="fa fa-2x fa-university" aria-hidden="true"></i><strong class="d-none d-sm">Wallet</strong>
                            </div>
                            <div class="number dashtext-1">${{$overview[0]->totalPaid}}</div>
                            <a data-toggle="tooltip" data-placement="left" title="Amount paid including tips (it does NOT include tips in cash from customers)"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- HOUR PAID -->
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <i class="fa fa-2x fa-plus-square-o" aria-hidden="true"></i><strong class="d-none d-sm">Hour Net</strong>
                            </div>
                            <div class="number dashtext-1">${{$overview[0]->netHourPaid}}</div>
                            <a data-toggle="tooltip" data-placement="left" title="Your hourly net value"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            <!-- /BOTÕES DE ACESSO RAPIDO Finished -->
            </div>

        </div>

  </div>
</section>
<!-- /MENU DE NAVEGAÇÃO CONTEÚDO CENTRAL -->


<!-- TODAY'S JOB -->
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-6">
            
            <!-- TODAYS JOB -->
            <div class="checklist-block block">
                <div class="title">
                    <strong>TODAY's JOBS</strong>
                </div>

                 @if(count($jobsToday) > 0) 
                 <div class="checklist">
                    @foreach ($jobsToday as $job)
                    <div class="item">
                        <span class="lead"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeSchedule }}</span><br/>
                        <b>{{ $job->firstName }} {{ $job->lastName }}</b><br>
                        <small>{{ $job->service }}</small><br>
                        <i class="fa fa-toggle-on" aria-hidden="true"></i> <a href="/jobToday/{{ $job->orderId }}">Job Details</a>
                    </div>
                    @endforeach
                </div>
                @else
                    NO JOBS ASSIGNED TODAY
                @endif
                
            </div>
            <!-- /TODAYS JOB -->
            
            
            <!-- REPLACEMENTS ACTIVE -->
            @if(count($replacements) > 0)
            <div class="checklist-block block">
                <div class="title">
                    <strong>REPLACEMENT's ACTIVE</strong>
                </div>
                <div class="checklist">
                    You have replacement request(s) active, see the details below:
                    @foreach ($replacements as $item)
                    <div class="item">
                        <span class="lead"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $item->created_at }}</span><br/>
                        <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $item->notes }}<br/>
                        <i class="fa fa-exchange" aria-hidden="true"></i> <a href="/jobReplacement/{{ $item->replacementId }}/status">Check the status</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
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
                  plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                  defaultDate: '@php echo date("Y-m-d") @endphp',
                  editable: false,
                  eventLimit: true, // allow "more" link when too many events
                  header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                  },
                  events: [

                    @foreach ($jobs as $job)
                    {
                      title: '{{ $job->firstName }}',
                      start: '{{ $job->dateSchedule }}T{{ $job->timeScheduleCalendar }}',
                        url: '/jobUpcoming/{{ $job->orderId }}'
                    },
                    @endforeach

                  ]
                });

                calendar.render();
              });
                
            </script>
            <div id='calendar'></div><br><br>
        </div>

        @if(count($pendings) > 0)     
        
        <!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jobsPendingConfirmationModal">
          Launch demo modal
        </button-->
        
        <!-- Modal -->
        <div class="modal" id="jobsPendingConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="jobsPendingConfirmationModal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Something needs your attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <small class="text-muted text-sm">You have jobs pending confirmation waiting for you.</small><br /><br />
                    @foreach ($pendings as $job)
                    <div class="row">
                        <div class="col-8">
                            <strong>{{ $job->firstName }} {{ $job->lastName }}</strong><br>
                            <small>
                            <i class="fa fa-calendar" aria-hidden="true"></i> {{ $job->dateScheduleFormated }}<br/>
                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $job->timeSchedule }}<br/>
                            </small>
                        </div>
                        <div class="col-4">
                            <a href="/jobUpcoming/{{ $job->orderId }}" class="btn btn-primary">See details</a>
                        </div>
                    </div>
                    @endforeach
              </div>
            </div>
          </div>
        </div>
        @endif
        
                
    </div>
  </div>
</section>
<!-- /TODAY'S JOB -->

@endsection



                
                

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
