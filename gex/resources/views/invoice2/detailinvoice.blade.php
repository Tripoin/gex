@php
    $marketing = App\User::find($jobsheet->marketing_id);
    $bank = App\MasterBank::find($invoice->bank_id);
@endphp

<div class="row">
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>INVOICE</td>
                    <td>:</td>
                    <td>{{ $invoice->code }}</td>
                </tr>
                <tr>
                    <td>MARKETING</td>
                    <td>:</td>
                    <td>{{ $marketing->name }}</td>
                </tr>
                <tr>
                    <td>BANK ACCOUNT</td>
                    <td>:</td>
                    <td>{{ $bank->name }} CAB. {{ $bank->cabang }}</td>
                </tr>
                <tr>
                    <td>E-FAKTUR</td>
                    <td>:</td>
                    <td>{{ $invoice->efaktur or '' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @php
        $customer = App\MasterCustomer::find($receivables->rec_marketing->customer_id);
        $term = App\MasterTerm::find($receivables->rec_marketing->term_id);
    @endphp
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>BILL TO</td>
                    <td>:</td>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <td>TERMS</td>
                    <td>:</td>
                    <td>{{ $term->name }}</td>
                </tr>
                <tr>
                    <td>TAX</td>
                    <td>:</td>
                    <td>
                        @if($receivables->rec_tax == 1)
                            PPN 1
                        @elseif($receivables->rec_tax == 2)
                            PPN 2
                        @else
                            NON PPN
                        @endif
                    </td>
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
                    <td class="text-right">{{date('d F Y', strtotime($invoice->tanggal))}}</td>
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
@php
    $cust = App\MasterCustomer::find($jobsheet->customer_id);
    $poo = App\MasterPort::find($jobsheet->poo_id);
    $pod = App\MasterPort::find($jobsheet->pod_id);
@endphp
<div class="row">
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>CUSTOMER</td>
                    <td>:</td>
                    <td>{{ $cust->name }}</td>
                </tr>
                <tr>
                    <td>ORIGIN</td>
                    <td>:</td>
                    <td>{{ $poo->nick_name }}</td>
                </tr>
                <tr>
                    <td>DESTINATION</td>
                    <td>:</td>
                    <td>{{ $pod->nick_name }}</td>
                </tr>
                <tr>
                    <td>FREIGHT TYPE</td>
                    <td>:</td>
                    <td>
                        @if($jobsheet->freight_type==0)
                            PREPAID
                        @else
                            COLLECT
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>DESCRIPTION</td>
                    <td>:</td>
                    <td>{{ $jobsheet->description }}</td>
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
                    <td>{{date('d F Y', strtotime($jobsheet->etd))}}</td>
                </tr>
                <tr>
                    <td>ETA</td>
                    <td>:</td>
                    <td>{{date('d F Y',strtotime($jobsheet->eta))}}</td>
                </tr>
                <tr>
                    <td>PARTY/MEAS</td>
                    <td>:</td>
                    <td>{{ $jobsheet->partymeas }}</td>
                </tr>
                <tr>
                    <td>VESSEL</td>
                    <td>:</td>
                    <td>{{ $jobsheet->vessel }}</td>
                </tr>
                <tr>
                    <td>REMARKS</td>
                    <td>:</td>
                    <td>{{ $jobsheet->remarks }}</td>
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
                    <td class="text-right">{{date('d F Y', strtotime($jobsheet->date))}}</td>
                </tr>
                <tr>
                    <td>JOB</td>
                    <td>:</td>
                    <td class="text-right">{{ $jobsheet->code }}</td>
                </tr>
                @foreach($references as $ref)
                <tr>
                    @php
                        $doc = \App\MasterDocument::find($ref->document_id)
                    @endphp
                    <td>{{ $doc->name }}</td>
                    <td>:</td>
                    <td class="text-right">{{ $ref->ref_no }}</td>
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
                    <td width="2%">NO</td>
                    <td class="text-center">DETAIL OF CHARGES</td>
                    <td class="text-center">QTY x UNIT</td>
                    <td class="text-center">CURR</td>
                    <td class="text-center">PRICE</td>
                    <td class="text-center">TOTAL</td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; $sum = 0; @endphp
                @foreach($charges as $charge)
                    @php
                        $doc = App\MasterDocument::find($charge->rec_document_id);
                        $unit = App\MasterUnit::find($charge->rec_unit_id);
                        $sum += $charge->rec_total;
                    @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $doc->name }}</td>
                    <td class="text-center">{{ $charge->rec_quantity }} x {{ $unit->name }}</td>
                    <td class="text-center">@if($charge->rec_currency == 1) IDR @else USD @endif</td>
                    <td class="text-right">{{ number_format($charge->rec_price) }}</td>
                    <td class="text-right">
                    @if($max == $charge->rec_total)
                        @if($charge->rec_tax == 1)
                            {{ number_format($charge->rec_total - $tot * 1/100) }}
                        @elseif($charge->rec_tax == 2)
                            {{ number_format($charge->rec_total - $tot/1.01 * 1/100) }}
                        @else
                            {{ number_format($charge->rec_total - $tot/1.01 * 1/100) }}
                        @endif
                    @else
                            {{ number_format($charge->rec_total) }}
                    @endif
                    </td>
                </tr>
                @php $no++ @endphp
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2"><strong>NET VALUE</strong></td>
                    <td class="text-right"><strong>
                        @if($receivables->rec_tax == 1)
                            {{ number_format($sum - $sum * 1/100) }}
                        @elseif($receivables->rec_tax == 2)
                            {{ number_format($sum - $sum/1.01 * 1/100) }}
                        @else
                            {{ number_format($sum - $sum/1.01 * 1/100) }}
                        @endif
                    </strong></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2"><strong>VAT</strong></td>
                    <td class="text-right"><strong>
                        @if($receivables->rec_tax == 1)
                            {{ number_format($sum * 1/100) }}
                        @elseif($receivables->rec_tax == 2)
                            {{ number_format($sum/1.01 * 1/100) }}
                        @else
                            {{ number_format($sum/1.01 * 1/100) }}
                        @endif    
                    </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2"><strong>AMMOUNT DUE</strong></td>
                    <td class="text-right"><strong>
                        {{ number_format($sum) }}
                    </strong></td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="text-right">
            @if($invoice->status != 2)
                <button class="btn btn-danger" data-toggle="modal" href="#modal-cancel">Req Cancel</button>
            @endif
            <a class="btn btn-primary" href="{{ route('invoice.printpdf', $invoice->id) }}" target="blank"><i class="fa fa-print fa-fw"></i> PRINT</a>
        </div>
    </div>
</div>
