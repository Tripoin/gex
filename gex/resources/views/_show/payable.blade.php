<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">

    @if(Auth::user()->role == 'operation' || Auth::user()->role == 'admin')
        <div class="table-responsive">
            <table class="table table-bordered table-body-condensed table-striped no-margin">
                <thead>
                    <tr>
                        <td class="valign-middle text-center" rowspan="2">NO</td>
                        <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                        <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                        <td class="valign-middle text-center" rowspan="2">QTY</td>
                        <td rowspan="2" width="1%"></td>
                        <td class="valign-middle text-center" rowspan="2">UNIT</td>
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

                @if(count($payables) > 0)

                    <?php $i = 1; ?>
                    @foreach($payables as $payable)

                        @php
                            $document = \App\MasterDocument::find($payable->document_id);
                            $vendor = \App\MasterVendor::find($payable->vendor_id);
                            $unit = \App\MasterUnit::find($payable->unit_id);
                            $user = Auth::user();
                        @endphp

                        @if($payable->user_id == $user->id)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $document->name }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $payable->quantity }}</td>
                                <td>x</td>
                                <td>{{ $unit->name or '' }}</td>
                                <td>USD</td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                            </tr>
                        @endif
                        <?php $i++; ?>

                    @endforeach

                @else
                    <tr>
                        <td class="text-center" colspan="10">This job doesn't have detail of charges</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    @elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'admin')
        <div class="table-responsive">
            <table class="table table-bordered table-body-condensed table-striped no-margin">
                <thead>
                    <tr>
                        <td class="valign-middle text-center" rowspan="2">NO</td>
                        <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                        <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                        <td class="valign-middle text-center" rowspan="2">QTY</td>
                        <td rowspan="2" width="1%"></td>
                        <td class="valign-middle text-center" rowspan="2">UNIT</td>
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
                @if(count($payables) > 0)

                    <?php $i = 1; ?>
                    @foreach($payables as $payable)

                        @php
                            $document = \App\MasterDocument::find($payable->document_id);
                            $vendor = \App\MasterVendor::find($payable->vendor_id);
                            $unit = \App\MasterUnit::find($payable->unit_id);
                            $user = Auth::user();
                        @endphp

                        @if($payable->user->role != 'payable')
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $document->name }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $payable->quantity }}</td>
                                <td>x</td>
                                <td>{{ $unit->name or '' }}</td>
                                <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                <td class="text-right">{{ number_format((double)$payable->price) }}</td>
                                <td class="text-right">
                                    @if($payable->currency == 2)
                                        {{ number_format((double)$payable->quantity * $payable->price) }}
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($payable->currency == 1)
                                        {{ number_format((double)$payable->quantity * $payable->price) }}
                                    @endif
                                </td>
                            </tr>
                        @endif

                        <?php $i++; ?>
                    @endforeach

                    <tr>
                        <td colspan="7" class="text-center">TOTAL</td>
                        <td class="text-right "><strong>{{ number_format($pay_total_price) }}</strong></td>
                        <td class="text-right ">
                            <strong>
                                @if(count($rcs)>0)
                                    {{ number_format(collect($pay_total_price_usd)->sum('total')) }}
                                @endif
                            </strong>
                        </td>
                        <td class="text-right ">
                            <strong>
                                @if(count($rcs)>0)
                                    {{ number_format(collect($pay_total_price_idr)->sum('total')) }}
                                @endif
                            </strong>
                        </td>
                    </tr>

                @else
                    <tr>
                        <td class="text-center" colspan="6">This job doesn't have detail of charges</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    @elseif(Auth::user()->role == 'payable' || Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
        <div class="table-responsive">
            <table class="table table-bordered table-body-condensed table-striped no-margin">
                <thead>
                    <tr>
                        <td class="valign-middle text-center" rowspan="2">NO</td>
                        <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                        <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                        <td class="valign-middle text-center" rowspan="2">QTY</td>
                        <td rowspan="2" width="1%"></td>
                        <td class="valign-middle text-center" rowspan="2">UNIT</td>
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

                @if(count($payables) > 0)

                    <?php $i = 1; ?>
                    @foreach($payables as $payable)

                        @php
                            $document = \App\MasterDocument::find($payable->document_id);
                            $vendor = \App\MasterVendor::find($payable->vendor_id);
                            $unit = \App\MasterUnit::find($payable->unit_id);
                            $user = Auth::user();
                        @endphp

                        @if($user->role == 'operation')
                            @if($payable->user_id == $user->id)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $payable->quantity }}</td>
                                    <td>x</td>
                                    <td>{{ $unit->name or '' }}</td>
                                    <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                    <td class="text-right">{{ number_format((double)$payable->price) }}</td>
                                    <td class="text-right">
                                        @if($payable->currency == 2)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($payable->currency == 1)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $payable->quantity }}</td>
                                    <td>x</td>
                                    <td>{{ $unit->name or '' }}</td>
                                    <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                    <td class="text-right">{{ number_format((double)$payable->price) }}</td>
                                    <td class="text-right">
                                        @if($payable->currency == 2)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($payable->currency == 1)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @elseif($user->role == 'pricing')
                            @if($payable->user->role != 'payable')
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $payable->quantity }}</td>
                                    <td>x</td>
                                    <td>{{ $unit->name or '' }}</td>
                                    <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                    <td class="text-right">{{ number_format((double)$payable->price) }}</td>
                                    <td class="text-right">
                                        @if($payable->currency == 2)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($payable->currency == 1)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                </tr>
                            @elseif($payable->user_id == $user->id)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $payable->quantity }}</td>
                                    <td>x</td>
                                    <td>{{ $unit->name or '' }}</td>
                                    <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                    <td class="text-right">{{ number_format((double)$payable->price) }}</td>
                                    <td class="text-right">
                                        @if($payable->currency == 2)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($payable->currency == 1)
                                            {{ number_format((double)$payable->quantity * $payable->price) }}
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @elseif($user->role = 'payable' || $user->role = 'manager')
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $document->name }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $payable->quantity }}</td>
                                <td>x</td>
                                <td>{{ $unit->name or '' }}</td>
                                <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                <td class="text-right">{{ number_format((double)$payable->price) }}</td>
                                <td class="text-right">
                                    @if($payable->currency == 2)
                                        {{ number_format((double)$payable->quantity * $payable->price) }}
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($payable->currency == 1)
                                        {{ number_format((double)$payable->quantity * $payable->price) }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <?php $i++; ?>
                    @endforeach


                @else
                    <tr>
                        <td class="text-center" colspan="6">This job doesn't have detail of charges</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    @endif

</div>
