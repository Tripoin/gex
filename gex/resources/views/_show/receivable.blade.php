<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">
    <table class="table table-bordered table-striped table-condensed charge-table no-margin">
        <thead>
            <tr>
                <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                <td class="valign-middle text-center" rowspan="2">BILL TO</td>
                <td class="valign-middle text-center" rowspan="2">TERMS</td>
                <td class="valign-middle text-center" rowspan="2">QTY</td>
                <td class="valign-middle text-center" rowspan="2">x</td>
                <td class="valign-middle text-center" rowspan="2">UNIT</td>
                <td class="valign-middle text-center" rowspan="2">TAX</td>
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
            @foreach($receivables as $receive)
            <tr>
                <td>
                    @if($receive->rec_charge_type==1)
                        {{ $receive->rec_document->name }} CHARGES
                    @elseif($receive->rec_charge_type==2)
                        {{ $receive->rec_document->name }} FREIGHT CHARGES
                    @elseif($receive->rec_charge_type==3)
                        {{ $receive->rec_document->name }} FREIGHT CHARGES COLLECT
                    @endif
                </td>
                @php
                    $bill = App\MasterCustomer::find($receive->rec_marketing->customer_id);
                    $term = App\MasterTerm::find($receive->rec_marketing->term_id);
                    $unit = App\MasterUnit::find($receive->rec_unit_id);
                @endphp
                <td>{{ $bill->name }}</td>
                <td>{{ $term->name }}</td>
                <td>{{ $receive->rec_quantity }}</td>
                <td>x</td>
                <td>{{ $unit->name or ''}}</td>
                <td>
                    @if($receive->rec_tax == 1)
                        PPN 1
                    @elseif($receive->rec_tax == 2)
                        PPN 2
                    @else
                        NON PPN
                    @endif
                </td>
                <td>
                    @if($receive->rec_currency == 1)
                        IDR
                    @elseif($receive->rec_currency == 2)
                        USD
                    @endif
                </td>
                <td class="text-right number">{{ number_format($receive->rec_price) }}</td>
                <td class="text-right number usd">
                    @if($receive->rec_currency==2)
                        {{ number_format($receive->rec_total) }}
                    @endif
                </td>
                <td class="text-right number idr">
                    @if($receive->rec_currency==1)
                        {{ number_format($receive->rec_total) }}
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8" class="text-center">TOTAL PRICE</td>
                <td class="text-right "><strong>{{ number_format($rec_total_price) }}</strong></td>
                <td class="text-right ">
                    <strong>
                        @if(count($receivables)>0)
                            {{ number_format(collect($rec_total_price_usd)->sum('rec_total')) }}
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($receivables)>0)
                            {{ number_format(collect($rec_total_price_idr)->sum('rec_total')) }}
                            @if($receive->rec_currency==1)
                            @endif
                        @endif
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="text-center">TOTAL TAX</td>
                <td class="text-right "></td>
                <td class="text-right ">
                    <strong>
                        @if(count($receivables)>0)
                            {{ number_format($rec_total_tax_usd) }}
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($receivables)>0)
                            {{ number_format($rec_total_tax_idr) }}
                        @endif
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="text-center">GRAND TOTAL</td>
                <td class="text-right "></td>
                <td class="text-right ">
                    <strong>
                        @if(count($receivables)>0)
                            {{ number_format(collect($rec_total_price_usd)->sum('rec_total') + $rec_total_tax_usd) }}
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($receivables)>0)
                            {{ number_format(collect($rec_total_price_idr)->sum('rec_total') + $rec_total_tax_idr) }}
                            @if($receive->rec_currency==1)
                            @endif
                        @endif
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>