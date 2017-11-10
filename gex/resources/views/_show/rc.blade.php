<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom" id="tabrc{{ $jobsheet->id }}">

    <table class="table table-bordered table-striped table-condensed charge-table no-margin">
        <thead>
            <tr>
                <td class="valign-middle text-center" rowspan="2">RC TYPE</td>
                <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                <td class="valign-middle text-center" rowspan="2">VENDOR</td>
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
            @foreach($rcs as $rc)
            
                @php
                    $rcdetail = App\MasterDocument::find($rc->rc_document_id);
                    $rcvendor = App\MasterVendor::find($rc->rc_vendor_id);
                    $rcunit = App\MasterUnit::find($rc->rc_unit_id);

                    $usd_idr = $rc->rc_price * $rc->rc_quantity;
                @endphp
                
                <tr>
                    <td>{{ $rc->rc_type }}</td>
                    <td>{{ $rcdetail->name }}</td>
                    <td>{{ $rcvendor->name }}</td>
                    <td>{{ $rc->rc_quantity }}</td>
                    <td>x</td>
                    <td>{{ $rcunit->name or '' }}</td>
                    <td>{{ $rc->rc_currency == 1 ? 'IDR':'USD' }}</td>
                    <td class="text-right number">{{ number_format($rc->rc_price) }}</td>
                    <td class="text-right number rc-usd">
                        {{ $rc->rc_currency==2 ? number_format($usd_idr):'' }}
                    </td>
                    <td class="text-right number rc-idr">
                        {{ $rc->rc_currency==1 ? number_format($usd_idr):'' }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="7" class="text-center">TOTAL</td>
                <td class="text-right "><strong>{{ number_format($rc_total_price) }}</strong></td>
                <td class="text-right ">
                    <strong>
                        @if(count($rcs)>0)
                            {{ number_format(collect($rc_total_price_usd)->sum('rc_total')) }}
                        @endif
                    </strong>
                </td>
                <td class="text-right ">
                    <strong>
                        @if(count($rcs)>0)
                            {{ number_format(collect($rc_total_price_idr)->sum('rc_total')) }}
                        @endif
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>

</div>