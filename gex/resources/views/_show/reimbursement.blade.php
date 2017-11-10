<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom" id="tabreimburse{{ $jobsheet->id }}">

@if(Auth::user()->role == 'marketing' || Auth::user()->role == 'admin')
    <table class="table table-bordered table-striped table-condensed charge-table no-margin">
        <thead>
            <tr>
                <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                <td class="valign-middle text-center" rowspan="2">BILL TO</td>
                <td class="valign-middle text-center" rowspan="2">TERMS</td>
                <td class="valign-middle text-center" rowspan="2">QTY</td>
                <td class="valign-middle text-center" rowspan="2">x</td>
                <td class="valign-middle text-center" rowspan="2">UNIT</td>
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
            @foreach($reimbursements as $rmb)
                <tr>
                    @php
                        $detail = App\MasterDocument::find($rmb->rmb_document_id);
                        $rmbbill = App\MasterCustomer::find($rmb->rmb_marketing->customer_id);
                        $rmbterm = App\MasterTerm::find($rmb->rmb_marketing->term_id);
                        $rmbunit = App\MasterUnit::find($rmb->rmb_unit_id);
                    @endphp
                    <td>B. PENGGANTIAN {{ $detail->name }}</td>
                    <td>{{ $rmbbill->name }}</td>
                    <td>{{ $rmbterm->name }}</td>
                    <td>{{ $rmb->rmb_quantity }}</td>
                    <td>x</td>
                    <td>{{ $rmbunit->name or ''}}</td>
                    <td>
                        @if($rmb->rmb_currency == 1)
                            IDR
                        @else
                            USD
                        @endif</td>
                    <td class="text-right number">{{ number_format($rmb->rmb_price) }}</td>
                    <td class="text-right number rmb-usd">
                        @if($rmb->rmb_currency==2)
                            @php
                                $rmbusd = $rmb->rmb_price * $rmb->rmb_quantity;
                            @endphp
                            {{ number_format($rmbusd) }}
                        @endif
                    </td>
                    <td class="text-right number rmb-idr">
                        @if($rmb->rmb_currency==1)
                            @php
                                $rmbidr = $rmb->rmb_price * $rmb->rmb_quantity;
                            @endphp
                            {{ number_format($rmbidr) }}
                        @endif
                    </td>
                </tr>
            @endforeach
            
            <tr>
                <td colspan="7" class="text-center">TOTAL</td>
                <td class="text-right "><strong>{{ number_format($rmb_total_price) }}</strong></td>
                <td class="text-right ">
                    <strong>
                        @if(count($reimbursements)>0)
                            {{ number_format(collect($rmb_total_price_usd)->sum('rmb_total')) }}    
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($reimbursements)>0)
                            {{ number_format(collect($rmb_total_price_idr)->sum('rmb_total')) }}
                        @endif
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
@elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'admin')
    <table class="table table-bordered table-striped table-condensed charge-table no-margin">
        <thead>
            <tr>
                <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                <td class="valign-middle text-center" rowspan="2">TERMS</td>
                <td class="valign-middle text-center" rowspan="2">QTY</td>
                <td class="valign-middle text-center" rowspan="2">x</td>
                <td class="valign-middle text-center" rowspan="2">UNIT</td>
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
            @foreach($reimbursements as $rmb)
                <tr>
                    @php
                        $detail = App\MasterDocument::find($rmb->rmb_document_id);
                        $rmbvend = App\MasterVendor::find($rmb->rmb_vendor_id);
                        $rmbterm = App\MasterTerm::find($rmb->rmb_marketing->term_id);
                        $rmbunit = App\MasterUnit::find($rmb->rmb_unit_id);
                    @endphp
                    <td>B. PENGGANTIAN {{ $detail->name }}</td>
                    <td>{{ $rmbvend->name }}</td>
                    <td>{{ $rmbterm->name }}</td>
                    <td>{{ $rmb->rmb_quantity }}</td>
                    <td>x</td>
                    <td>{{ $rmbunit->name or ''}}</td>
                    <td>
                        @if($rmb->rmb_currency == 1)
                            IDR
                        @else
                            USD
                        @endif</td>
                    <td class="text-right number">{{ number_format($rmb->rmb_price) }}</td>
                    <td class="text-right number rmb-usd">
                        @if($rmb->rmb_currency==2)
                            @php
                                $rmbusd = $rmb->rmb_price * $rmb->rmb_quantity;
                            @endphp
                            {{ number_format($rmbusd) }}
                        @endif
                    </td>
                    <td class="text-right number rmb-idr">
                        @if($rmb->rmb_currency==1)
                            @php
                                $rmbidr = $rmb->rmb_price * $rmb->rmb_quantity;
                            @endphp
                            {{ number_format($rmbidr) }}
                        @endif
                    </td>
                </tr>
            @endforeach
            
            <tr>
                <td colspan="7" class="text-center">TOTAL</td>
                <td class="text-right "><strong>{{ number_format($rmb_total_price) }}</strong></td>
                <td class="text-right ">
                    <strong>
                        @if(count($reimbursements)>0)
                            {{ number_format(collect($rmb_total_price_usd)->sum('rmb_total')) }}    
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($reimbursements)>0)
                            {{ number_format(collect($rmb_total_price_idr)->sum('rmb_total')) }}
                        @endif
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
@elseif(Auth::user()->role == 'payable' || Auth::user()->role == 'admin')
    <table class="table table-bordered table-striped table-condensed charge-table no-margin">
        <thead>
            <tr>
                <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                <td class="valign-middle text-center" rowspan="2">TERMS</td>
                <td class="valign-middle text-center" rowspan="2">QTY</td>
                <td class="valign-middle text-center" rowspan="2">x</td>
                <td class="valign-middle text-center" rowspan="2">UNIT</td>
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
            @foreach($reimbursements as $rmb)
                <tr>
                    @php
                        $detail = App\MasterDocument::find($rmb->rmb_document_id);
                        $rmbvend = App\MasterVendor::find($rmb->rmb_vendor_id);
                        $rmbterm = App\MasterTerm::find($rmb->rmb_marketing->term_id);
                        $rmbunit = App\MasterUnit::find($rmb->rmb_unit_id);
                    @endphp
                    <td>B. PENGGANTIAN {{ $detail->name }}</td>
                    <td>{{ $rmbvend->name }}</td>
                    <td>{{ $rmbterm->name }}</td>
                    <td>{{ $rmb->rmb_quantity }}</td>
                    <td>x</td>
                    <td>{{ $rmbunit->name or ''}}</td>
                    <td>
                        @if($rmb->rmb_currency == 1)
                            IDR
                        @else
                            USD
                        @endif</td>
                    <td class="text-right number">{{ number_format($rmb->rmb_price) }}</td>
                    <td class="text-right number rmb-usd">
                        @if($rmb->rmb_currency==2)
                            @php
                                $rmbusd = $rmb->rmb_price * $rmb->rmb_quantity;
                            @endphp
                            {{ number_format($rmbusd) }}
                        @endif
                    </td>
                    <td class="text-right number rmb-idr">
                        @if($rmb->rmb_currency==1)
                            @php
                                $rmbidr = $rmb->rmb_price * $rmb->rmb_quantity;
                            @endphp
                            {{ number_format($rmbidr) }}
                        @endif
                    </td>
                </tr>
            @endforeach
            
            <tr>
                <td colspan="7" class="text-center">TOTAL</td>
                <td class="text-right "><strong>{{ number_format($rmb_total_price) }}</strong></td>
                <td class="text-right ">
                    <strong>
                        @if(count($reimbursements)>0)
                            {{ number_format(collect($rmb_total_price_usd)->sum('rmb_total')) }}    
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($reimbursements)>0)
                            {{ number_format(collect($rmb_total_price_idr)->sum('rmb_total')) }}
                        @endif
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
@endif
</div>