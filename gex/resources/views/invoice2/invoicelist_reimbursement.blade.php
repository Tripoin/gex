@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Invoice')

@section('sidebar')
    @include('sidebar.invoice')
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- JOB SHEET -->
                <div class="panel">
                    {{--<div class="panel-heading">
                        <h3 class="panel-title">Job Sheets</h3>
                        <div class="right">
                            <a href="{{ url('/operation/newjobsheet') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New Job Sheet</a>
                        </div>
                    </div>--}}
                    <div class="panel-body no-padding">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs nav-tabs-1 nav-main" role="tablist">
                                    <li role="presentation" @if(!session('job')) class="active" @endif>
                                        <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">INVOICE</a>
                                    </li>
                                    @if(session('job'))
                                        <li role="presentation" class="active">
                                            <a href="#tes" aria-controls="tes" role="tab" data-toggle="tab">INV: {{session('code')}} <i class="tabs-close fa fa-times"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content tab-content-1">
                            @if(session('job'))
                                <div role="tabpanel" class="tab-pane active" id="tes"></div>
                            @endif
                                <div role="tabpanel" class="tab-pane @if(!session('job')) active @endif" id="jobsheetlist">
                                    <div class="row filter-search">
                                        <div class="col-sm-4 no-padding-left">
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">DATE</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm datepicker filter-input" id="filter_date" placeholder="Filter By Date">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">JOB</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm filter-input" id="filter_job" placeholder="Filter By Job Sheet Number">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">CUSTOMER</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm filter-input" id="filter_customer" placeholder="Filter By Customer" onfocus="completeCustomer(this,'filter')">
                                                    <input type="hidden" id="filter_customer_binding" class="filter-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">POO</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm filter-input" id="filter_poo" placeholder="Filter By POO" onfocus="completePoo(this, 'filter')">
                                                    <input type="hidden" id="filter_poo_binding" class="filter-input">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">POD</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm filter-input" id="filter_pod" placeholder="Filter By POD" onfocus="completePod(this, 'filter')">
                                                    <input type="hidden" id="filter_pod_binding" class="filter-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 no-padding-right">
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">VENDOR</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm filter-input" id="filter_vendor" placeholder="Filter By Vendor">
                                                    <input type="hidden" id="filter_vendor_binding" class="filter-input">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="control-label col-sm-4">DOCUMENT</label>
                                                <div class="col-sm-8">
                                                    <select name="filter_document" id="document" class="form-control input-sm filter-input">
                                                        <option value="">DOCUMENT</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group text-right clearfix">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-default btn-sm" id="filter_reset_btn">Reset</button>
                                                    <button class="btn btn-primary btn-sm" id="filter_btn">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <div class="btn-filter-search"><i class="fa fa-chevron-down"></i></div>
                                        <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTable">
                                            
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

