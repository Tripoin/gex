@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
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
                            <div class="tab-content-1">
                                <div role="tabpanel" class="tab-pane active" id="jobsheetlist">

                                    {!! Form::model($jobsheet, ['url'=>route('marketing.jobsheet.update', $jobsheet->id),'method'=>'put', 'class'=>'form-horizontal']) !!}

                                        {{ csrf_field() }}
                                        @include('_show.jobsheet', [$reimbursements])

                                    {!! Form::close() !!}

                                    @include('jobsheet.decline', [$jobsheet->id])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    @include('_form.script_marketing')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

@endsection
