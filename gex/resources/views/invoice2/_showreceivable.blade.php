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
	                                    @include('invoice.detailinvoice')
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
            <form action="{{ route('invoice.cancel', [$invoice->id, $invoice->type]) }}" method="POST" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">REASON</label>
                        <textarea type="text" name="reason" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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