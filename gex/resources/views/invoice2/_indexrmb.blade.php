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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">INVOICE REIMBURSEMENT</a>
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
										            <th>ACTION</th>  
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
												            <td>
												            		<a href="{{ route('invoice.show.reimbursement', $rec->id) }}"> {{ $rec->code }} </a>
												            </td>  
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
												            <td class="text-center">
													            	<!-- <a href="#" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a> -->
													            @if($rec->status!=1)
													            	<a href="{{ route('invoice.edit', [$rec->id, $rec->type]) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
													            @else
													            	<a href="#" class="btn btn-primary btn-sm" disabled><span class="glyphicon glyphicon-pencil"></span></a>
													            @endif
													            @if($rec->status==0)	
													            	<a href="{{ route('invoice.printpdfrmb', $rec->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
													            @else
													            	<a href="" target="_blank" class="btn btn-primary btn-sm" disabled><i class="fa fa-print"></i></a>
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