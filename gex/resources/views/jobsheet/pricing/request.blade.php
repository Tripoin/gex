@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@section('title', 'Request')

@section('sidebar')
    @include('sidebar.pricing')
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- CHARGES REQUEST -->
                <div class="panel">
                    <div class="panel-body no-padding">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-2" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tabjobsheet" class="disabled" id="tabjobsheetlink" aria-controls="tabjobsheet" role="tab" data-toggle="tab">JOB SHEET</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tabrequest" class="disabled" id="tabrequestlink" aria-controls="tabrequest" role="tab" data-toggle="tab">REQUEST</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tabjobsheet">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-body-condensed table-striped" id="myTable">
                                            
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tabrequest">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-body-condensed table-striped" id="myTableRequest">
                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary select" id="request_process">Select</button>
                        <button class="btn btn-default back hidden">Back</button>
                        <button class="btn btn-primary btn-sendreq hidden" data-toggle="modal" id="btn-modal" href='#modal-request'>Request</button>
                    </div>
                </div>
                <!-- END CHARGES REQUEST -->
            </div>
        </div>
    </div>
</div>

<!-- MODAL CHARGES REQUEST -->
<div class="modal fade" id="modal-request">
    <div class="modal-dialog modal-big">
        <div class="modal-content">
            <form action="/pricing/request/store" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Request Selected Charges</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group margin-bottom">
                        <label class="control-label col-md-1 col-md-offset-8 label-right">DATE</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm datepicker" placeholder="Needed Date" name="date_request">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="valign-middle text-center" rowspan="2">#</th>
                                <th class="valign-middle text-center" rowspan="2">NO. JOB</th>
                                <th class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</th>
                                <th class="valign-middle text-center" rowspan="2">VENDOR</th>
                                <th class="valign-middle text-center" rowspan="2">QTY</th>
                                <th class="valign-middle text-center" rowspan="2">X</th>
                                <th class="valign-middle text-center" rowspan="2">UNIT</th>
                                <th class="valign-middle text-center" rowspan="2">CURR</th>
                                <th class="valign-middle text-center" rowspan="2">AMOUNT</th>
                                <th class="text-center" colspan="2">TOTAL</th>
                            </tr>
                            <tr>
                                <td class="text-center" width="10%">USD</td>
                                <td class="text-center" width="10%">IDR</td>
                            </tr>
                        </thead>
                        <tbody id="body_request">
                            
                            <tr>
                                <td class="text-center" colspan="9"><strong>TOTAL</strong></td>
                                <td class="text-right"><strong id="total_usd">100.00</strong></td>
                                <td class="text-right"><strong id="total_idr">2,150,000.00</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL CHARGES REQUEST -->
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>

    <script>
    var id_check = new Array();
    var id_req = new Array();
    var tr = "";
    $(function(){
        var table = $('#myTable').DataTable({
            "serverSide": true,
            "ajax":{
                type : "GET",
                url : "/pricing/request/get"
            } ,
            "columnDefs": [
                {
                    targets: 0,
                    title: '-',
                    data: null,
                    name: 'code',
                    render: function (data) {
                        var actions = '';
                        actions = '<label class="fancy-checkbox"><input class="check-req" type="checkbox" value="'+data['id']+'"><span></span></label>';
                        return actions.replace();
                    },
                    sClass: 'td-nowrap',
                    width: "1%",
                    orderable: false,
                    searchable: false
                },
                { 
                    targets: 1, 
                    title: '#',
                    data: "DT_Row_Index", 
                    name: "DT_Row_Index", 
                    orderable: false,
                    searchable: false,
                    width: "2%"
                },
                {
                    targets: 2,
                    title: '<span>JOB</span>',
                    data: 'code',
                    defaultContent: "-",
                    name: 'code'
                },
                {
                    targets: 3,
                    title: '<span>DATE</span>',
                    data: 'date',
                    defaultContent: "-",
                    name: 'date'
                },
                {
                    targets: 4,
                    title: '<span>CUSTOMER</span>',
                    data: 'customer[, ].nick_name',
                    defaultContent: "-",
                    name: 'customer.nick_name'
                },
                {
                    targets: 5,
                    title: '<span>ORIGIN</span>',
                    data: 'poo.city',
                    defaultContent: "-",
                    name: 'poo.city'
                },
                {
                    targets: 6,
                    title: '<span>DESTINATION</span>',
                    data: 'pod.city',
                    defaultContent: "-",
                    name: 'pod.city'
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

        $('#myTable').on('change','.check-req', function() {
            if(this.checked){
                id_check.push($(this).val()); 
            } else {
                for (var i = 0; i < id_check.length; i++)
                    if (id_check[i] == $(this).val()) { 
                        id_check.splice(i, 1);
                        break;
                    }
            }
        });

        $("#request_process").click(function(){
            var table2 = $('#myTableRequest').DataTable({
                "serverSide": true,
                "ajax":{
                    type : "POST",
                    url : "/pricing/request/detail/get",
                    data: function (d){
                        d.id_job = id_check;
                    }
                } ,
                "columnDefs": [
                    {
                        targets: 0,
                        title: '-',
                        data: null,
                        name: 'code',
                        render: function (data) {
                            var actions = '';
                            actions = '<label class="fancy-checkbox"><input class="check-req-process" type="checkbox" value="'+data['id']+'"><span></span></label>';
                            return actions.replace();
                        },
                        sClass: 'td-nowrap',
                        width: "1%",
                        orderable: false,
                        searchable: false
                    },
                    { 
                        targets: 1, 
                        title: '#',
                        data: "DT_Row_Index", 
                        name: "DT_Row_Index", 
                        orderable: false,
                        searchable: false,
                        width: "2%"
                    },
                    {
                        targets: 2,
                        title: '<span>JOB</span>',
                        data: 'job_sheet.code',
                        defaultContent: "-",
                        name: 'jobSheet.code',
                        width: "12%"
                    },
                    {
                        targets: 3,
                        title: '<span>CHARGES</span>',
                        data: 'charge.name',
                        defaultContent: "-",
                        name: 'charge.name'
                    },
                    {
                        targets: 4,
                        title: '<span>VENDOR</span>',
                        data: 'vendor.nick_name',
                        defaultContent: "-",
                        name: 'vendor.nick_name'
                    },
                    {
                        targets: 5,
                        title: '<span>QTY</span>',
                        data: null,
                        defaultContent: "-",
                        name: 'qty',
                        render: function (data) {
                            var number = data['qty'];
                            var actions = `<div class="text-center">${number}</div>`;
                            return actions.replace();
                        },
                    },
                    {
                        targets: 6,
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
                        targets: 7,
                        title: '<span>UNIT</span>',
                        data: 'unit.name',
                        defaultContent: "-",
                        name: 'unit.name'
                    },
                    {
                        targets: 8,
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
                        targets: 9,
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
                        targets: 10,
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
                    },
                    {
                        targets : [2,3,4,5,6,7,8,9,10],
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
        });
     
         $('#myTableRequest').on('change','.check-req-process', function() {
            if(this.checked){
                id_req.push($(this).val()); 
            } else {
                for (var i = 0; i < id_req.length; i++)
                    if (id_req[i] == $(this).val()) { 
                        id_req.splice(i, 1);
                        break;
                    }
            }
        });

        $("#btn-modal").click(function(){
            $.post("/pricing/request/detail/get/payable",{"id_job": id_req}, function(data, status){
                if(status == "success"){
                    var data_request = "";
                    var len = data.length;
                    var total_idr = 0;
                    var total_usd = 0;
                    for(var i = 0; i < len; i++ ){
                        var curency = "";
                        var nilai_idr = 0;
                        var nilai_usd = 0;
                        if(data[i].currency == 1) {
                            curency = 'IDR';
                            nilai_idr = data[i].qty*data[i].price;
                            total_idr = total_idr + nilai_idr;
                        } else {
                            curency = 'USD';
                            nilai_usd = data[i].qty*data[i].price;
                            total_usd = total_usd + nilai_usd;
                        }
                        data_request += `<tr class="request_list">
                                        <td>${i+1} <input type="hidden" name="id_payable[]" value="${data[i].id}"></td>
                                        <td>${data[i].job_sheet.code}</td>
                                        <td>${data[i].charge.name}</td>
                                        <td>${data[i].vendor.nick_name}</td>
                                        <td>${data[i].qty}</td>
                                        <td>x</td>
                                        <td>${data[i].unit.name}</td>
                                        <td>${curency}</td>
                                        <td class="text-right">${data[i].price}</td>
                                        <td class="text-right">${nilai_usd}</td>
                                        <td class="text-right">${nilai_idr}</td>
                                    </tr>`;
                    }

                    $(".request_list").remove();
                    $("#body_request").prepend(data_request);
                    $("#total_idr").text(total_idr);
                    $("#total_usd").text(total_usd);
                } else {
                    alert("Maaf Sedang Gangguan, unit tidak bisa di tampilkan");
                }
            });
        });
        //btn select di request
        $('.select').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
            $('.btn-sendreq').removeClass('hidden');
            $('.back').removeClass('hidden');
            $('.select').addClass('hidden');
        });

        //btn back di request
        $('.back').click(function(){
            location.reload();
            //$('.nav-tabs > .active').prev('li').find('a').trigger('click');
            //$('.btn-sendreq').addClass('hidden');
            //$('.back').addClass('hidden');
            //$('.select').removeClass('hidden');
        });

        //datepicker
        $('.datepicker').datepicker({
            autoclose: 'true',
            todayHighlight: 'true',
            format: 'dd-mm-yyyy'
        });

        /*$('.check-req').click(function(){
            if($(this).is(':checked')){
                $('.panel-footer').css('display', 'block');
            }
            else{
                if($('.check-req:checked').length == 0){
                    $('.panel-footer').css('display', 'none');
                }
            }
        });*/
    });
    </script>
@endpush