{{-- Modal Edit Invoice --}}
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Invoice</h4>
            </div>
            <form action="" method="POST" role="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-7 col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-4">DATE</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
									    <input class="form-control input-sm datepicker" placeholder="Create Date" type="text">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">BANK ACCOUNT</label>
                                <div class="col-sm-8">
                                    <select name="document[]" id="" class="form-control input-sm" required="required">
                                        <option value="">MANDIRI</option>
                                        <option value="1">BCA</option>
                                        <option value="1">DANAMON</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">REFERENCES</label>
                                <div class="col-sm-8">
                                    <label class="fancy-checkbox"><input class="check-req" type="checkbox"><span></span>MB/L - CV90234534834456</label>
                                    <label class="fancy-checkbox"><input class="check-req" type="checkbox"><span></span>HB/L - 534834456</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-5 col-md-offset-1">
                            <div class="form-group">
                                <label class="control-label col-sm-4">CUSTOMER</label>
                                <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
                                <label class="control-label col-sm-6 col-md-7 label-right">INDOFOOD INTERNATIONAL</label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">BILL TO</label>
                                <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
                                <label class="control-label col-sm-6 col-md-7 label-right">HALIM</label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">TAX</label>
                                <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
                                <label class="control-label col-sm-6 col-md-7 label-normal label-right">PPN 1</label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4">TERMS</label>
                                <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
                                <label class="control-label col-sm-6 col-md-7 label-normal label-right">2 MONTH</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-2" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#invedit" aria-controls="invedit" role="tab" data-toggle="tab">SELECTED CHARGES</a>
                            </li>
                            <li role="presentation">
                                <a href="#docedit" aria-controls="docedit" role="tab" data-toggle="tab">DETAIL OF CHARGES</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active no-padding-left no-padding-right" id="invedit">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed no-margin">
                                        <thead>
                                            <tr>
                                                <td class="text-center" width="1%">-</td>
                                                <td class="text-center">#</td>
                                                <td class="text-center">DETAIL OF CHARGES</td>
                                                <td class="text-center">QTY x UNIT</td>
                                                <td class="text-center">CURR</td>
                                                <td class="text-center">PRICE</td>
                                                <td class="text-center">TOTAL</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><i class="fa fa-minus-square fa-custom-remove"></i></td>
                                                <td>1</td>
                                                <td>FREIGHT CHARGES</td>
                                                <td class="text-center">1 x 40'HC</td>
                                                <td class="text-center">USD</td>
                                                <td class="text-right">2,500.00</td>
                                                <td class="text-right">2,500.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><i class="fa fa-minus-square fa-custom-remove"></i></td>
                                                <td>2</td>
                                                <td>STORAGE</td>
                                                <td class="text-center">1 x 40'HC</td>
                                                <td class="text-center">USD</td>
                                                <td class="text-right">500.00</td>
                                                <td class="text-right">500.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2"><strong>NET VALUE</strong></td>
                                                <td class="text-right"><strong>3,000.00</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2"><strong>VAT</strong></td>
                                                <td class="text-right"><strong>300.00</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2"><strong>AMMOUNT DUE</strong></td>
                                                <td class="text-right"><strong>3,300.00</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right" id="docedit">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-striped invoice-table no-margin">
                                        <thead>
                                            <tr>
                                                <td class="valign-middle text-center" rowspan="2" width="1%">-</td>
                                                <td class="valign-middle text-center" rowspan="2">#</td>
                                                <td class="valign-middle text-center" rowspan="2">CHARGES</td>
                                                <td class="valign-middle text-center" rowspan="2">BILL TO</td>
                                                <td class="valign-middle text-center" rowspan="2">TERMS</td>
                                                <td class="valign-middle text-center" rowspan="2">QTY</td>
                                                <td class="valign-middle text-center" rowspan="2">UNIT</td>
                                                <td class="valign-middle text-center" rowspan="2">TAX</td>
                                                <td class="valign-middle text-center" rowspan="2">CURR</td>
                                                <td class="valign-middle text-center" rowspan="2">AMOUNT</td>
                                                <td class="text-center" colspan="2">TOTAL</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" width="12%">USD</td>
                                                <td class="text-center" width="12%">IDR</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><i class="fa fa-plus-square fa-custom-add"></i></td>
                                                <td>1</td>
                                                <td>FREIGHT CHARGE</td>
                                                <td>MAYORA</td>
                                                <td>1 MONTH</td>
                                                <td>2</td>
                                                <td>40HC</td>
                                                <td>PPN1</td>
                                                <td>IDR</td>
                                                <td class="text-right">1,000,000.00</td>
                                                <td class="text-right">-</td>
                                                <td class="text-right">2,000,000.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><i class="fa fa-plus-square fa-custom-add"></i></td>
                                                <td>2</td>
                                                <td>TRUCKING</td>
                                                <td>HALIM</td>
                                                <td>1 DAY AFTER B/L</td>
                                                <td>1</td>
                                                <td>40DG</td>
                                                <td>PPN1</td>
                                                <td>USD</td>
                                                <td class="text-right">100.00</td>
                                                <td class="text-right">100.00</td>
                                                <td class="text-right">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Edit Invoice --}}

{{-- Modal Cancel --}}
<div class="modal fade" id="modal-cancel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cancel Invoice</h4>
            </div>
            <form action="" method="POST" role="form">
                <div class="modal-body">
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

@push('script')
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>

