@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Request List')

@section('sidebar')
    @include('sidebar.pricing')
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- RECENT PURCHASES -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Request</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row filter-search">
                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    <lable>Date</lable>
                                    <input type="text" class="form-control input-sm datepicker" id="email" placeholder="Filter Date">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    <lable>Job No.</lable>
                                    <input id="customer" class="form-control input-sm" placeholder="Filter No. Job">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    <lable>Customer</lable>
                                    <input id="customer" class="form-control input-sm" placeholder="Filter Customer">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    <lable>Vendor</lable>
                                    <input type="text" class="form-control input-sm" id="email" placeholder="Filter Vendor">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    <lable>References</lable>
                                    <input type="text" class="form-control input-sm" id="email" placeholder="Filter References">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    <lable>Port</lable>
                                    <input type="text" class="form-control input-sm" id="email" placeholder="Filter Port">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="btn-filter-search"><i class="fa fa-chevron-down"></i></div>
                            <table class="table table-bordered table-body-condensed table-striped" id="myTable">
                                {{--<thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Job</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Marketing</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>--}}
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END RECENT PURCHASES -->
            </div>
        </div>
    </div>
</div>

{{-- DETAIL REQUEST --}}
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail Request</h4>
            </div>
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label col-sm-5">CREATE DATE</label>
                                <label class="control-label col-sm-2 col-md-1 no-padding-left no-padding-right">:</label>
                                <label class="control-label col-sm-5 col-md-6">04 APRIL 2017</label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="form-group">
                                <label class="control-label col-sm-4">REQUEST DATE</label>
                                <label class="control-label col-sm-2 col-md-1 no-padding-right">:</label>
                                <label class="control-label col-sm-6 col-md-7 label-right">07 APRIL 2017</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="valign-middle text-center" rowspan="2">#</th>
                                <th class="valign-middle text-center" rowspan="2">NO. JOB</th>
                                <th class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</th>
                                <th class="valign-middle text-center" rowspan="2">VENDOR</th>
                                <th class="valign-middle text-center" rowspan="2">QTY</th>
                                <th class="valign-middle text-center" rowspan="2">UNIT</th>
                                <th class="valign-middle text-center" rowspan="2">CURR</th>
                                <th class="valign-middle text-center" rowspan="2">AMOUNT</th>
                                <th class="text-center" colspan="2">SUBTOTAL</th>
                            </tr>
                            <tr>
                                <td class="text-center" width="10%">USD</td>
                                <td class="text-center" width="10%">IDR</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1 <input type="hidden"></td>
                                <td>0004/04/17/JKT</td>
                                <td>FREIGHT CHARGE</td>
                                <td>PT. INKOMAS LESTARI</td>
                                <td>1</td>
                                <td>40HC</td>
                                <td>IDR</td>
                                <td class="text-right">1,000,000.00</td>
                                <td class="text-right">-</td>
                                <td class="text-right">1,000,000.00</td>
                            </tr>
                            <tr>
                                <td>2 <input type="hidden"></td>
                                <td>0004/04/17/JKT</td>
                                <td>TRUCKING</td>
                                <td>PT. INKOMAS LESTARI</td>
                                <td>2</td>
                                <td>40HC</td>
                                <td>USD</td>
                                <td class="text-right">100.00</td>
                                <td class="text-right">200.00</td>
                                <td class="text-right">-</td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="8"><strong>TOTAL</strong></td>
                                <td class="text-right"><strong>100.00</strong></td>
                                <td class="text-right"><strong>2,150,000.00</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- END DETAIL REQUEST --}}
@endsection

@push('script')
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>
<script>
$(function(){
    var table = $('#myTable').DataTable({
        "serverSide": true,
        "ajax":{
            type : "GET",
            url : "/pricing/request/list/get"
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
                title: '<span>CREATED DATE</span>',
                data: 'created_at',
                defaultContent: "-",
                name: 'created_at'
            },
            {
                targets: 2,
                title: '<span>JOB</span>',
                data: 'job_sheet.code',
                defaultContent: "-",
                name: 'jobSheet.code'
            },
            {
                targets: 3,
                title: '<span>REQUEST DATE</span>',
                data: 'payable_request.date',
                defaultContent: "-",
                name: 'payableRequest.date'
            },
            {
                targets: 4,
                title: '<span>CHARGE</span>',
                data: 'charge.name',
                defaultContent: "-",
                name: 'charge.name'
            },
            {
                targets: 5,
                title: '<span>VENDOR</span>',
                data: 'vendor.name',
                defaultContent: "-",
                name: 'vendor.name'
            },
            {
                targets: 6,
                title: '<span>QTY</span>',
                data: 'qty',
                defaultContent: "-",
                name: 'qty'
            },
            {
                targets: 7,
                title: '<span></span>',
                data: null,
                defaultContent: "x",
                name: 'nol',
                render: function (data) {
                    var actions = 'x';
                    return actions;
                },
                orderable: false,
                searchable: false,
                width: "2%"
            },
            {
                targets: 8,
                title: '<span>UNIT</span>',
                data: 'unit.name',
                defaultContent: "-",
                name: 'unit.name'
            },
            {
                targets: 9,
                title: '<span>CURR</span>',
                data: null,
                defaultContent: "-",
                render: function (data) {
                    var actions = '';
                    if(data['curency'] == 1) {
                        actions = "IDR";
                    } else {
                        actions ="USD";
                    }
                    return actions;
                },
                name: 'curency'
            },
            {
                targets: 10,
                title: '<span>AMMOUNT</span>',
                data: null,
                defaultContent: "-",
                render: function (data) {
                    var number = data['price'];
                    var actions = `<div class="text-right">${number}</div>`;
                    return actions;
                },
                name: 'price'
            },
            {
                targets: 11,
                title: '<span>TOTAL</span>',
                data: null,
                defaultContent: "-",
                render: function (data) {
                    var number = parseFloat(data['qty'])*parseFloat(data['price']);
                    var actions = `<div class="text-right">${number}</div>`;
                    return actions.replace();
                },
                name: 'total',
                orderable: false,
                searchable: false
            }
        ],
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