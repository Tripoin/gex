<form action="" method="POST" class="form-horizontal" role="form">
    <div class="row ref-detail">
        <div class="col-sm-4">
            <table class="table table-borderless table-condensed detail-table no-margin">
                {{-- <tr>
                    <td>No. Job</td>
                    <td>:</td>
                    <td class="td-input"><input type="text" class="form-control input-sm" id="email" placeholder="Enter Job Sheet"></td>
                </tr> --}}
                <tr>
                    <td>CUSTOMER</td>
                    <td>:</td>
                    <td>{{$customer[0]['nick_name']}}</td>
                </tr>
                <tr>
                    <td>ORIGIN</td>
                    <td>:</td>
                    <td>{{$poo['city']}}</td>
                </tr>
                <tr>
                    <td>DESTINATION</td>
                    <td>:</td>
                    <td>{{$pod['city']}}</td>
                </tr>
                <tr>
                    <td>PARTY/MEAS</td>
                    <td>:</td>
                    <td>{{$partymeas}}</td>
                </tr>
                <tr>
                    <td>REMARKS</td>
                    <td>:</td>
                    <td>{{$remarks}}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-4">
            <table class="table table-borderless table-condensed detail-table no-margin">
                <tr>
                    <td>MARKETING</td>
                    <td>:</td>
                    <td>{{$marketing['name']}}</td>
                </tr>
                <tr>
                    <td>FREIGHT TYPE</td>
                    <td>:</td>
                    <td>{{$freight_type}}</td>
                </tr>
                <tr>
                    <td>VESSEL</td>
                    <td>:</td>
                    <td>{{$vessel}}</td>
                </tr>
                <tr>
                    <td>DESCRIPTION</td>
                    <td>:</td>
                    <td>{{$description}}</td>
                </tr>
                <tr>
                    <td>INSTRUCTION</td>
                    <td>:</td>
                    <td>{{$instruction}}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-4">
            <table class="table table-borderless table-condensed detail-table no-margin">
                <tr>
                    <td>DATE</td>
                    <td>:</td>
                    <td class="text-right">{{date('d M y', strtotime($date))}}</td>
                </tr>
                <tr>
                    <td>ETD</td>
                    <td>:</td>
                    <td class="text-right">{{date('d M y', strtotime($etd))}}</td>
                </tr>
                <tr>
                    <td>ETA</td>
                    <td>:</td>
                    <td class="text-right">{{date('d M y', strtotime($eta))}}</td>
                </tr>
                @foreach($document as $doc)
                <tr>
                    <td>{{$doc['name']}}</td>
                    <td>:</td>
                    <td class="text-right">{{$doc['pivot']['no_reference']}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <hr class="hide-ref" title="Hide Reference">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-2" role="tablist">
            <li role="presentation" class="active">
                <a href="#charges{{ $id }}" aria-controls="charges" role="tab" data-toggle="tab">DETAIL OF CHARGES</a>
            </li>
            <li role="presentation">
                <a href="#reimburse{{ $id }}" aria-controls="reimburse" role="tab" data-toggle="tab">REIMBURSEMENT</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content tab-content-2">
            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="charges{{ $id }}">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped invoice-table no-margin">
                        <thead>
                            <tr>
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
                                <td class="text-center" width="10%">USD</td>
                                <td class="text-center" width="10%">IDR</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receivable as $receive)
                            <tr>
                                <td>
                                @if($receive['detail']==1) {{$receive['charge']['name']}} CHARGES @endif
                                @if($receive['detail']==2) FREIGHT CHARGES ({{$receive['charge']['name']}}) @endif
                                @if($receive['detail']==3) {{$receive['charge']['name']}} (FREIGHT CHARGES COLLECT) @endif
                                </td>
                                <td>{{$receive['bill_to']['name']}}</td>
                                <td>{{$receive['term']['name']}}</td>
                                <td>{{$receive['qty']}}</td>
                                <td>{{$receive['unit']['name']}}</td>
                                <td>@if($receive['tax'] == 1) PPN 1 @elseif($receive['tax'] == 2) PPN 2 @else NON PPN @endif</td>
                                <td>@if($receive['currency'] == 1) IDR @else USD @endif</td>
                                <td class="text-right number">{{$receive['price']}}</td>
                                <td class="text-right number usd">@if($receive['currency']==2) {{$receive['price']*$receive['qty']}} @endif</td>
                                <td class="text-right number idr">@if($receive['currency']==1) {{$receive['price']*$receive['qty']}} @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom" id="reimburse{{ $id }}">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed charge-table no-margin">
                        <thead>
                            <tr>
                                <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                                <td class="valign-middle text-center" rowspan="2">BILL TO</td>
                                <td class="valign-middle text-center" rowspan="2">TERMS</td>
                                <td class="valign-middle text-center" rowspan="2">QTY X UNIT</td>
                                <td class="valign-middle text-center" rowspan="2">CURR</td>
                                <td class="valign-middle text-center" rowspan="2">AMOUNT</td>
                                <td class="text-center" colspan="2">TOTAL</td>
                            </tr>
                            <tr>
                                <td class="text-center" width="8%">USD</td>
                                <td class="text-center" width="8%">IDR</td>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($reimbursement as $reimburst)
                            <tr>
                                <td>B. PENGGANTIAN {{$reimburst['charge']['name']}}</td>
                                <td>{{$reimburst['bill_to']['name']}}</td>
                                <td>{{$reimburst['term']['name']}}</td>
                                <td>{{$reimburst['qty']}} x {{$reimburst['unit']['name']}}</td>
                                <td>@if($reimburst['currency'] == 1) IDR @else USD @endif</td>
                                <td class="text-right number">{{$reimburst['price']}}</td>
                                <td class="text-right number rmb-usd">@if($reimburst['currency']==2) {{$reimburst['price']*$reimburst['qty']}} @endif</td>
                                <td class="text-right number rmb-idr">@if($reimburst['currency']==1) {{$reimburst['price']*$reimburst['qty']}} @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-right">
        <button type="button" class="btn btn-danger" data-toggle="modal" href='#modal-decline'>Decline</button>
    </div>
</form>
<script>
    var id = "{{$id}}";
    $("#id_job_rev").val(id);
</script>