<script>
$(function(){
    @if(session('job'))
        $.get(`{{ url('/invoice/list/detail') }}`, {id: "{{session('job')}}"}, function(result){
            $("#tes").html(result);
        });
    @endif
    'use strict';
    var table = $('#myTable').DataTable({
        "serverSide": true,
        "ajax":{
            type : "POST",
            url : "/invoice/reimbursement/get/created"
        } ,
        "columnDefs": [
            { 
                targets: 0, 
                title: '#',
                data: "DT_Row_Index", 
                name: "DT_Row_Index", 
                orderable: false,
                searchable: false,
                width: "2%"
            },
            {
                targets: 1,
                title: 'INVOICE',
                data: null,
                name: 'code',
                render: function (data) {
                    var actions = '';
                    actions = `<a href="#3" class="detailJobSheet" aria-controls="3" role="tab" data-toggle="tab" data-id="${data['id']}">${data['code']}</a>`;
                    return actions.replace();
                },
                width: "13%",
                sClass: 'td-nowrap'
            },
            {
                targets: 2,
                title: '<span>CUSTOMER</span>',
                data: 'bill_to_name',
                defaultContent: "-",
                name: 'bill_to_name'
            },
            {
                targets: 3,
                title: '<span>JOB</span>',
                data: 'job_sheet.code',
                defaultContent: "-",
                name: 'jobSheet.code'
            },
            {
                targets: 4,
                title: '<span>DATE</span>',
                data: 'date',
                defaultContent: "-",
                name: 'date',
                width: "8%"
            },
            {
                targets: 5,
                title: '<span>TERM</span>',
                data: null,
                defaultContent: "-",
                name: 'reimbursement.term.name',
                render: function (data) {
                    if (data['reimbursement'][0]['term']['name'] == null){
                        var actions = "-";
                    } else {
                        var actions = data['reimbursement'][0]['term']['name'];
                    }
                    
                    return actions.replace();
                },
                width: "8%",
                orderable: false
            },
            {
                targets: 6,
                title: 'STATUS',
                data: null,
                name: 'status',
                render: function (data) {
                    var actions = '';
                    if(data['approval'] == 0)
                        actions = "<span class='label label-primary'>REQUESTED</span>";
                    else
                        actions = "<span class='label label-success'>APPROVED</span>"

                    return actions.replace();
                },
                sClass: 'td-nowrap',
                width: "8%"
            },
            {
                targets: 7,
                title: 'ACTION',
                data: null,
                name: 'status',
                render: function (data) {
                    var actions = '';
                    if(data['approval'] == 0)
                        actions = `<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit'><i class="fa fa-pencil"></i></button>
            <a href="/invoice/reimbursement/print/${data['id']}" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>`;
                    else
                        actions = `<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit' disabled><i class="fa fa-pencil"></i></button>
            <button class="btn btn-primary btn-sm" disabled><i class="fa fa-print"></i></button>`;

                    return actions.replace();
                },
                sClass: 'td-nowrap',
                width: "4%"
            },
            {
                targets : [2,3,4,5,6,7],
                render: function (data) {
                    //console.log(data);
                    var data = (data != '') ? data : '-';
                    var actions = `<span>${data}</span>`;
                    return actions.replace();
                },
                sClass: 'td-ellipsis'
            }
        ],
    });

    //array tab
    var arrayTabs = [];
    //angka urut untuk value array supaya ga double
    var numCount = 0;

    //buat jobsheet baru
    $('#myTable').on('click', '.detailJobSheet', function(event){
        event.stopPropagation();
        event.preventDefault();

        //title job
        var title = $(this).text();
        var jobId = $(this).data('id');
        //jika job tidak ada dlm array job, maka buat tab baru
        if(arrayTabs.indexOf(jobId) == -1){
            //masukkan unique identifier ke array tab
            arrayTabs.push(jobId);
            //element tab baru
            var elemTab = $(`<li role="presentation" class="tabs-tab" data-job="${jobId}">
                <a href="#${jobId}" aria-controls="${jobId}" role="tab" data-toggle="tab">INV: ${title}
                    <i class="tabs-close fa fa-times"></i>
                </a>
            </li>`);
            //element panel untuk tab
            var elemPanel = $(`<div role="tabpanel" class="tab-pane" id="${jobId}"></div>`);
            //masukkan tab baru
            //$('.nav-tabs-1').append(elemTab);
            elemTab.insertAfter($('.nav-tabs-1').find('li:eq(0)'));
            //load form pd panel
            $.get(`{{ url('/invoice/list/reimbursement/detail') }}`, {id: jobId}, function(result){
                elemPanel.html(result);
            });
            //masukkan element panel baru
            $('.tab-content-1').append(elemPanel);
            //trigger click tab baru setiap create new tab
            elemTab.find('a').trigger('click');
        }
        else{
            $(`[data-job="${jobId}"]`).find('a').trigger('click');
        }
    });

    //buat close tab jobsheet
    $('.nav-tabs').on('click', '.tabs-close', function(event){
        event.stopPropagation();
        event.preventDefault();

        var parent = $(this).parents('.tabs-tab');
        var id = parent.data('job');
        var activeTab = $('.tabs-tab.active').data('job');
        var nextElem = $('.tabs-tab.active').next('.tabs-tab');

        if(id == activeTab){
            if(nextElem.length > 0){
                $(this).parents('.tabs-tab').next().find('a').trigger('click');
            }
            else{
                $(this).parents('.tabs-tab').prev().find('a').trigger('click');
            }
        }

        parent.remove();
        $(`#${id}`).remove();

        var index = arrayTabs.indexOf(id);
        arrayTabs.splice(index, 1);
    });

    //btn filter search
    $('.btn-filter-search').click(function(){
        $('.filter-search').slideToggle(200);
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        $(this).toggleClass('btn-active');
    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: 'true',
        todayHighlight: 'true',
        format: 'dd-mm-yyyy'
    });
});
</script>
@endpush