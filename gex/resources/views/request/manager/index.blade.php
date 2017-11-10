@extends('layouts.app')

@section('title', 'Request')

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
										<a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">LIST REQUEST</a>
									</li>
								</ul>

								@include('message.info')

										<!-- Tab panes -->
								<div class="tab-content tab-content-1">
									<div role="tabpanel" class="tab-pane active" id="jobsheetlist">
										<div class="table-responsive">

											<div class="row">
												<div class="col-sm-12 pull-left">
													{!! Form::open(['method' => 'GET','class'=>'form-inline']) !!}
													<div class="form-group">
														<input type="text" name="date_from" placeholder="Date From" class="input-sm form-control datepicker-from" value="{!! $dateForm !!}">
														<input type="text" name="date_to" placeholder="Date To" class="input-sm form-control datepicker-to" value="{!! $dateTo !!}">
														{{--<select name="request_type" class="form-control">
															<option value="" >Select Type</option>
															<option value="payable" >Payable</option>
															<option value="rc" >RC</option>
														</select>--}}
														{{--<select name="request_curr" class="form-control">
															<option value="" >Select Curr</option>
															<option value="1" >IDR</option>
															<option value="2" >USD</option>
														</select>--}}
														<button class="btn btn-sm btn-primary clearfix">Filter</button>
													</div>
													{!! Form::close() !!}
												</div>
											</div>
											<div style="margin-bottom: 10px !important;"></div>

											@if( isset( $isApprovable ) && $isApprovable )
												{!! Form::open(['url'=>route('manager.request.submit-approved'), 'method' => 'POST','class'=>'form-inline bulk_grid_form']) !!}
											@endif
													<table class="table table-bordered table-body-condensed table-striped table-hover" id="@if( isset( $isApprovable ) && $isApprovable ){!! 'requestedTable' !!}@else{!! 'myTables' !!}@endif">
														<thead>
														<tr>
															@if( isset( $isApprovable ) && $isApprovable )
																<th class="valign-middle text-center">
																	<input type="checkbox" name="request_all_id" value="" class="request_all_id">
																</th>
															@endif
															<th>NO.</th>
															<th>JOB</th>
															<th>DOCUMENT</th>
															<th>DATE REQUEST</th>
															<th>PAYMENT TYPE</th>
															<th>BANK</th>
															<th>REQUEST CURR</th>
															<th>PAYMENT CURR</th>
															<th>RATE</th>
															<th>USER</th>
															<th>TOTAL</th>
															{{--<th>CODE</th>--}}
															{{--<th>TYPE</th>--}}
															{{--<th>ACTION</th>--}}
														</tr>
														</thead>
														<?php $no = 1; ?>
														<tbody>
														@foreach($requests as $request)
															<?php
															$paymentCurr = $request->paymentCurrency();
															$paymentCurrId = '';
															$paymentCurrName = '';
															$requestCurrencyAttribute = [];
															if( $paymentCurr ){
																$paymentCurrName = $paymentCurr->name;
																$paymentCurrId = $paymentCurr->id;
															}

																	//dd($paymentCurrName);

															$docName = $request->document_id;
															$totalAmount = 0;
															$rate = '';
															$requestCurr = '';
															if( $request->payable_id ) {
																if( $request->payable ) {
																	if( $request->payable->document ) {
																		$docName = $request->payable->document->name;
																	}
																	$totalAmount = $request->payable->total;
																	$rate = $request->payable->rate;
																}
															} else {
																if( $request->rc ) {
																	if( $request->rc->document ) {
																		$docName = $request->rc->document->name;
																	}
																	$totalAmount = $request->rc->rc_total;
																	$rate = $request->rc->rrate;
																}
															}
															$requestCurr = $request->requestCurrency();
															$requestCurrName = '';
															$requestCurrId = '';
															if( $requestCurr ){
																$requestCurrName = $requestCurr->name;
																$requestCurrId = $requestCurr->id;
															}

															if( $totalAmount == '' ){
																$totalAmount = 0;
															}
															?>
															<tr>
																@if( isset( $isApprovable ) && $isApprovable )
																	<td class="text-center">
																		<input type="checkbox" name="request_ids[]" value="{!! $request->getKey() !!}" class='request_ids'>
																	</td>
																@endif
																	<td>{{ $no }}</td>
																	<td>{{ $request->jobsheet ? $request->jobsheet->code : '' }}</td>
																	<td>{{ $docName }}</td>
																	<td>{{ $request->tanggal }}</td>
																	<td>{{ $request->payment_type }}</td>
																	<td>{{ $request->bank ? $request->bank->name : '' }}</td>
																	<td>{{ $requestCurrName }}</td>
																	<td>{{ $paymentCurrName }}</td>
																	<td>{{ $rate }}</td>
																	<td>{{ $request->user && $request->user->name ? $request->user->name : $request->user_id }}</td>
																	<td class="request-total" data-old="{!! $totalAmount !!}">
																			{!! $paymentCurrName !!}
																			{!! \App\Helpers\ArzFormatPrice::price($totalAmount,$paymentCurrId) !!}</td>
																	{{--<td>{{ $request->rc && $request->rc->code ? $request->rc->code : '' }}</td>--}}
																	{{--<td>{{ $request->type }}</td>--}}
															</tr>
															<?php $no++; ?>
														@endforeach
														</tbody>
													</table>

											@if( isset( $isApprovable ) && $isApprovable )
												<input type="hidden" id="request_status" name="request_status" value="approved">
												<button id="create-approved" class="btn btn-success btn-xs add-modal m-b-10 hidden">
													<i class="fa fa-plus" data-toggle="tooltip" title="Approved from Selected Request"></i> Approved
												</button>
												{!! Form::close() !!}
											@endif
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

	@include('request._show.filter_date_scripts');
	<script>
		$(document).ready(function(){
			var body = $('body');
			function toggleShowBtnCreate(){
				var requestSelectedIds = body.find('.request_ids:checked');
				var requestBtnCreate = $('#create-approved');
				requestBtnCreate.addClass('hidden');
				if( requestSelectedIds.length > 0 ){
					requestBtnCreate.removeClass('hidden');
				}
			}

			body.on('click', '.request_all_id', function () {
				var $thisChecked = $(this).prop("checked");
				var checkBoxes = $('.request_ids');
				checkBoxes.prop("checked", $thisChecked);
				toggleShowBtnCreate();
			});

			body.on('click', '.request_ids', function () {
				toggleShowBtnCreate();
			});

			$('#requestedTable').dataTable({
				"order": [[ 1, "asc" ]],
				"columnDefs": [
					{ "sortable": false,  "targets": [ 0 ] }
				]
			});

			$('#myTables').dataTable();

		});
	</script>

@endsection