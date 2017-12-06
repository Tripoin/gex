@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- JOB SHEET -->
                    <div class="panel">
                        <div class="panel-body no-padding">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-1" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">{{ $jobsheet->code }}</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tab-content-1">
                                    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">

                                        @include('_show.jobsheet', [$jobsheet->id])

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END JOB SHEET -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

@endsection