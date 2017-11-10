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

											@if( isset( $isRequested ) && $isRequested )
												{!! Form::open(['url'=>route('payable.request.submit-approvable'), 'method' => 'POST','class'=>'form-inline bulk_grid_form']) !!}
											@endif
													<table class="table table-bordered table-body-condensed table-striped table-hover" id="@if( isset( $isRequested ) && $isRequested ){!! 'requestedTable' !!}@else{!! 'myTables' !!}@endif">
														<thead>
														<tr>
															@if( isset( $isRequested ) && $isRequested )
																<th class="valign-middle text-center">
																	<input type="checkbox" name="request_all_id" value="" class="request_all_id">
																</th>
															@endif
															<th>NO.</th>
																<th>JOB</th>
															@if( isset( $isRequested ) && $isRequested )
																<th>PAYMENT TYPE</th>
																<th>BANK</th>
																<th>REQUEST CURR</th>
																<th>PAYMENT CURR</th>
																<th>RATE</th>
															@endif
																<th>TOTAL</th>
																<th>DATE REQUEST</th>
																<th>DETAIL OF CHARGES</th>
																<th>REQUESTER</th>
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
															$docName = $request->document_id;
															$totalAmount = 0;
															$requestCurr = '';
															if( $request->payable_id ) {
																if( $request->payable ) {
																	if( $request->payable->document ) {
																		$docName = $request->payable->document->name;
																	}
																	$totalAmount = $request->payable->total;
																}
															} else {
																if( $request->rc ) {
																	if( $request->rc->document ) {
																		$docName = $request->rc->document->name;
																	}
																	$totalAmount = $request->rc->rc_total;
																	//dd($request->rc);
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

															if( isset( $isRequested ) && $isRequested ){
																$rToday = $rateToday;
																if( $requestCurrId == 1 ){
																	$rToday = 1;
																	$requestCurrencyAttribute = [];//['disabled'=>'disabled'];
																}
															}

															?>
															<tr>
																@if( isset( $isRequested ) && $isRequested )
																	<td class="text-center">
																		<input type="checkbox" name="request_ids[]" value="{!! $request->getKey() !!}" class='request_ids'>
																	</td>
																@endif
																	<td>{{ $no }}</td>
																	<td>{{ $request->jobsheet ? $request->jobsheet->code : '' }}</td>
																@if( isset( $isRequested ) && $isRequested )
																	<input type="hidden" name="request_payable_ids[{!! $request->getKey() !!}]" value="{!! $request->payable_id !!}"/>
																	<input type="hidden" name="request_rc_ids[{!! $request->getKey() !!}]" value="{!! $request->rc_id !!}"/>
																	<input type="hidden" name="request_currency[{!! $request->getKey() !!}]" value="{!! $requestCurrId !!}"/>
																	<td class="text-center">
																		{!! Form::select('request_payment_types['. $request->getKey() .']', $listsPaymentType, null, ['class'=>'form-control input-sm request-payment-type']) !!}
																	</td>
																	<td class="text-center">
																		{!! Form::select('request_bank_ids['. $request->getKey() .']', $listsMasterBank, null, ['class'=>'form-control input-sm request-bank']) !!}
																	</td>
																	<td class="text-center">{{ $requestCurrName }}</td>
																	<td class="text-center">
																		{!! Form::select('request_payment_currency['. $request->getKey() .']', $listsCurrency, $requestCurrId, array_merge(['class'=>'form-control input-sm request-payment-currency', 'data-old'=>$requestCurrId], $requestCurrencyAttribute)) !!}
																	</td>
																	<td class="text-center">
																		<input type="text" name="request_rates[{!! $request->getKey() !!}]" value="{!! 1 !!}" class="form-control input-sm request-rate" disabled="disabled" data-old="{!! $requestCurrId !!}" data-rToday="{!! $rateToday !!}"/>
																	</td>
																@endif
																	<td class="request-total" data-old="{!! $totalAmount !!}">
																		@if( (isset( $isApprovable ) && $isApprovable )
																				|| (isset( $isApproved ) && $isApproved ) )
																			{!! $paymentCurrName !!}
																			{!! \App\Helpers\ArzFormatPrice::price($totalAmount,$paymentCurrId) !!}
																		@else
																			{!! \App\Helpers\ArzFormatPrice::price($totalAmount,$requestCurrId) !!}
																		@endif
																	</td>
																	<td>{{ $request->tanggal }}</td>
																	<td>{{ $docName }}</td>
																	<td>{{ $request->user && $request->user->name ? $request->user->name : $request->user_id }}</td>
																	{{--<td>{{ $request->rc && $request->rc->code ? $request->rc->code : '' }}</td>--}}
																	{{--<td>{{ $request->type }}</td>--}}
															</tr>
															<?php $no++; ?>
														@endforeach
														</tbody>
													</table>

											@if( isset( $isRequested ) && $isRequested )
												<input type="hidden" id="request_status" name="request_status" value="approvable">
												<input type="hidden" id="date_from" name="date_from" value="{!! $dateForm !!}">
												<input type="hidden" id="date_to" name="date_to" value="{!! $dateTo !!}">
												{{--<input type="hidden" id="request_type" name="type" value="{!! $requestType !!}">--}}
												<button id="create-approvable" class="btn btn-success btn-xs add-modal m-b-10 hidden">
													<i class="fa fa-plus" data-toggle="tooltip" title="Approvable from Selected Charges"></i> Approvable
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
			function numberWithCommas(x, c) {

				if( c == 1 ){
					x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				} else {
					x = Math.round(x * 100) / 100;
					if( x > 1 ) {
						x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					}
				}

				return x;
			}

			var body = $('body');
			function toggleShowBtnCreate(){
				var requestSelectedIds = body.find('.request_ids:checked');
				var requestBtnCreate = $('#create-approvable');
				requestBtnCreate.addClass('hidden');
				if( requestSelectedIds.length > 0 ){
					requestBtnCreate.removeClass('hidden');
				}
			}

			body.on('click', '.request_all_id', function () {
				var $thisChecked = $(this).prop("checked");
				var checkBoxes = body.find('.request_ids');
				checkBoxes.prop("checked", $thisChecked);
				toggleShowBtnCreate();
			});

			body.on('click', '.request_ids', function () {
				toggleShowBtnCreate();
			});

			/*$('.bulk_grid_form').on('submit', function(e){
				var $this = $(this);
				var gridIds = body.find('.request_ids:checked');
				var requestStatus = $('.request_status').val();
				if( requestStatus != '' && gridIds.length > 0 ) {
					var tmpGridIds = [];
					$.each(gridIds, function () {
						if( $(this).val() )
							tmpGridIds.push($(this).val());
					});
					if(tmpGridIds) {
						$('#request_all_ids').val(tmpGridIds.join(",", tmpGridIds));
						return true;
					}
				}

				return false;
			});*/

			body.find('.request-payment-type').on('change', function(){
				var requestTr = $(this).closest('tr');
				var requestBank = requestTr.find('.request-bank');
				requestBank.val("");
				requestBank.prop("disabled", "disabled");
				requestBank.prop("required",false);
				if( $(this).val() == "BANK" ) {
					requestBank.prop("disabled", false);
					requestBank.prop("required",true);
				}
			}).trigger('change');

			body.find('.request-payment-currency').on('change', function(){
				var $this = $(this);
				var requestTr = $this.closest('tr');
				var requestRate = requestTr.find('.request-rate');
				var requestCurrOld = requestRate.attr('data-old');
				var requestTotal = requestTr.find('.request-total');
				var total = requestTotal.attr('data-old');
				requestRate.prop("disabled", true);
				requestRate.val(1);
				if( $this.val() == 1 && requestCurrOld != 1 ) {
					requestRate.val(requestRate.attr('data-rToday'));
					total = requestRate.attr('data-rToday')*requestTotal.attr('data-old');
					requestRate.prop("disabled", false);
				}
				if( $this.val() == 2 && requestCurrOld != 2 ) {
					requestRate.val(requestRate.attr('data-rToday'));
					total = requestTotal.attr('data-old')/requestRate.attr('data-rToday');
					requestRate.prop("disabled", false);
				}
				requestTotal.html(numberWithCommas(total,$this.val()));
			}).trigger('change');

			body.on('change keyup keypress', '.request-rate', function(){
				var requestRate = $(this);
				var reqPayCurr = requestRate.closest('tr').find('.request-payment-currency');
				var requestTr = reqPayCurr.closest('tr');
				var requestCurrOld = requestRate.attr('data-old');
				var requestTotal = requestTr.find('.request-total');
				var total = requestTotal.attr('data-old');
				if( reqPayCurr.val() == 1 && requestCurrOld != 1 ) {
					total = requestRate.val()*requestTotal.attr('data-old');
				}
				if( reqPayCurr.val() == 2 && requestCurrOld != 2 ) {
					total = requestTotal.attr('data-old')/requestRate.val();
				}
				console.log(total);
				requestTotal.html(numberWithCommas(total,reqPayCurr.val()));
			});

			$('#myTables').dataTable();
			$('#requestedTable').dataTable({
				"order": [[ 1, "asc" ]],
				"columnDefs": [
					{ "sortable": false,  "targets": [ 0 ] }
				]
			});

		});
	</script>

@endsection