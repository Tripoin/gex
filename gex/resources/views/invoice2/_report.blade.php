@extends('layouts.app')

@section('title', 'Report')

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
										            <th>INVOICE</th>  
										            <th>CUSTOMER</th>  
										            <th>JOB</th>  
										            <th>E-FAKTUR</th>
										            <th>DATE</th>
										            <th>STATUS</th>
										          </tr>  
										        </thead>
										        <?php $no = 1; ?>  
										        <tbody>  
										        	@foreach($invoicerec->sortByDesc('id') as $rec)
											            @php
											            	$customer_id = App\MasterCustomer::find($rec->customer_id);
											            	$job = App\Jobsheet::find($rec->jobsheet_id);
											            @endphp
												         <tr>
												          	<td class="text-center">{{ $no }}</td>  
												            <td>{{ $rec->code }}</td>  
												            <td>{{ $customer_id->name }}</td>  
												            <td>{{ $job->code }}</td>
												            <td>{{ $rec->efaktur }}</td>
												            <td>{{ $rec->tanggal }}</td>  
												            <td class="text-center">
												            	@if($rec->status==0)
												            		<span class="label label-primary">REQUESTED</span>
												            	@elseif($rec->status==1)
												            		<span class="label label-success">APPROVAL</span>
												            	@else
												            		<span class="label label-primary">PENDING</span>
												            	@endif
												            </td>
												          </tr>
												          <?php $no++; ?>  
										          	@endforeach
										        </tbody>  
	                                        </table>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="panel-footer text-right">
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-word-o fa-fw"></i> WORD</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i> EXCEL</button>
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