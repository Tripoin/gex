@extends('layouts.app')

@section('title', $title)

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
										<a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">{!! strtoupper($title) !!} INDEX</a>
									</li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content tab-content-1">
									<div role="tabpanel" class="tab-pane active" id="jobsheetlist">
										<div class="table-responsive">

											<div class="row">
												<div class="col-sm-8 report-date-range">
													{!! Form::open(['method' => 'GET','class'=>'form-inline']) !!}
													<div class="form-group">
														<input type="text" name="report_from" class="input-sm form-control datepicker-from" value="{!! $reportForm !!}">
														<input type="text" name="report_to" class="input-sm form-control datepicker-to" value="{!! $reportTo !!}">
														<button class="btn btn-sm btn-primary clearfix">Filter</button>
													</div>
													{!! Form::close() !!}
												</div>
												<div class="col-sm-4 pull-right">
													<a href="{!! route('pricing.report.'.$controllerRole, ['isExportExcel'=>1, 'report_from'=>$reportForm, 'report_to'=>$reportTo]) !!}">Excel</a>
													<a href="{!! route('pricing.report.'.$controllerRole, ['isExportPDF'=>1, 'report_from'=>$reportForm, 'report_to'=>$reportTo]) !!}">PDF</a>
												</div>
											</div>
											<div style="margin-bottom: 10px !important;"></div>

											<table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
												<thead>
												<tr>
													<th>NO.</th>
													<th>JOB</th>
													<th>DATE REQUEST</th>
													<th>DETAIL</th>
													<th>VENDOR</th>
													<th>STATUS</th>
												</tr>
												</thead>
												<?php $no = 1; ?>
												<tbody>
												@foreach($requests as $request)
													@php
													// $job = App\Jobsheet::find($request->jobsheet_id);
													// $customer_id = App\MasterCustomer::find($job->customer_id);
													// $poo_id = App\MasterPort::find($job->poo_id);
													// $pod_id = App\MasterPort::find($job->pod_id);

													{{--$pay = App\Payable::find($request->payable_id);
													$doc = App\MasterDocument::find($pay->document_id);
													$vendor = App\MasterVendor::find($pay->vendor_id);--}}

													@endphp
													<tr>
														<td>{{ $no }}</td>
														<td>{{ $request->jobsheet ? $request->jobsheet->code : '' }}</td>
														<td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($request->tanggal))->format('d F Y') }}</td>
														<td>{{ $request->payable && $request->payable->document ? $request->payable->document->name : $request->document_id }}</td>
														<td>{{ $request->payable && $request->payable->vendor ? $request->payable->vendor->name : $request->vendor_id }}</td>
														<td class="text-center"><span class="label label-primary">{{ $request->status }}</span></td>
													</tr>
													<?php $no++; ?>
												@endforeach
												</tbody>
											</table>
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

	<script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
	<script>
		$(document).ready(function(){
			$('#myTables').dataTable();
			var body = $('body');
			var dateFormat = 'yyyy-mm-dd',
					rangeFrom = $('.datepicker-from')
							.datepicker({
								autoclose: 'true',
								//setDate: new Date(),
								//todayHighlight: 'true',
								format: dateFormat
							}).on( "changeDate", function() {
								console.log(getDate( $(this) ));
								rangeTo.datepicker( "setStartDate", getDate( $(this) ) );
							}),
					rangeTo = $('.datepicker-to')
							.datepicker({
								autoclose: 'true',
								//setDate: new Date(),
								//todayHighlight: 'true',
								format: dateFormat
							}).on( "changeDate", function() {
								rangeFrom.datepicker( "setEndDate", getDate( $(this) ) );
							});

			function getDate( element ) {
				var date;
				try {
					date = element.val();
				} catch( error ) {
					date = null;
				}

				return date;
			}
		});
	</script>

@endsection