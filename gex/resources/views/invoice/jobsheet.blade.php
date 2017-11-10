@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Job Sheet')

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
                                    <li role="presentation" class="active">
                                        <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">JOB SHEET</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content tab-content-1">
                                <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
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

{{-- Modal Decline --}}
<div class="modal fade" id="modal-decline">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Decline Job Sheet</h4>
            </div>
            <form action="/invoice/jobsheet/decline" method="POST" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">RETURN TO</label>
                        <select name="to" id="" class="form-control input-sm">
                            <option value="1">OPERATION</option>
                            <option value="2">MARKETING</option>
                        </select>
                        <input type="hidden" name="id_job" id="id_job_rev">
                    </div>
                    <div class="form-group">
                        <label for="">REASON</label>
                        <textarea type="text" class="form-control" id="" placeholder="Input reason" name="decline_reason"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Decline --}}
@endsection

@push('script')
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>

<script>
$(function(){
    'use strict';
    var table = $('#myTable').DataTable({
        "serverSide": true,
        "ajax":{
            type : "POST",
            url : "/invoice/jobsheet/get"
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
                title: 'JOB',
                data: null,
                name: 'jobSheet.code',
                render: function (data) {
                    var actions = '';
                    actions = `<a href="#${data['id']}" class="detailJobSheet" aria-controls="${data['id']}" role="tab" data-toggle="tab" data-id="${data['id']}">${data['code']}</a>`;
                    return actions.replace();
                },
                sClass: 'td-nowrap',
                orderable: false,
                searchable: false
            },
            {
                targets: 2,
                title: '<span>DATE</span>',
                data: 'date',
                defaultContent: "-",
                name: 'date'
            },
            {
                targets: 3,
                title: '<span>CUSTOMER</span>',
                data: 'customer[, ].nick_name',
                defaultContent: "-",
                name: 'customer.nick_name'
            },
            {
                targets: 4,
                title: '<span>ORIGIN</span>',
                data: 'poo.city',
                defaultContent: "-",
                name: 'poo.city'
            },
            {
                targets: 5,
                title: '<span>DESTINATION</span>',
                data: 'pod.city',
                defaultContent: "-",
                name: 'pod.city'
            },
            {
                targets: 6,
                title: '<span>MARKETING</span>',
                data: 'marketing.name',
                defaultContent: "-",
                name: 'marketing.name'
            },
            {
                targets : [2,3,4,5,6],
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
    $('#myTable').on('click','.detailJobSheet', function(event){
        event.stopPropagation();
        event.preventDefault();
        console.log("bangke");
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
            //$('.nav-tabs').append(elemTab);
            elemTab.insertAfter($('.nav-tabs-1').find('li:eq(0)'));
            //load form pd panel
            $.get(`{{ url('/invoice/jobsheet/detail') }}`, {id: jobId}, function(result){
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

    //btn filter search
    $('.btn-filter-search').click(function(){
        $('.filter-search').slideToggle(200);
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        $(this).toggleClass('btn-active');
    });

    //hide references
    $('.tab-content').on('click', '.hide-ref', function(){
        $(this).siblings('.ref-detail').slideToggle(200);
        $(this).toggleClass('no-margin-top').toggleClass('show-ref');
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