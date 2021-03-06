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

													{{--$pay = App\Payable::find($request->pay_id);
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

	<script>
		$(document).ready(function(){
			$('#myTables').dataTable();
		});
	</script>

@endsection