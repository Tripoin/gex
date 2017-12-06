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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">PAYMENT TERMS INDEX</a>
	                                </li>
	                            </ul>

	                            <!-- Tab panes -->
															<!-- <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createRole" data-toggle="modal" >
																	<i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah Role
															</a> -->
	                            <div class="tab-content tab-content-1">
	                                <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
	                                    <div class="table-responsive">
	                                        <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
	                                            <thead>
										          <tr>
										          	<th>NO.</th>
										            <th>CUSTOMER</th>
																<th>INVOICE DATE</th>
										            <th>INVOICE NUMBER</th>
										            <th>RESPONSIBLE</th>
										            <th>PAYMENT DUE DATE</th>
										            <th>PAYMENT METHOD</th>
																<th>SOURCE DOCUMENT</th>
										            <th>CURRENCY</th>
										            @if(Auth::user()->role != 'pajak' || Auth::user()->role != 'admin2')
										            	<th>ACTION</th>
										            @endif
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

											            @if(Auth::user()->role == 'operation' || Auth::user()->role == 'admin')
										            		<tr>
													          	<td>{{ $no }}</td>
													            <td>
													            	<a href="{{ route('operation.jobsheet.show', $jobsheet->id) }}">{{ $jobsheet->code }}</a>
													            </td>
													            <td>{{ $jobsheet->date }}</td>
													            <td>{{ $customer_id->name }}</td>
													            <td>{{ $marketing_id->name }}</td>
													            <td>{{ $poo_id->city }}</td>
													            <td>{{ $pod_id->city }}</td>
													            <td>{{ $jobsheet->eta }}</td>
													            <td>{{ $jobsheet->etd }}</td>

													            @if(Auth::user()->role != 'pajak' || Auth::user()->role != 'admin2')
														            <td class="text-center">
														            	@if(Request::path() == 'operation/jobsheet/index')
															            	@if($cek < 1 && $req < 1)
															            		<a href="{{ route('operation.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
															            	@endif
														            	@endif
														            </td>
														        @endif
													        </tr>
										            	@elseif(Auth::user()->role == 'marketing' || Auth::user()->role == 'admin')
										            		<tr>
													          	<td>{{ $no }}</td>
													            <td>
													            	@if($rec > 0)
													            		<a href="{{ route('marketing.jobsheet.show', $jobsheet->id) }}">{{ $jobsheet->code }}</a>
													            	@else
													            		{{ $jobsheet->code }}<br>(receivable is empty)
													            	@endif
													            </td>
													            <td>{{ $jobsheet->date }}</td>
													            <td>{{ $customer_id->name }}</td>
													            <td>{{ $marketing_id->name }}</td>
													            <td>{{ $poo_id->city }}</td>
													            <td>{{ $pod_id->city }}</td>
													            <td>{{ $jobsheet->eta }}</td>
													            <td>{{ $jobsheet->etd }}</td>
													            <td class="text-center">
													            	@if(Request::path() == 'marketing/jobsheet/index')
													            		@if($jobsheet->status=='completed')
														            		@if($cek < 1 && $req < 1)
														            			<a href="{{ route('marketing.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
														            		@endif
														            	@else
														            		<a href="{{ route('jobsheet.marketing.show', $jobsheet->id) }}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>
														            	@endif
													            	@endif
													            </td>
													        </tr>
										            	@elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'admin')
										            		<tr>
													          	<td>{{ $no }}</td>
													            <td>
													            	<a href="{{ route('pricing.jobsheet.show', $jobsheet->id) }}"></span>{{ $jobsheet->code }}</a>
													            </td>
													            <td>{{ $jobsheet->date }}</td>
													            <td>{{ $customer_id->name }}</td>
													            <td>{{ $marketing_id->name }}</td>
													            <td>{{ $poo_id->city }}</td>
													            <td>{{ $pod_id->city }}</td>
													            <td>{{ $jobsheet->eta }}</td>
													            <td>{{ $jobsheet->etd }}</td>
													            <td class="text-center">
													            	@if(Request::path() == 'pricing/jobsheet/index')
														            	@if($cek < 1 && $req < 1)
														            		<a href="{{ route('pricing.jobsheet.create', $jobsheet->id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
														            	@endif
													            	@endif
													            </td>
													        </tr>
										            	@elseif(Auth::user()->role == 'payable' || Auth::user()->role == 'admin')
										            		<tr>
													          	<td>{{ $no }}</td>
													            <td>
													            	<a href="{{ route('payable.jobsheet.show', $jobsheet->id) }}"></span>{{ $jobsheet->code }}</a>
													            </td>
													            <td>{{ $jobsheet->date }}</td>
													            <td>{{ $customer_id->name }}</td>
													            <td>{{ $marketing_id->name }}</td>
													            <td>{{ $poo_id->city }}</td>
													            <td>{{ $pod_id->city }}</td>
													            <td>{{ $jobsheet->eta }}</td>
													            <td>{{ $jobsheet->etd }}</td>
													            <td class="text-center">
														            @if(Request::path() == 'payable/jobsheet/index')
													            		@if($cek < 1 && $req < 1)
														            		<a href="{{ route('payable.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
														            	@endif
													            	@endif
													            </td>
													        </tr>
										            	@elseif(Auth::user()->role == 'pajak' || Auth::user()->role == 'admin')
													        <tr>
													          	<td>{{ $no }}</td>
													            <td>
													            	<a href="{{ route('pajak.jobsheet.show', $jobsheet->id) }}"></span>{{ $jobsheet->code }}</a>
													            </td>
													            <td>{{ $jobsheet->date }}</td>
													            <td>{{ $customer_id->name }}</td>
													            <td>{{ $marketing_id->name }}</td>
													            <td>{{ $poo_id->city }}</td>
													            <td>{{ $pod_id->city }}</td>
													            <td>{{ $jobsheet->eta }}</td>
													            <td>{{ $jobsheet->etd }}</td>
													        </tr>
										            	@endif
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
