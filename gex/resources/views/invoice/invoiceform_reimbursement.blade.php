<form action="" method="POST" class="form-horizontal" role="form">
    <div class="row">
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
                    <td>{{$customer[0]['name']}}</td>
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
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-condensed table-striped invoice-table no-margin">
                <thead>
                    <tr>
                        <td class="valign-middle text-center" rowspan="2">-</td>
                        <td class="valign-middle text-center" rowspan="2">CHARGES</td>
                        <td class="valign-middle text-center" rowspan="2">CUSTOMER</td>
                        <td class="valign-middle text-center" rowspan="2">TERMS</td>
                        <td class="valign-middle text-center" rowspan="2">QTY</td>
                        <td class="valign-middle text-center" rowspan="2">UNIT</td>
                        <td class="valign-middle text-center" rowspan="2">CURRENCY</td>
                        <td class="valign-middle text-center" rowspan="2">AMOUNT</td>
                        <td class="text-center" colspan="2">TOTAL</td>
                    </tr>
                    <tr>
                        <td class="text-center" width="8%">USD</td>
                        <td class="text-center" width="8%">IDR</td>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" class="hidden-id-rmb">
                    @foreach($reimbursement as $rmb => $value)
                        <tr>
                            <td><label class="fancy-checkbox"><input class="check-req" type="checkbox" value="{{$value['id']}}"><span></span></label></td>
                            {{-- <td>1</td> Nomer Bingung--}} 
                            <td>B. PENGGANTIAN {{$value['charge']['name']}}</td>
                            <td>{{$value['bill_to']['name']}}</td>
                            <td>{{$value['term']['name']}}</td>
                            <td>{{$value['qty']}}</td>
                            <td>{{$value['unit']['name']}}</td>
                            <td>@if($value['currency'] == 1) IDR @else USD @endif</td>
                            <td class="text-right number">{{$value['price']}}</td>
                            <td class="text-right number usd">@if($value['currency']==2) {{$value['price']*$value['qty']}} @endif</td>
                            <td class="text-right number idr">@if($value['currency']==1) {{$value['price']*$value['qty']}} @endif</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="text-right">
        {{-- <button type="button" class="btn btn-danger" data-toggle="modal" href='#modal-decline'>Decline</button> --}}
        <button type="button" class="btn btn-primary btn-modal-invoice">Create</button>
    </div>
</form>