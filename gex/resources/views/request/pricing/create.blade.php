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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">COMPLETED JOBSHEET</a>
	                                </li>
	                            </ul>

								@include('message.error')

	                            <!-- Tab panes -->
	                            <div class="tab-content tab-content-1">
	                                <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
	                                    <div class="table-responsive">

											<div class="row">
												<div class="col-sm-6 pull-left">
													{!! Form::open(['method' => 'GET','class'=>'form-inline']) !!}
													<div class="form-group">
														<input type="text" name="date_from" class="input-sm form-control datepicker-from" placeholder="DATE FROM" value="{!! $dateForm !!}">
														<input type="text" name="date_to" class="input-sm form-control datepicker-to" placeholder="DATE TO" value="{!! $dateTo !!}">
														<button class="btn btn-sm btn-primary clearfix">Filter</button>
													</div>
													{!! Form::close() !!}
												</div>
											</div>
											<div style="margin-bottom: 10px !important;"></div>

	                                        <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
	                                            <thead>  
										          <tr>
										          	<th>NO.</th>  
										            <th>JOB</th>  
										            <th>DATE</th>
										            <th>CUSTOMER</th>
										            <th>MARKETING</th>
										            <th>ORIGIN</th>
										            <th>DESTINATION</th>
										            <th>ETD</th>
										            <th>ETA</th>
													  <th title="CHARGES (COUNT)">CHARGES (COUNT)</th>
													  <th>ACTION</th>
										          </tr>  
										        </thead>
										        <?php $no = 1; ?>  
										        <tbody>  
										        	@foreach($jobsheets->sortByDesc('id') as $jobsheet)
											            @php
											            	$customer_id = App\MasterCustomer::find($jobsheet->customer_id);
											            	$marketing_id = App\User::find($jobsheet->marketing_id);
											            	$poo_id = App\MasterPort::find($jobsheet->poo_id);
											            	$pod_id = App\MasterPort::find($jobsheet->pod_id);
											            	$cek = App\Invoice::where('jobsheet_id', $jobsheet->id)->count();
															$payableCount = App\Payable::where('jobsheet_id', $jobsheet->getKey())->where('user_id',  Auth::user()->getKey())->count();
											            @endphp
												         <tr>
												          	<td>{{ $no }}</td>  
												            <td>
																{{ $jobsheet->code }}
												            </td>  
												            <td>{{ $jobsheet->date }}</td>
												            <td>{{ $customer_id->name }}</td>  
												            <td>{{ $marketing_id->name }}</td>
												            <td>{{ $poo_id->nick_name }}</td>
												            <td>{{ $pod_id->nick_name }}</td>
												            <td>{{ $jobsheet->eta }}</td>
												            <td>{{ $jobsheet->etd }}</td>
															 <td>{{ $payableCount }}</td>
															 <td class="text-center">
																 <a href="{{ route('pricing.request.detail-jobsheet', ['id'=>$jobsheet->id]) }}"><i class="fa fa-pencil"></i></a>
															 </td>
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

	@include('request._show.filter_date_scripts');
	<script>
		$(document).ready(function(){
			$('#myTables').dataTable({
				//"order": [[ 3, "desc" ]],
				"columnDefs": [
					{ "sortable": false,  "targets": [ 9 ] }
				]
			});
		});
	</script>

@endsection