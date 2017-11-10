@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endpush

@section('title', 'Dashboard')

@section('sidebar')
    @include('sidebar.invoice')
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- RECENT PURCHASES -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Invoice List</h3>
                    </div>
                    <div class="panel-body">
                        <button type="button" class="hidden" id="trg_detail" data-toggle="modal" data-target="#modalDetail"></button>
                        
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
                <!-- END RECENT PURCHASES -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail-->
<div id="modalDetail" class="modal fade " role="dialog">
    <div class="modal-dialog  modal-big">

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="panel-title">Detail Receivable</h4>
                </div>
                <!--START FORM DETAIL CASE CUSTOMER-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>References</h5>
                        </div>
                        <div class="col-md-4">
                        
                            <table class="table table-borderless detail-table">
                                <tbody>
                                    <tr>
                                        <td>No. Invoice</td>
                                        <td>:</td>
                                        <td>AR/04/17/1495</td>
                                    </tr>
                                    <tr>
                                        <td>Shipper</td>
                                        <td>:</td>
                                        <td>GULF COAST CO .LLC</td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td>:</td>
                                        <td>20 April 2017</td>
                                    </tr>
                                    <tr>
                                        <td>TERM</td>
                                        <td>:</td>
                                        <td>2 WEEKS</td>
                                    </tr>
                                    <tr>
                                        <td>POL</td>
                                        <td>:</td>
                                        <td>JAKARTA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-borderless detail-table">
                                <tbody>
                                    <tr>
                                        <td>POD</td>
                                        <td>:</td>
                                        <td>Susi</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>:</td>
                                        <td>Collect</td>
                                    </tr>
                                    <tr>
                                        <td>ETD</td>
                                        <td>:</td>
                                        <td>Titanic</td>
                                    </tr>
                                    <tr>
                                        <td>ETA</td>
                                        <td>:</td>
                                        <td>Food Of Life</td>
                                    </tr>
                                    <tr>
                                        <td>Vessel</td>
                                        <td>:</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>No. Job</td>
                                        <td>:</td>
                                        <td>0918/04/17/JKT</td>
                                    </tr>
                                    <tr>
                                        <td>MB/L</td>
                                        <td>:</td>
                                        <td>96536734309</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                        <div class="col-md-12">
                         <hr>
                            <h5>Detail Of Charge</h5>
                            <table class="table table-borderless detail-table">
                                <thead>
                                    <tr>
                                        <th class="col-md-2">Name</th>
                                        <th class="col-md-2">Qty</th>
                                        <th class="col-md-2">Unit Price (USD)</th>
                                        <th class="col-md-2">Unit Price (IDR)</th>
                                        <th class="col-md-2">Total (USD)</th>
                                        <th class="col-md-2">Total (IDR)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>FREIGHT CHARGES</td>
                                        <td>1 x 40'HC</td>
                                        <td>2,550.00</td>
                                        <td>-</td>
                                        <td>2,550.00</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><hr style="margin:0.5px"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>NET VALUE</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>2,550.00</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><hr style="margin:0.5px"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>VAT</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>-</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><hr style="margin:0.5px"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>AMMOUNT DUE</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>2,550.00</strong></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                          <!--END FORM DETAIL CASE CUSTOMER-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

    </div>
</div>
</div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

    <script>
    var showDetail;
    $(function(){
        var data = [
            [ 
                "1", 
                "AR/04/05/0017", 
                "PT. GOODFOOD INDONESIA", 
                "04 April 2017",
                "2 WEEKS",
                "1234/02/03/JKT", 
                "FRUIT POWDER ASORTED",
                `<button class='btn btn-primary btn-xs' onclick='showDetail(this)'><i class='fa fa-info fa-fw'></i></button>
                 <a href="/invoice/print" class='btn btn-success btn-xs'><i class='fa fa-print fa-fw'></i></a>`
            ],
            [ 
                "2", 
                "AR/04/05/0018", 
                "PT. INKOMAS LESTARI",
                "11 April 2017",
                "2 WEEKS", 
                "1235/02/05/SBY", 
                "GEGA INSTANT FRUIT POWDER",
                `<button class='btn btn-primary btn-xs' onclick='showDetail(this)'><i class='fa fa-info fa-fw'></i></button>
                <a href="/invoice/gex/print" class='btn btn-success btn-xs'><i class='fa fa-print fa-fw'></i></a>`
            ],
        ];

        $('#myTable').DataTable({
            "data": data,
            "columns" : [
                { "title": "No." },
                { "title": "No. Inv" },
                { "title": "Shipper" },
                { "title": "Date" },
                { "title": "Term Of Payment" },
                { "title": "No. Job" },
                { "title": "Description" },
                { "title": "Action", "width": "15%" }
            ]
        });
    });
    showDetail = function(e){
        var id = $(e).attr('id');
        //tambahin ajax buat get data terus lempar ke modal
        $('#trg_detail').trigger('click');
    }
    </script>
@endpush