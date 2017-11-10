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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">INVOICE {{ $invoice->code }}</a>
	                                </li>
	                            </ul>

	                            <!-- Tab panes -->
	                            <div class="tab-content tab-content-1">
	                                <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
	                                    @include('receivable._showdetail')
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

{{-- Modal Cancel --}}
<div class="modal fade" id="modal-cancel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cancel Invoice</h4>
            </div>
            <form action="" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">REASON</label>
                        <textarea type="text" class="form-control" id="" placeholder="Input reason"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-decline">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Decline Invoice</h4>
            </div>
            {!! Form::open(['url' => route('approverec.decline'), 'method' => 'post','class'=>'']) !!}
                <div class="modal-body">
                    {!! Form::hidden('jobsheet_id', $jobsheet->id) !!}
                    {!! Form::hidden('sender_id', Auth::user()->id) !!}
                    <div class="form-group">
                        <label for="">RETURN TO</label>
                        <select name="receiver" id="" class="form-control input-sm">
                            <option value="{{ $jobsheet->operation_id }}">OPERATION</option>
                            <option value="{{ $jobsheet->marketing_id }}">MARKETING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">NOTE</label>
                        <textarea name="note" type="text" class="form-control" id="" placeholder="Input Note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('script')
	
	@include('invoice._script')
    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{asset('vendor/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/cleave.js/cleave.min.js') }}"></script>

@endsection