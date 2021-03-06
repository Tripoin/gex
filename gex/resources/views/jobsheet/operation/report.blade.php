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
														<input type="text" name="report_from" class="input-sm form-control datepicker-from" placeholder="DATE FROM" value="{!! $reportForm !!}">
														<input type="text" name="report_to" class="input-sm form-control datepicker-to" placeholder="DATE TO" value="{!! $reportTo !!}">
														<button class="btn btn-sm btn-primary clearfix">Filter</button>
													</div>
													{!! Form::close() !!}
												</div>
												<div class="col-sm-4 pull-right">
													<a href="{!! route('operation.report.'.$controllerRole, ['isExportExcel'=>1, 'report_from'=>$reportForm, 'report_to'=>$reportTo]) !!}">
														<i class="fa fa-file-excel-o" aria-hidden="true"  title="Export to Excel"></i>
													</a>
													<a href="{!! route('operation.report.'.$controllerRole, ['isExportPDF'=>1, 'report_from'=>$reportForm, 'report_to'=>$reportTo]) !!}">
														<i class="fa fa-file-pdf-o" aria-hidden="true"  title="Export to PDF"></i>
													</a>
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
											            	$rec = App\Receivable::where('jobsheet_id', $jobsheet->id)->count();
											            	$req = App\RequestModel::where('jobsheet_id', $jobsheet->id)->count();
											            @endphp
													    
											            	<tr>
													          	<td>{{ $no }}</td>  
													            <td>{{ $jobsheet->code }}</td>
													            <td>{{ $jobsheet->date }}</td>
													            <td>{{ $customer_id->name }}</td>  
													            <td>{{ $marketing_id->name }}</td>
													            <td>{{ $poo_id->city }}</td>
													            <td>{{ $pod_id->city }}</td>  
													            <td>{{ $jobsheet->eta }}</td>
													            <td>{{ $jobsheet->etd }}</td>
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