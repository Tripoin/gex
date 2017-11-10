@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Revision Reimbursement')

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
                    <div class="panel-heading">
                        <h3 class="panel-title">Revision Reimbursement</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="btn-filter-search"><i class="fa fa-chevron-down"></i></div>
                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTable">
                                
                            </table>
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
                <h4 class="modal-title">Edit Invoice Reimbursement</h4>
            </div>
            <form action="" method="POST" role="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="clearfix">
                                <div class="col-sm-6 no-padding-left">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">REASON</label>
                                        <label class="control-label col-sm-2 col-md-1 no-padding-left no-padding-right">:</label>
                                        <label class="control-label col-sm-7 col-md-8">LOREM IPSUM DOLOR SIT ALMET, WATASIWA UONO UENI</label>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1 no-padding-right">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">USER</label>
                                        <label class="control-label col-sm-2 col-md-1 no-padding-right">:</label>
                                        <label class="control-label col-sm-6 col-md-7 label-right">BIG BOSS</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
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
                                                <td>B. PENGGANTIAN STORAGE</td>
                                                <td class="text-center">1 x 40'HC</td>
                                                <td class="text-center">USD</td>
                                                <td class="text-right">2,500.00</td>
                                                <td class="text-right">2,500.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" colspan="6"><strong>TOTAL</strong></td>
                                                <td class="text-right"><strong>3,000.00</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right" id="docedit">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-striped no-margin">
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
                                                <td class="text-center" colspan="12">Tidak Ada Data</td>
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
<div class="modal fade" id="modal-decline">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cancel Invoice</h4>
            </div>
            <form action="" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">RETURN TO</label>
                        <select name="" id="" class="form-control input-sm">
                            <option value="">OPERATION</option>
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

@push('script')
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>

<script>
$(function(){
    'use strict';

    var data = [
        [ 
            "1", 
            `<a href="#3" class="detailJobSheet" aria-controls="3" role="tab" data-toggle="tab" data-id="3">AR/04/05/0017</a>`,
            "PT. GOODFOOD INDONESIA", 
            "1234/02/03/JKT",
            "04 April 2017",
            "2 WEEKS",
            "20 April 2017",
            "<span class='label label-primary'>SUPERVISOR</span>",
            `<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit'><i class="fa fa-pencil fa-fw"></i></button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" href='#modal-decline'><i class="fa fa-reply fa-fw"></i></button>`
        ],
        [ 
            "2", 
            `<a href="#2" class="detailJobSheet" aria-controls="2" role="tab" data-toggle="tab" data-id="2">AR/04/05/0018</a>`,
            "PT. INKOMAS LESTARI",
            "1235/02/05/SBY",
            "11 April 2017",
            "2 WEEKS", 
            "16 April 2017",
            "<span class='label label-primary'>INVOICE</span>",
            `<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit'><i class="fa fa-pencil fa-fw"></i></button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" href='#modal-decline'><i class="fa fa-reply fa-fw"></i></button>`
        ],
        [ 
            "3", 
            `<a href="#1" class="detailJobSheet" aria-controls="1" role="tab" data-toggle="tab" data-id="1">AR/04/05/0019</a>`,
            "PT. UNILEVER INDONESIA",
            "1235/02/05/JKT",
            "16 April 2017",
            "4 WEEKS", 
            "20 April 2017",
            "<span class='label label-primary'>SUPERVISOR</span>",
            `<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit'><i class="fa fa-pencil fa-fw"></i></button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" href='#modal-decline'><i class="fa fa-reply fa-fw"></i></button>`
        ],
    ];

    $('#myTable').DataTable({
        "data": data,
        "columns" : [
            { "title": "#", "width": "1%" },
            { "title": "INVOICE" },
            { "title": "CUSTOMER" },
            { "title": "JOB" },
            { "title": "DATE" },
            { "title": "TERMS" },
            { "title": "RETURNED DATE" },
            { "title": "RETURNED BY" },
            { "title": "ACTION", "width": "9%" }
        ]
    });

    //add new doc
    $('.add-doc').click(function(){
        var elem = `<div class="form-group">
            <div class="col-md-4 col-md-offset-2 no-padding-right">
                <div class="input-group">
                    <select name="document[]" id="" class="form-control input-sm" required="required">
                        <option value="">DOCUMENT</option>
                        <option value="1">MB/L</option>
                        <option value="2">HB/L</option>
                    </select>
                    <span class="input-group-btn"><button class="btn btn-danger btn-sm rem-doc" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control input-sm" id="email" placeholder="No. Reference" readonly>
            </div>
        </div>`;

        $('.document-group').append(elem);
    });

    //remove doc
    $('.document-group').on('click', '.rem-doc', function(){
        $(this).parents('.form-group').remove();
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