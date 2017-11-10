<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Reimbursement</title>
    <style>
     body {
        font-family: "Calibri";
        width: 100%;
        height: 100%;
        margin: 0;
        padding: -30px;
        color: black !important;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;     
        }
        .page {
            
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    table{
      border-collapse: collapse;
    }
    .table-charge td{
      padding: 3px 0;
    }
    .center {
        text-align: center;
    }
    .right {
        text-align: right;
    }
    hr {
        border: .3px solid #000000;
        margin: 0px;
    } 
    .long {
        width:100%;
        font: 7pt "calibri" !important;
    }

    .reimbursement {
        font-size: 32pt;
        text-align: center;
        font-weight: bold;
        padding-top: -20px;
        padding-bottom: 20px;
    }
    .font {
        font-size: 12pt;
        text-align: center;
    }
    .font2 {
        font-size: 8pt;
        font-weight: 600;
    }
    .font3 {
        font-size: 10pt;
        text-align: center;
    }
    .font4 {
        font-size: 8pt;
        text-align: center;
    }
    .remarks {
        font-size: 8pt;
    }
    .list {
        font-size: 8pt;
        padding: 0;
    }
    </style>
</head>
<body>
<br><br>
    <div class="page">
    <div class="reimbursement"><img src="img/gex3.png" alt=""></div>
    <div class="calibri font3">PT. GLOBALINDO EXPRESS CARGO</div>
    <div class="calibri font3">EXPORT INVOICE : {{ $invoice->code }}</div>
    <hr>
    @php
        $job = App\Jobsheet::find($invoice->jobsheet_id);
        $poo = App\MasterPort::find($job->poo_id);
        $pod = App\MasterPort::find($job->pod_id);

        $document = App\InvoiceDocument::where('invoice_id',$invoice->id)->get();

        $customer = App\MasterCustomer::find($invoice->customer_id);
        
        $rece = App\Reimbursement::where('rmb_invoice_id',$invoice->id)->first();
        $term = App\MasterTerm::find($rece->rmb_marketing->term_id);

        $bank = App\MasterBank::find($invoice->bank_id);
    @endphp
        <table class="calibri long">
          <tr>
            <td width="23%">CUSTOMER</td>
            <td width="2%">:</td>
            <td width="25%">{{ strtoupper($customer->name) }}</td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="23%">DATE</td>
            <td width="2%">:</td>
            <td width="25%" style="text-align: right;">{{strtoupper(date('d F Y', strtotime($invoice->tanggal)))}}</td>
          </tr>
          <tr>
            <td width="23%"></td>
            <td width="2%"></td>
            <td colspan="2" width="50%">{{strtoupper($customer->address1)}}</td>
            
            <td width="25%"></td>
            <td width="23%">TERMS</td>
            <td width="2%">:</td>
            <td width="25%" style="text-align: right;">{{ strtoupper($term->name) }}</td>
          </tr>
          {{--  <tr>
            <td width="23%"></td>
            <td width="2%"></td>
            <td colspan="2" width="50%">CIREBON</td>
            
            <td width="25%"></td>
            <td width="23%"></td>
            <td width="2%"></td>
            <td width="25%"></td>
          </tr>
          <tr>
            <td width="23%"></td>
            <td width="2%"></td>
            <td colspan="2" width="50%">JAWA BARAT - INDONESIA</td>
            
            <td width="25%"></td>
            <td width="23%"></td>
            <td width="2%"></td>
            <td width="25%"></td>
          </tr>  --}}
        </table> 
    <br>
    <div class="calibri font2">REFERENCE</div>
    <hr>
        <table class="long">
          <tr>
            <td width="23%">ORIGIN</td>
            <td width="2%">:</td>
            <td width="25%">{{ strtoupper($poo->city) }}, {{strtoupper($poo->country)}}</td>
            <td width="25%">ETD</td>
            <td width="25%">: {{strtoupper(date('d F Y', strtotime($job->etd)))}}</td>
            <td width="23%">JOB</td>
            <td width="2%">:</td>
            <td width="25%" style="text-align: right;">{{ $job->code }}</td>
          </tr>
          <tr>
            <td>DESTINATION</td>
            <td>:</td>
            <td>{{ strtoupper($pod->city) }}, {{strtoupper($pod->country)}}</td>
            <td>ETA</td>
            <td>: {{strtoupper(date('d F Y', strtotime($job->eta)))}}</td>
            @if(count($document) > 0)
            <td>{{strtoupper($document[0]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[0]['no_ref']}}</td>
            @endif
          </tr>
          <tr>
            <td>DESCRIPTIONS</td>
            <td>:</td>
            <td>{{strtoupper($job->description)}}</td>
            <td>VESSEL</td>
            <td>: {{strtoupper($job->vessel)}}</td>
            @if(count($document) > 1)
            <td>{{strtoupper($document[1]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[1]['no_ref']}}</td>
            @endif
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @if(count($document) > 2)
            <td>{{strtoupper($document[2]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[2]['no_ref']}}</td>
            @endif
          </tr>
          @if(count($document) > 3)
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{strtoupper($document[3]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[3]['no_ref']}}</td>
          </tr>
          @endif
          @if(count($document) > 4)
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{strtoupper($document[4]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[4]['no_ref']}}</td>
          </tr>
          @endif
          @if(count($document) > 5)
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{strtoupper($document[5]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[5]['no_ref']}}</td>
          </tr>
          @endif
          @if(count($document) > 6)
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{strtoupper($document[6]['name'])}}</td>
            <td>:</td>
            <td  style="text-align: right;">{{$document[6]['no_ref']}}</td>
          </tr>
          @endif
        </table>
    <br>
    <hr>
        <table class="long table-charge">
          <tr>
            <td width="30%">DETAIL OF CHARGES</td>
            <td width="4%">QTY</td>
            <td width="2%"></td>
            <td width="9%">UNIT</td>
            <td width="10%" class="center">Price (USD)</td>
            <td width="10%" class="center">Price (IDR)</td>
            <td width="5%"></td>
            <td width="10%" class="center">Total (USD)</td>
            <td width="10%" style="text-align: right;">Total (IDR)</td>
          </tr>
          <hr>
        </table> 
        <table class="long table-charge">
        @php $sum = 0; @endphp
        @foreach($receivable as $rec)
            @php
                $doc = App\MasterDocument::find($rec['rmb_document_id']);
                $unit = App\MasterUnit::find($rec['rmb_unit_id']);
                $sum += $rec['rmb_total'];
            @endphp
          <tr>
            <td width="30%">{{ $doc->name }}</td>
            <td width="4%">{{ $rec['rmb_quantity'] }}</td>
            <td width="2%">
                @if($unit->name != "SET" && $unit->name != "UNIT" && $unit->name != "TRIP")
                    X
                @else
                @endif
            </td>
            <td width="9%">{{ strtoupper($unit->name) }}</td>
            <td width="10%" class="center">
                @if($rec['rmb_currency'] == 2)
                    {{ number_format($rec['rmb_price'],2) }}
                @endif
            </td>
            <td width="10%" class="center">
                @if($rec['rmb_currency'] == 1)
                    {{ number_format($rec['rmb_price'],2) }}
                @endif
            </td>
            <td width="5%"></td>
            <td width="10%" class="center">
                @if($rec['rmb_currency'] == 2)
                    @if($max == $rec['rmb_total'])
                        @if($rec['rmb_tax'] == 1)
                            {{ number_format($rec['rmb_total'],2) }}
                        @elseif($rec['rmb_tax'] == 2)
                            {{ number_format($rec['rmb_total'] - $tot/1.01 * 1/100,2) }}
                        @else
                            {{ number_format($rec['rmb_total'] - $tot/1.01 * 1/100,2) }}
                        @endif
                    @else
                        {{ number_format($rec['rmb_total'],2) }}
                    @endif
                @endif
            </td>
            <td width="10%" class="right">
                @if($rec['rmb_currency'] == 1)
                    @if($max == $rec['rmb_total'])
                        @if($rec['rmb_tax'] == 1)
                            {{ number_format($rec['rmb_total'],2) }}
                        @elseif($rec['rmb_tax'] == 2)
                            {{ number_format($rec['rmb_total'] - $tot/1.01 * 1/100,2) }}
                        @else
                            {{ number_format($rec['rmb_total'] - $tot/1.01 * 1/100,2) }}
                        @endif
                    @else
                        {{ number_format($rec['rmb_total'],2) }}
                    @endif
                @endif
            </td>
          </tr>
        @endforeach

        <tr class="font2">
            <td width="30%" style="border-top : 1px solid black !important;">NET VALUE</td>
            <td width="4%" style="border-top : 1px solid black !important;"></td>
            <td width="2%" style="border-top : 1px solid black !important;"></td>
            <td width="9%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" style="border-top : 1px solid black !important;"></td>
            <td width="5%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" class="center" style="border-top : 1px solid black !important;">
                @if($rec['rmb_currency'] == 2)
                    @if($rec['rmb_tax'] == 1)
                        {{ number_format($sum,2) }}
                    @elseif($rec['rmb_tax'] == 2)
                        {{ number_format($sum - $sum/1.01 * 1/100,2) }}
                    @else
                        {{ number_format($sum - $sum/1.01 * 1/100,2) }}
                    @endif
                @endif
            </td>
            <td width="10%" class="right" style="border-top : 1px solid black !important;">
                @if($rec['rmb_currency'] == 1)
                    @if($rec['rmb_tax'] == 1)
                        {{ number_format($sum,2) }}
                    @elseif($rec['rmb_tax'] == 2)
                        {{ number_format($sum - $sum/1.01 * 1/100,2) }}
                    @else
                        {{ number_format($sum - $sum/1.01 * 1/100,2) }}
                    @endif
                @endif
            </td>
          </tr>

          @if($rec['rmb_tax'] != 3)
          <tr class="font2">
            <td width="30%" style="border-top : 1px solid black !important;">VAT</td>
            <td width="4%" style="border-top : 1px solid black !important;"></td>
            <td width="2%" style="border-top : 1px solid black !important;"></td>
            <td width="9%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" style="border-top : 1px solid black !important;"></td>
            <td width="5%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" class="center" style="border-top : 1px solid black !important;">
                @if($rec['rmb_currency'] == 2)
                    @if($rec['rmb_tax'] == 1)
                        {{ number_format($sum * 1/100,2) }}
                    @elseif($rec['rmb_tax'] == 2)
                        {{ number_format($sum/1.01 * 1/100,2) }}
                    @else
                        {{ number_format($sum/1.01 * 1/100,2) }}
                    @endif
                @endif
            </td>
            <td width="10%" class="right" style="border-top : 1px solid black !important;">
                @if($rec['rmb_currency'] == 1)
                    @if($rec['rmb_tax'] == 1)
                        {{ number_format($sum * 1/100,2) }}
                    @elseif($rec['rmb_tax'] == 2)
                        {{ number_format($sum/1.01 * 1/100,2) }}
                    @else
                        {{ number_format($sum/1.01 * 1/100,2) }}
                    @endif
                @endif
            </td>
          </tr>
          @endif

          <tr class="font2">
            <td width="30%" style="border-top : 1px solid black !important;">AMOUNT DUE</td>
            <td width="4%" style="border-top : 1px solid black !important;"></td>
            <td width="2%" style="border-top : 1px solid black !important;"></td>
            <td width="9%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" style="border-top : 1px solid black !important;"></td>
            <td width="5%" style="border-top : 1px solid black !important;"></td>
            <td width="10%" class="center" style="border-top : 1px solid black !important;">
                @if($rec['rmb_currency'] == 2)
                    @if($rec['rmb_tax'] == 1)
                        {{ number_format($sum + $sum * 1/100) }}
                    @else
                        {{ number_format($sum) }}
                    @endif
                @endif
            </td>
            <td width="10%" class="right" style="border-top : 1px solid black !important;">
                @if($rec['rmb_currency'] == 1)
                    @if($rec['rmb_tax'] == 1)
                        {{ number_format($sum + $sum * 1/100,2) }}
                    @else
                        {{ number_format($sum,2) }}
                    @endif
                @endif
            </td>
          </tr>
          
        </table>
         
        
          <br><br><br><br> <br><br> <br><br> <br><br> <br><br> <br><br> 
          <br><br> <br><br> <br><br><br>
        <div class="remarks">REMARKS <br> {{ strtoupper($job->remarks) }}</div>
        <br>
        <div class="list">- PLEASE CHECK ALL THE DETAILS STATED ON INVOICE</div>
        <div class="list">- INVOICE CANNOT CHANGE AFTER 2 DAYS INVOICE RECEIVED</div>
        <div class="list">- PAYMENT MUST BE RECEIVED IN FULL AMOUNT</div>  
        <div class="list"></div>      
        <br>
        <div class="list">BANK NAME : {{ $bank->name }} {{ $bank->cabang }}</div>
        <div class="list">BA/C : 244 3023 500</div>
        <div class="list">A/N : {{ $bank->account }}</div>
        <div class="list">SWIFT CODE {{ $bank->swiftcode }}</div>
        <hr>
        <div class="font4">PT. GLOBALINDO EXPRESS CARGO</div>
        <div class="font4">JALAN PANGERAN JAYAKARTA NO. 8, KOMPLEK ARTHA
        CENTER E17 - 18, JAKARTA BARAT 11110 - INDONESIA</div>
        <div class="font4">TEL +62.21.6591218 ACT1@GEXINDO.COM</div>
    </div>
</div>
</body>
</html>