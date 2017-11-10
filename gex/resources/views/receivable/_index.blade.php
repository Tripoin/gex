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
	                                    <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">INVOICE RECEIVABLE</a>
	                                </li>
	                            </ul>

	                            @if(Auth::user()->role == 'payable')
	                            	{!! Form::open(['url' => route('payable.requestoverpayment'), 'method' => 'post','class'=>'form-horizontal','id'=>'overpayment']) !!}
                                    {{ csrf_field() }}
                                	{!! Form::close() !!}
                                @endif

	                            <!-- Tab panes -->
	                            <div class="tab-content tab-content-1">
	                                <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
	                                    <div class="table-responsive">
	                                        <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
	                                            <thead>  
										          <tr>
										          	<th>NO.</th>
										          	@if(Auth::user()->role == 'payable')
										          	@if(Request::path() == 'payables/overpayment')
										          		<th>
										          			<input type="checkbox" onchange="checkAll(this)" name="chk[]" />
										          		</th>
										          		<th>
										          			DATE REQUEST
										          		</th>
										          	@endif
										          	@endif  
										            <th>INVOICE</th>  
										            <th>CUSTOMER</th>  
										            <th>JOB</th>  
										            <th>E-FAKTUR</th>
										            <th>DATE</th>
										            <th>DUE DATE</th>
										            <th>RECEIPT DATE</th>
										            <th>TYPE</th>
										            <th>STATUS</th>
										            @if(Request::path() == 'receivables/invoice-collection')
										            	<th>ACTION</th>
										            @endif
										            @if(Auth::user()->role == 'approverec' || Auth::user()->role == 'pajak')
										            	<th>ACTION</th>
										            @endif
										            @if(Auth::user()->role == 'payable')
										            @if(Request::path() != 'payables/list-overpayment')
										            	<th>ACTION</th>
										            @endif
										            @endif
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
												          	@if(Auth::user()->role == 'payable')
												          	@if(Request::path() == 'payables/overpayment')
												          		<td>
												          			<input type="checkbox" name="id[]" form="overpayment" value="{{ $rec->id }}">	
												          		</td>
												          		<td>
												          			{!! Form::text('date[]',old('date[]', date('d-m-Y')),['class'=>'form-control input-sm datepicker1 text-big','placeholder'=>'Enter Date','required','form'=>'overpayment']) !!}
												          		</td>
												          	@endif
												          	@endif
												            <td>
												            	@if(Auth::user()->role == 'receivable')
													            	@if(Request::path() == 'receivables/invoice-collection')
													            		<a href="{{ route('receivable.show', [$rec->id, $rec->type]) }}"> {{ $rec->code }} </a>
													            	@elseif(Request::path() == 'receivables/history')
													            		<a href="{{ route('receivable.detailhistory', $rec->id) }}"> {{ $rec->code }} </a>
													            	@endif
													            @elseif(Auth::user()->role == 'approverec')
													            	<a href="{{ route('approverec.show', [$rec->id, $rec->type]) }}"> {{ $rec->code }} </a>
													            @elseif(Auth::user()->role == 'payable')
													            	<a href="{{ route('payable.showinvoice', [$rec->id, $rec->type]) }}"> {{ $rec->code }} </a>
													            @elseif(Auth::user()->role == 'pajak')
													            	<a href="{{ route('pajak.showinvoice', [$rec->id, $rec->type]) }}"> {{ $rec->code }} </a>
													            @endif
												            </td>  
												            <td>{{ $customer_id->name }}</td>  
												            <td>{{ $job->code }}</td>
												            <td>{{ $rec->efaktur }}</td>
												            <td>{{ $rec->tanggal }}</td>
												            <td>{{ $rec->due_date }}</td>
												            <td>{{ $rec->receipt_date }}</td>
												            <td>{{ $rec->type }}</td>  
												            <td class="text-center">
												            	@if($rec->status==0)
												            		<span class="label label-primary">REQUESTED</span>
												            	@elseif($rec->status==1)
												            		<span class="label label-success">APPROVAL</span>
												            	@elseif($rec->status==2)
												            		<span class="label label-warning">PENDING</span>
												            	@elseif($rec->status==3)
												            		<span class="label label-warning">OVERPAYMENT</span>
												            	@elseif($rec->status==4)
												            		<span class="label label-success">PAID OFF</span>
												            	@elseif($rec->status==5)
												            		<span class="label label-danger">REVISI</span>
												            	@endif
												            </td>
												            @if(Auth::user()->role == 'receivable')
													            @if(Request::path() == 'receivables/invoice-collection')
													            <td class="text-center">
													            	@if($rec->due_date && $rec->receipt_date > 0)
													            		<button class="btn btn-primary" data-toggle="modal" href="#" disabled><span class="glyphicon glyphicon-calendar"></span></button>
													            	@else
													            		<button class="btn btn-primary" data-toggle="modal" href="#modal-date"><span class="glyphicon glyphicon-calendar"></span></button>
													            	@endif
														            @if($rec->status==0)
														            	<a href="{{ route('receivable.printpdf', [$rec->id, $rec->type]) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
														            @else
														            	<a href="#" target="_blank" class="btn btn-primary btn-sm" disabled><i class="fa fa-print"></i></a>
														            @endif
													            </td>
													            @endif
													        @elseif(Auth::user()->role == 'approverec')
													        	<td class="text-center">
													        		@if(Request::path() != 'approverec/invoice-cancel')
														           	<a href="{{ route('approverec.printpdf', [$rec->id, $rec->type]) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
														           	<a href="{{ route('approverec.approve', $rec->id) }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i></a>
														           	@else
														           	<a href="{{ route('approverec.approverevisi', $rec->id) }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i></a>
														           	@endif
													        	</td>
													        @elseif(Auth::user()->role == 'pajak')
													        	<td class="text-center">
													        		<button class="btn btn-primary" data-toggle="modal" href="#modal-faktur"><span class="glyphicon glyphicon-ok"></span></button>
													        	</td>
													        @elseif(Auth::user()->role == 'payable')
													        @if(Request::path() != 'payables/list-overpayment')
													        	<td class="text-center">
													        		<button class="btn btn-primary" data-toggle="modal" href="#modal-overpayment"><span class="glyphicon glyphicon-ok"></span></button>
													        	</td>
													        @endif
													        @endif
												          </tr>
												          <?php $no++; ?>  

												          <div class="modal fade" id="modal-date">
														    <div class="modal-dialog">
														        <div class="modal-content">
														            <div class="modal-header">
														                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														                <h4 class="modal-title">DATE</h4>
														            </div>
														            <form action="{{ route('receivable.adddate', $rec->id) }}" method="POST" role="form">
														            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
														                <div class="modal-body">
														                    <div class="form-group">
														                        <label for="">DUE DATE</label>
														                        <input type="date" name="due_date" class="form-control input-sm">
														                    </div>
														                    <div class="form-group">
														                        <label for="">RECEIPT DATE</label>
														                        <input type="date" name="receipt_date" class="form-control input-sm">
														                    </div>
														                </div>
														                <div class="modal-footer">
														                    <button type="submit" class="btn btn-primary">Submit</button>
														                </div>
														            </form>
														        </div>
														    </div>
														</div>

														<div class="modal fade" id="modal-faktur">
														    <div class="modal-dialog">
														        <div class="modal-content">
														            <div class="modal-header">
														                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														                <h4 class="modal-title">E-FAKTUR</h4>
														            </div>
														            <form action="{{ route('pajak.addfaktur', $rec->id) }}" method="POST" role="form">
														            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
														                <div class="modal-body">
														                    <div class="form-group">
														                        <label for="">E-FAKTUR</label>
														                        <input type="text" name="faktur" class="form-control input-sm">
														                    </div>
														                </div>
														                <div class="modal-footer">
														                    <button type="submit" class="btn btn-primary">Submit</button>
														                </div>
														            </form>
														        </div>
														    </div>
														</div>
										          	@endforeach
										        </tbody>  
	                                        </table>
	                                    </div>
	                                    @if(Auth::user()->role == 'payable')
	                                    <br>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" form="overpayment">Submit</button>
                                        </div>
                                        @endif
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

	<script>
    //datepicker
    $('.datepicker1').datepicker({
        autoclose: 'true',
        todayHighlight: 'true',
        format: 'dd-mm-yyyy'
    });
    </script>

	<script>
         function checkAll(ele) {
         var checkboxes = document.getElementsByTagName('input');
         if (ele.checked) {
             for (var i = 0; i < checkboxes.length; i++) {
                 if (checkboxes[i].type == 'checkbox') {
                     checkboxes[i].checked = true;
                 }
             }
         } else {
             for (var i = 0; i < checkboxes.length; i++) {
                 console.log(i)
                 if (checkboxes[i].type == 'checkbox') {
                     checkboxes[i].checked = false;
                 }
             }
         }
        }
    </script>

@endsection