@extends('layouts.app')

@section('content')

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- JOBSHEET -->
                    <div class="panel">
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

                                    @if($revisions->count() > 0)
                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <i class="fa fa-warning"></i> {{ strtoupper($revisions->first()->note) }}
                                        </div>
                                    @endif

                                    @include('_show.jobsheet')

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- END JOBSHEET -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{asset('vendor/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/cleave.js/cleave.min.js') }}"></script>

@endsection