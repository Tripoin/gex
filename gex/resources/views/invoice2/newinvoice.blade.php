@extends('layouts.layout')

@section('title', 'Dashboard')

@section('sidebar')
    @include('sidebar.invoice')
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                <!-- JOBSHEET -->
                <div class="panel">
                    <div class="panel-body no-padding">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="tabs-tab active" data-job="newjob0">
                                    <a href="#newjob0" aria-controls="newjob0" role="tab" data-toggle="tab">Create Invoice
                                        <i class="tabs-close fa fa-times"></i>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#new" id="createJobSheet" aria-controls="new" role="tab"><i class="fa fa-plus fa-fw"></i></a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="newjob0">
                                    <form action="" method="POST" class="form-horizontal" role="form">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Nomer JOB</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="No Jobsheet" value="0123/08/03/JKT">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" >Shipper</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control input-sm" name="shipper" disabled>
                                                            <option>Mayora</option>
                                                            <option>Unilever</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Term</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Term Of Payment" value="2 WEEKS (dari Jobsheet)" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">POL</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Port Of Loading" value="Jakarta (dari Jobsheet)" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">POD</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Port Of Destination" value="BERBERA SOMALIA (dari Jobsheet)" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Description</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Description" value="GEGA INSTANT FRUIT POWDER (dari jobsheet)" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">ETD</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Estimated Time Of Departure" value="10 January 2017" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">ETA</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Estimated Time Of Arrival" value="16 January 2017" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Vessel</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control input-sm" id="email" placeholder="Enter Vessel" value="Titanic" readonly>
                                                    </div>
                                                </div>
                                                <div class="document-group">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">Documents</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <select name="" id="" class="form-control input-sm" required="required" disabled>
                                                                    <option value="">DOCUMENT</option>
                                                                    <option value="">MB/L</option>
                                                                    <option value="">HB/L</option>
                                                                    <option value="">PEB</option>
                                                                    <option value="">PART OFF</option>
                                                                    <option value="">SPLIT</option>
                                                                    <option value="">DO</option>
                                                                    <option value="">CONTAINER</option>
                                                                </select>
                                                                <span class="input-group-btn"><button class="btn btn-primary btn-sm add-doc" type="button"><i class="fa fa-plus"></i></button></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <span class="panel-title col-sm-12" style="margin-bottom: 20px">Detail Of Charges</span>
                                            <div class="col-sm-12">
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
                                        <div class="row">
                                            
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END JOBSHEET -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script>
$(function(){
    'use strict';
    //array tab
    var arrayTabs = ['newjob0'];
    //angka urut untuk value array supaya ga double
    var numCount = 0;

    //buat jobsheet baru
    $('#createJobSheet').click(function(event){
        event.stopPropagation();
        event.preventDefault();
        //unique tab identifier
        var newJob = `newjob${++numCount}`;
        //masukkan unique identifier ke array tab
        arrayTabs.push(newJob);
        //element tab baru
        var elemTab = $(`<li role="presentation" class="tabs-tab" data-job="${newJob}">
            <a href="#${newJob}" aria-controls="${newJob}" role="tab" data-toggle="tab">Create Invoice ${numCount+1}
                <i class="tabs-close fa fa-times"></i>
            </a>
        </li>`);
        //element panel untuk tab
        var elemPanel = $(`<div role="tabpanel" class="tab-pane" id="${newJob}"></div>`);
        //masukkan tab baru, posisi sebelum tombol create new
        elemTab.insertBefore($(this).parent());
        //load form pd panel
        elemPanel.load(`{{ url('/invoice/form') }}`);
        //masukkan element panel baru
        $('.tab-content').append(elemPanel);
        //trigger click tab baru setiap create new tab
        $(this).parent().prev().find('a').trigger('click');
    });

    //buat close tab jobsheet
    $('.nav-tabs').on('click', '.tabs-close', function(event){
        event.stopPropagation();
        event.preventDefault();

        var parent = $(this).parents('.tabs-tab');
        var id = parent.data('job');
        var activeTab = $('.tabs-tab.active').data('job');
        var nextElem = $('.tabs-tab.active').next('.tabs-tab');

        if(arrayTabs.length <= 1){
            $('#createJobSheet').trigger('click');
        }

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
    $('.tab-content').on('click', '.add-doc', function(){
        var elem = `<div class="form-group">
        <label class="col-sm-4 control-label">Documents</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <select name="" id="" class="form-control input-sm" required="required">
                        <option value="">DOCUMENT</option>
                        <option value="">MB/L</option>
                        <option value="">HB/L</option>
                        <option value="">PEB</option>
                        <option value="">PART OFF</option>
                        <option value="">SPLIT</option>
                        <option value="">DO</option>
                        <option value="">CONTAINER</option>
                    </select>
                    <span class="input-group-btn"><button class="btn btn-sm btn-danger rem-doc" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>
            
        </div>`;

        $(this).parents('.document-group').append(elem);
    });

    //remove doc
    $('.tab-content').on('click', '.rem-doc', function(){
        $(this).parents('.form-group').remove();
    });

    //DATA TABLE
     $(function(){
        var data = [
            [ 
                "",
                "1", 
                "1123/08/02/JKT", 
                "Mayora", 
                "FREIGHT CHARGE (B/L)",
                "PT. BUMI LAUT SHIPPING",
                "4", 
                "40HC",
                "5200000",
                "PPN2"
            ],
            [ 
                "",
                "2", 
                "1123/08/02/JKT", 
                "Wings Food", 
                "SWITCH B/L CHARGES",
                "6",
                "SET",
                "2600000",
                "PPN1"
            ],
        ];

        $('#myTable').DataTable({
            "data": data,
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                        return '<input type="checkbox" data-id="'+data[0]+'" class="check-receivable" value="' + $('<div/>').text(data).html() + '" onchange="showfooter(this)">';
                    }
                }],
            "columns" : [
                { "title": "select" },
                { "title": "No." },
                { "title": "No. Job" },
                { "title": "Customer" },
                { "title": "Detail Of Charge" },
                { "title": "Quantity" },
                { "title": "Unit" },
                { "title": "Price" },
                { "title": "Tax" }
            ]
        });
    });
});
</script>
@endpush