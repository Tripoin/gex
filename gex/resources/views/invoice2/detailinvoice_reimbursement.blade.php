<div class="row">
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>INVOICE</td>
                    <td>:</td>
                    <td>{{$code}}</td>
                </tr>
                <tr>
                    <td>MARKETING</td>
                    <td>:</td>
                    <td>{{$job_sheet['marketing']['name']}}</td>
                </tr>
                <tr>
                    <td>BANK ACCOUNT</td>
                    <td>:</td>
                    <td>{{$account_bank['bank']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>BILL TO</td>
                    <td>:</td>
                    <td>{{$bill_to_name}}</td>
                </tr>
                <tr>
                    <td>TERMS</td>
                    <td>:</td>
                    <td>{{$reimbursement[0]['term']['name']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>INVOICE DATE</td>
                    <td>:</td>
                    <td class="text-right">{{date('Y M d', strtotime($date))}}</td>
                </tr>
                <tr>
                    <td>RECEIVED DATE</td>
                    <td>:</td>
                    <td class="text-right">-</td>
                </tr>
                <tr>
                    <td>DUE DATE</td>
                    <td>:</td>
                    <td class="text-right">-</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>CUSTOMER</td>
                    <td>:</td>
                    <td>{{$customer_name}}</td>
                </tr>
                <tr>
                    <td>ORIGIN</td>
                    <td>:</td>
                    <td>{{$job_sheet['poo']['city']}}</td>
                </tr>
                <tr>
                    <td>DESTINATION</td>
                    <td>:</td>
                    <td>{{$job_sheet['pod']['city']}}</td>
                </tr>
                <tr>
                    <td>FREIGHT TYPE</td>
                    <td>:</td>
                    <td>{{$job_sheet['freight_type']}}</td>
                </tr>
                <tr>
                    <td>DESCRIPTION</td>
                    <td>:</td>
                    <td>{{$job_sheet['description']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>ETD</td>
                    <td>:</td>
                    <td>{{date('Y M d', strtotime($job_sheet['etd']))}}</td>
                </tr>
                <tr>
                    <td>ETA</td>
                    <td>:</td>
                    <td>{{date('Y M d',strtotime($job_sheet['eta']))}}</td>
                </tr>
                <tr>
                    <td>PARTY/MEAS</td>
                    <td>:</td>
                    <td>{{$job_sheet['partymeas']}}</td>
                </tr>
                <tr>
                    <td>VESSEL</td>
                    <td>:</td>
                    <td>{{$job_sheet['vessel']}}</td>
                </tr>
                <tr>
                    <td>REMARKS</td>
                    <td>:</td>
                    <td>{{$job_sheet['remarks']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>JOB DATE</td>
                    <td>:</td>
                    <td class="text-right">{{$job_sheet['date']}}</td>
                </tr>
                <tr>
                    <td>JOB</td>
                    <td>:</td>
                    <td class="text-right">{{$job_sheet['code']}}</td>
                </tr>
                @foreach($document as $doc)
                <tr>
                    <td>{{$doc['document_name']}}</td>
                    <td>:</td>
                    <td class="text-right">{{$doc['document_no_reference']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-body-condensed table-striped no-margin">
            <thead>
                <tr>
                    <td width="2%">#</td>
                    <td class="text-center">DETAIL OF CHARGES</td>
                    <td class="text-center">QTY x UNIT</td>
                    <td class="text-center">CURR</td>
                    <td class="text-center">PRICE</td>
                    <td class="text-center">TOTAL</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 0;
                @endphp
                @foreach($reimbursement as $receiv => $r)
                <tr>
                    <td>{{$receiv+1}}</td>
                    <td>{{$r['charge']['name']}}</td>
                    <td class="text-center">{{$r['qty']}} x {{$r['unit']['display']}}</td>
                    <td class="text-center">@if($r['currency'] == 1) IDR @else USD @endif</td>
                    <td class="text-right">{{number_format($r['price'],2)}}</td>
                    <td class="text-right">{{number_format($r['price']*$r['qty'],2)}}</td>
                </tr>
                @php
                    $number = $number + $r['qty']*$r['price'];
                @endphp
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2"><strong>AMMOUNT DUE</strong></td>
                    <td class="text-right">{{number_format(($number),2)}}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="text-right">
            <button class="btn btn-danger" data-toggle="modal" href="#modal-cancel">Req Cancel</button>
            <a class="btn btn-primary" href="/invoice/print/{{$id}}" target="blank"><i class="fa fa-print fa-fw"></i> PRINT</a>
        </div>
    </div>
</div>
