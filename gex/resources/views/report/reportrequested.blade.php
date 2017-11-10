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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">LIST REQUEST</a>
	                                </li>
	                            </ul>

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
										        	@foreach($jobsheets as $jobsheet)
											            @php
											            	$job = App\Jobsheet::find($jobsheet->jobsheet_id);
											            	$customer_id = App\MasterCustomer::find($job->customer_id);
											            	// $poo_id = App\MasterPort::find($job->poo_id);
											            	// $pod_id = App\MasterPort::find($job->pod_id);

											            	$pay = App\Payable::find($jobsheet->payable_id);
											            	$doc = App\MasterDocument::find($pay->document_id);
											            	$vendor = App\MasterVendor::find($pay->vendor_id);
											            @endphp
												         <tr>
												          	<td>{{ $no }}</td>  
												            <td>
												            	@if(Auth::user()->role == 'marketing')
												            		<a href="{{ route('jobsheet.marketing.show', $job->id) }}"> {{ $job->code }} </a>
												            	@elseif(Auth::user()->role == 'operation')
												            		<a href="{{ route('jobsheet.operation.show', $job->id) }}"></span>{{ $job->code }}</a>
												            	@elseif(Auth::user()->role == 'pricing')
												            		<a href="{{ route('jobsheet.pricing.show', $job->id) }}"></span>{{ $job->code }}</a>
												            	@elseif(Auth::user()->role == 'payable')
												            		<a href="{{ route('jobsheet.payable.show', $job->id) }}"></span>{{ $job->code }}</a>
												            	@endif
												            </td>  
												            <td>{{ date('d F Y', strtotime($jobsheet->tanggal)) }}</td>
												            <td>{{ $doc->name }}</td>
												            <td>{{ $vendor->name }}</td>  
												            <td class="text-center"><span class="label label-primary">{{ $jobsheet->status }}</span></td>
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
		    $('#myTables').dataTable( {
		    	dom: 'Bfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ]
		    });
		});
	</script>

<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

@endsection