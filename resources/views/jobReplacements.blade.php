@extends('layouts.app')

@section('content')

<div class="page-header">
  <div class="container-fluid">
    <h2 class="h5 no-margin-bottom">Replacements History</h2>
  </div>
</div>
        
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
        
        <!-- JOBS TO DO -->
        <div class="col-lg-12">
            <div class="checklist-block block">

                @if(count($replacements) > 0) 
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <td>Job</td>
                                <td>Notes</td>
                                <td class="d-none d-sm-table-cell">Created at</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($replacements as $item)
                        <tr>
                            <td class="text-small">
                                {{ $item->customerName }}<br>
                                {{ $item->service }}<br>
                                {{ $item->dateScheduleFormated }}<br>
                                {{ $item->timeScheduleAMPM }}
                            </td>
                            <td>{{ $item->notes }}</td>
                            <td class="d-none d-sm-table-cell">{{ $item->created_at }}</td>
                            <td>
                                @if ($item->active == '1')
                                    Active
                                @else
                                    Closed
                                @endif
                            </td>
                            <td><a href="jobReplacement/{{$item->replacementId}}/status"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">{{ $replacements->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                @else
                    NO REPLACEMENTS FOUND
                @endif
            </div>
        <!-- /JOBS TO DO -->
        </div>

    </div>
  </div>
</section>
@endsection
