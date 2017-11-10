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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">REPORT</a>
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
										        	@foreach($jobsheets as $jobsheet)
											            @php
											            	$customer_id = App\MasterCustomer::find($jobsheet->customer_id);
											            	$marketing_id = App\User::find($jobsheet->marketing_id);
											            	$poo_id = App\MasterPort::find($jobsheet->poo_id);
											            	$pod_id = App\MasterPort::find($jobsheet->pod_id);
											            	$cek = App\Invoice::where('jobsheet_id', $jobsheet->id)->count();
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
												          </tr>
												          <?php $no++; ?>  
										          	@endforeach
										        </tbody>  
	                                        </table>
	                                    </div>
	                                </div>
	                            </div>
	                            {{--<div class="panel-footer text-right">
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-word-o fa-fw"></i> WORD</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i> EXCEL</button>
                    </div> --}}
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

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css
">
	<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

@endsection