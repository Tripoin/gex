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
	                                    <a href="#revisionlist" aria-controls="revisionlist" role="tab" data-toggle="tab">REVISION</a>
	                                </li>
	                            </ul>

	                            <!-- Tab panes -->
	                            <div class="tab-content tab-content-1">
	                                <div role="tabpanel" class="tab-pane active" id="revisionlist">
	                                    <div class="table-responsive">
	                                        <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
	                                            <thead>  
										          <tr>
										          	<th>NO.</th>
										            <th>JOBSHEET</th>  
										            <th>FROM</th>  
										            <th>NOTE</th>
										            <th>ACTION</th>  
										          </tr>  
										        </thead>
										        
										        <tbody>  
										        	<?php $no = 1; ?>
										        	@foreach($revisions as $revision)
											            @php
											            	$from = App\User::find($revision->sender);
											            @endphp  
												         <tr>
												          	<td>{{ $no }}</td>
												            <td>
												            	<a href="{{ route('jobsheet.marketing.show', $revision->jobsheet_id) }}">{{ $revision->jobsheet->code }}</a>
												            </td>
												            <td>{{ $from->name }} - {{ $from->role }}</td>
												            <td>{{ $revision->note }}</td>
												            <td class="text-center">
												            	<a href="{{ route('jobsheet.marketing.edit', $revision->jobsheet_id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
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

	<!-- EDIT JOB SHEET -->
	<div class="modal fade" id="modal-edit">
	    <div class="modal-dialog modal-big">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Edit Charges</h4>
	            </div>
	            <div class="modal-body">
	                <form action="" method="POST" class="form-horizontal" role="form">
	                    <div class="row">
	                        <div class="col-sm-4">
	                            <table class="table table-borderless table-condensed detail-table no-margin">
	                                <tr>
	                                    <td>JOB</td>
	                                    <td>:</td>
	                                    <td>0001/04/2017/JKT</td>
	                                </tr>
	                                <tr>
	                                    <td>CUSTOMER</td>
	                                    <td>:</td>
	                                    <td>MAYORA</td>
	                                </tr>
	                                <tr>
	                                    <td>ORIGIN</td>
	                                    <td>:</td>
	                                    <td>JAKARTA</td>
	                                </tr>
	                                <tr>
	                                    <td>DESTINATION</td>
	                                    <td>:</td>
	                                    <td>KUWAIT</td>
	                                </tr>
	                                <tr>
	                                    <td>PARTY/MEAS</td>
	                                    <td>:</td>
	                                    <td>4</td>
	                                </tr>
	                                <tr>
	                                    <td>REMARKS</td>
	                                    <td>:</td>
	                                    <td>-</td>
	                                </tr>
	                            </table>
	                        </div>
	                        <div class="col-sm-4">
	                            <table class="table table-borderless table-condensed detail-table no-margin">
	                                <tr>
	                                    <td>OPERATION</td>
	                                    <td>:</td>
	                                    <td>OEMAR</td>
	                                </tr>
	                                <tr>
	                                    <td>MARKETING</td>
	                                    <td>:</td>
	                                    <td>BAKRIE</td>
	                                </tr>
	                                <tr>
	                                    <td>FREIGHT TYPE</td>
	                                    <td>:</td>
	                                    <td>COLLECT</td>
	                                </tr>
	                                <tr>
	                                    <td>VESSEL</td>
	                                    <td>:</td>
	                                    <td>TITANIC</td>
	                                </tr>
	                                <tr>
	                                    <td>DESCRIPTION</td>
	                                    <td>:</td>
	                                    <td>FOOD OF LIFE</td>
	                                </tr>
	                                <tr>
	                                    <td>INSTRUCTION</td>
	                                    <td>:</td>
	                                    <td>-</td>
	                                </tr>
	                            </table>
	                        </div>
	                        <div class="col-sm-4">
	                            <table class="table table-borderless table-condensed detail-table no-margin">
	                                <tr>
	                                    <td>DATE</td>
	                                    <td>:</td>
	                                    <td class="text-right">12 April 2017</td>
	                                </tr>
	                                <tr>
	                                    <td>ETD</td>
	                                    <td>:</td>
	                                    <td class="text-right">15 April 2017</td>
	                                </tr>
	                                <tr>
	                                    <td>ETA</td>
	                                    <td>:</td>
	                                    <td class="text-right">10 Mei 2017</td>
	                                </tr>
	                                <tr>
	                                    <td>MB/L</td>
	                                    <td>:</td>
	                                    <td class="text-right">92648650002344</td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                    <hr>
	                    
	                    <div role="tabpanel">
	                        <!-- Nav tabs -->
	                        <ul class="nav nav-tabs nav-tabs-3" role="tablist">
	                            <li role="presentation" class="active">
	                                <a href="#editcharges" aria-controls="editcharges" role="tab" data-toggle="tab">DETAIL OF CHARGES</a>
	                            </li>
	                            <li role="presentation">
	                                <label class="fancy-checkbox reimburse-checkbox-wrap" title="Add Reimbursement">
	                                    <input name="reimburs" value="1" class="reimburse-checkbox" type="checkbox">
	                                    <span><i></i></span>
	                                </label>
	                                <a href="#editreimburse" aria-controls="editreimburse" role="tab" data-toggle="tab">REIMBURSEMENT</a>
	                            </li>
	                            <li role="presentation">
	                                <a href="#editrc" aria-controls="editrc" role="tab" data-toggle="tab">R/C CUSTOMER</a>
	                            </li>
	                        </ul>

	                        <!-- Tab panes -->
	                        <div class="tab-content tab-content-2">
	                            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="editcharges">
	                                <div class="row charge-wrap">
	                                    <div class="col-sm-12 charge-group">
	                                        <div class="form-group ">
	                                            <div class="col-sm-3">
	                                                <label>DETAIL OF CHARGES</label>
	                                                <div class="input-group">
	                                                    <input type="text" value="OCEAN FREIGHT" class="form-control input-sm" id="email" placeholder="Charge" >
	                                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-charge" type="button"><i class="fa fa-plus"></i></button></span>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2">
	                                                <label>VENDOR</label>
	                                                <input type="text" value="PT. INKOMAS LESTARI" class="form-control input-sm" id="email" placeholder="Vendor Name" >
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <label>QTY</label>
	                                                <input type="text" value="2" class="form-control input-sm" id="email" placeholder="Qty" >
	                                                <label class="x-mark">X</label>
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <label>UNIT</label>
	                                                <select name="" id="" class="form-control input-sm" >
	                                                    <option value="">UNIT</option>
	                                                    <option value="">MB/L</option>
	                                                    <option value="">HB/L</option>
	                                                    <option value="">PEB</option>
	                                                </select>
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <label>CURR</label>
	                                                <select name="" id="" class="form-control input-sm">
	                                                    <option value="">IDR</option>
	                                                    <option value="">USD</option>
	                                                </select>
	                                            </div>
	                                            <div class="col-sm-2 text-right">
	                                                <label>AMOUNT</label>
	                                                <input type="text" class="form-control input-sm text-right" id="email" value="1,000,000.00" placeholder="Amount">
	                                            </div>
	                                            <div class="col-sm-2 text-right">
	                                                <label>TOTAL</label>
	                                                <input type="text" value="2,000,000.00" class="form-control input-sm text-right" id="email" placeholder="Subtotal" readonly>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <div class="col-sm-3">
	                                                <div class="input-group">
	                                                    <input type="text" value="SWITCH B/L" class="form-control input-sm" id="email" placeholder="Charge" >
	                                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-charge" type="button"><i class="fa fa-plus"></i></button></span>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2">
	                                                <input type="text" value="PT. INKOMAS LESTARI" class="form-control input-sm" id="email" placeholder="Vendor Name" >
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <input type="text" value="1" class="form-control input-sm" id="email" placeholder="Qty" >
	                                                <label class="x-mark">X</label>
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <select name="" id="" class="form-control input-sm" >
	                                                    <option value="">UNIT</option>
	                                                    <option value="">MB/L</option>
	                                                    <option value="">HB/L</option>
	                                                    <option value="">PEB</option>
	                                                </select>
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <select name="" id="" class="form-control input-sm">
	                                                    <option value="">IDR</option>
	                                                    <option value="">USD</option>
	                                                </select>
	                                            </div>
	                                            <div class="col-sm-2">
	                                                <input type="text" class="form-control input-sm text-right" id="email" value="1,000,000.00" placeholder="Amount">
	                                            </div>
	                                            <div class="col-sm-2 text-right">
	                                                <input type="text" value="1,000,000.00" class="form-control input-sm text-right" id="email" placeholder="Subtotal" readonly>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom" id="editreimburse">
	                                <div class="terms-group term-reimbursement" index="0">
	                                    <div class="row">
	                                        <div class="col-sm-12">
	                                            <div class="form-group">
	                                                <div class="col-sm-3">
	                                                    <label>TERMS OF PAYMENT</label>
	                                                    <select name="reimburs_term[]" id="" class="form-control input-sm input-reimburse term" required="required" disabled onfocus="getTerm(this)">
	                                                        <option value="">TERM</option>
	                                                    </select>
	                                                </div>
	                                                <div class="col-sm-2 no-padding-left">
	                                                    <label>BILL TO</label>
	                                                    <input type="text" class="form-control input-sm input-reimburse" id="email" placeholder="Customer Name" onfocus="completeCustomer(this, 'new')" disabled>
	                                                    <input type="hidden" name="reimburs_bill_to[]" class="bill_to_binding input-reimburse" disabled>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-sm-12 charge-group">
	                                            <div class="form-group">
	                                                {{--  <div class="col-sm-2 no-padding-right">
	                                                    <label>CHARGE</label>
	                                                    <div class="input-group">
	                                                        <input type="text" class="form-control input-sm bpeng" value="B. PENGGANTIAN" disabled>
	                                                        <span class="input-group-btn"><button class="btn btn-sm btn-primary add-reimburse disabled" type="button"><i class="fa fa-plus"></i></button></span>
	                                                    </div>
	                                                </div>  --}}
	                                                <div class="col-sm-3">
	                                                    <label>DETAIL</label>
	                                                    <input type="text" class="form-control input-sm input-reimburse" placeholder="Detail" disabled onfocus="completeCharge(this)">
	                                                    <input type="hidden" class="binding_charge input-reimburse" name="reimburs_charge[0][]" disabled>
	                                                </div>
	                                                <div class="col-sm-2 no-padding-left">
	                                                    <label >VENDOR</label>
	                                                    <input type="text" value="PT. INKOMAS LESTARI" class="form-control input-sm" placeholder="Vendor Name">
	                                                </div>
	                                                <div class="col-sm-1">
	                                                    <label>QTY</label>
	                                                    <input type="text" class="form-control input-sm input-reimburse rmb_qty" name="reimburs_qty[0][]" placeholder="Qty" disabled>
	                                                    <label class="x-mark">X</label>
	                                                </div>
	                                                <div class="col-sm-1">
	                                                    <label>UNIT</label>
	                                                    <select name="reimburs_unit[0][]" id="" class="form-control input-sm input-reimburse" required="required" disabled onfocus="getUnit(this)">
	                                                        <option value="">UNIT</option>
	                                                    </select>
	                                                </div>
	                                                <div class="col-sm-1">
	                                                    <label>CURR</label>
	                                                    <select name="reimburs_currency[0][]" id="" class="form-control input-sm input-reimburse rmb_currency" disabled>
	                                                        <option value="1">IDR</option>
	                                                        <option value="2">USD</option>
	                                                    </select>
	                                                </div>
	                                                <div class="col-sm-2">
	                                                    <label>AMOUNT</label>
	                                                    <input type="text" class="form-control input-sm input-reimburse rmb_ammount" name="reimburs_ammount[0][]" placeholder="Amount" disabled>
	                                                </div>
	                                                <div class="col-sm-2 text-right">
	                                                    <label class="text-right">TOTAL</label>
	                                                    <input type="text" class="form-control input-sm text-right rmb_subtotal" param="1" value="0.00" readonly>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <hr>
	                                </div>
	                            </div>
	                            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom" id="editrc">
	                                <div class="row charge-wrap">
	                                    <div class="col-sm-12 charge-group">
	                                        <div class="form-group ">
	                                            <div class="col-sm-3">
	                                                <label>DETAIL OF CHARGES</label>
	                                                <div class="input-group">
	                                                    <input type="text" value="OCEAN FREIGHT" class="form-control input-sm" id="email" placeholder="Charge" >
	                                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
	                                                </div>
	                                            </div>
	                                            <div class="col-sm-2">
	                                                <label>VENDOR</label>
	                                                <input type="text" value="PT. INKOMAS LESTARI" class="form-control input-sm" id="email" placeholder="Vendor Name" >
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <label>QTY</label>
	                                                <input type="text" value="2" class="form-control input-sm" id="email" placeholder="Qty" >
	                                                <label class="x-mark">X</label>
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <label>UNIT</label>
	                                                <select name="" id="" class="form-control input-sm" >
	                                                    <option value="">UNIT</option>
	                                                    <option value="">MB/L</option>
	                                                    <option value="">HB/L</option>
	                                                    <option value="">PEB</option>
	                                                </select>
	                                            </div>
	                                            <div class="col-sm-1">
	                                                <label>CURR</label>
	                                                <select name="" id="" class="form-control input-sm">
	                                                    <option value="">IDR</option>
	                                                    <option value="">USD</option>
	                                                </select>
	                                            </div>
	                                            <div class="col-sm-2 text-right">
	                                                <label>AMOUNT</label>
	                                                <input type="text" class="form-control input-sm text-right" id="email" value="1,000,000.00" placeholder="Amount">
	                                            </div>
	                                            <div class="col-sm-2 text-right">
	                                                <label>TOTAL</label>
	                                                <input type="text" value="2,000,000.00" class="form-control input-sm text-right" id="email" placeholder="Subtotal" readonly>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </form>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                <button type="button" class="btn btn-primary btn-update">Update</button>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- END EDIT JOB SHEET -->

	{{-- Modal Decline --}}
	<div class="modal fade" id="modal-decline">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Decline Job Sheet</h4>
	            </div>
	            <form action="" method="POST" role="form">
	                <div class="modal-body">
	                    <div class="form-group">
	                        <label for="">RETURN TO</label>
	                        <select name="" id="" class="form-control input-sm">
	                            <option value="">PRICING</option>
	                            <option value="">MARKETING</option>
	                        </select>
	                    </div>
	                    <div class="form-group">
	                        <label for="">REASON</label>
	                        <textarea type="text" class="form-control" id="" placeholder="Input reason"></textarea>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                    <button type="button" class="btn btn-primary">Submit</button>
	                </div>
	            </form>
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

<script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>

<script>

</script>
@endsection