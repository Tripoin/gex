@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Job Sheet')

@section('sidebar')
    @include('sidebar.pricing')
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- JOB SHEET -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Report</h3>
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
                            <table class="table table-bordered table-condensed" id="myTable">
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
            '0004/04/17/JKT', 
            "24 Mei 2017", 
            "Wings Food",
            "JKT", 
            "ZIMBABWE",
            "<span class='label label-warning'>UNCOMPLETED</span>"
        ],
        [ 
            "2", 
            '0003/04/17/JKT', 
            "11 April 2017", 
            "Mayora",
            "JKT", 
            "IRAN",
            "<span class='label label-warning'>UNCOMPLETED</span>"
        ],
        [ 
            "3", 
            '0002/04/17/JKT',
            "05 Januari 2017", 
            "Indofood",
            "JKT", 
            "BRAZIL",
            "<span class='label label-warning'>UNCOMPLETED</span>"
        ],
        [ 
            "4", 
            '0001/04/17/JKT', 
            "03 Januari 2017", 
            "Indofood", 
            "JKT", 
            "KUWAIT", 
            "<span class='label label-success'>COMPLETED</span>"
        ],
    ];

    $('#myTable').DataTable({
        "data": data,
        "columns" : [
            { "title": "#" },
            { "title": "NO. JOB" },
            { "title": "DATE" },
            { "title": "CUSTOMER" },
            { "title": "ORIGIN" },
            { "title": "DESTINATION" },
            { "title": "STATUS" }
        ]
    });

    //array tab
    var arrayTabs = [];
    //angka urut untuk value array supaya ga double
    var numCount = 0;

    //buat jobsheet baru
    $('.detailJobSheet').click(function(event){
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
                <a href="#${jobId}" aria-controls="${jobId}" role="tab" data-toggle="tab">JOB: ${title}
                    <i class="tabs-close fa fa-times"></i>
                </a>
            </li>`);
            //element panel untuk tab
            var elemPanel = $(`<div role="tabpanel" class="tab-pane" id="${jobId}"></div>`);
            //masukkan tab baru
            $('.nav-tabs').append(elemTab);
            //load form pd panel
            elemPanel.load(`{{ url('/operation/jobsheet/detail') }}`);
            //masukkan element panel baru
            $('.tab-content').append(elemPanel);
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