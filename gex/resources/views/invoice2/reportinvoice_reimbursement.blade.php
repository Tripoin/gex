@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Report Charges')

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
                        <h3 class="panel-title">Report Invoice</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row filter-search text-right">
                            <div class="col-sm-5 col-md-2 col-md-offset-7 no-padding-right">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm datepicker" id="email" placeholder="Start Date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-2 no-padding-right">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm datepicker" id="email" placeholder="End Date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1 col-md-1">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-search fa-fw"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="btn-filter-search"><i class="fa fa-chevron-down"></i></div>
                            <table class="table table-bordered" id="myTable">
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
                    <div class="panel-footer text-right">
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-word-o fa-fw"></i> WORD</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i> EXCEL</button>
                    </div>
                </div>
                <!-- END JOB SHEET -->
            </div>
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
            "<span class='label label-warning'>PENDING</span>",
            //`<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit'><i class="fa fa-pencil"></i></button>`
        ],
        [ 
            "2", 
            `<a href="#2" class="detailJobSheet" aria-controls="2" role="tab" data-toggle="tab" data-id="2">AR/04/05/0018</a>`,
            "PT. INKOMAS LESTARI",
            "1235/02/05/SBY",
            "11 April 2017",
            "2 WEEKS", 
            "<span class='label label-success'>APPROVED</span>",
            //`<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit' disabled><i class="fa fa-pencil"></i></button>`
        ],
        [ 
            "3", 
            `<a href="#1" class="detailJobSheet" aria-controls="1" role="tab" data-toggle="tab" data-id="1">AR/04/05/0019</a>`,
            "PT. UNILEVER INDONESIA",
            "1235/02/05/JKT",
            "16 April 2017",
            "4 WEEKS", 
            "<span class='label label-success'>APPROVED</span>",
            //`<button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-edit' disabled><i class="fa fa-pencil"></i></button>`
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
            { "title": "TERM OF PAYMENT" },
            { "title": "STATUS"},
        ]
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