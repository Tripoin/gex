<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">
    {!! Form::open(['url' => route('operation.request.store'), 'method' => 'POST','class'=>'form-horizontal']) !!}

    <h3>Request Detail of Charges</h3>

    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table table-bordered table-body-condensed table-striped no-margin">
                <thead>
                <tr>
                    <th class="valign-middle text-center" rowspan="2">
                        <input type="checkbox" name="payable_all_id" value="" class="payable_all_id">
                    </th>
                    <th class="valign-middle text-center" rowspan="2">DATE</th>
                    <td class="valign-middle text-center" rowspan="2">NO</td>
                    <td class="valign-middle text-center" rowspan="2">DETAIL OF CHARGES</td>
                    <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                    <td class="valign-middle text-center" rowspan="2">QTY</td>
                    <td rowspan="2" width="1%"></td>
                    <td class="valign-middle text-center" rowspan="2">UNIT</td>
                    <td class="valign-middle text-center" rowspan="2">CURR</td>
                    <td class="valign-middle text-center" rowspan="2">AMOUNT</td>
                    <td class="text-center" colspan="4">TOTAL</td>
                </tr>
                <tr>
                    <td class="text-center" width="10%">USD</td>
                    <td class="text-center" width="10%">IDR</td>
                </tr>
                </thead>
                <tbody>
                <?php $jobsheetId = ''; ?>
                @if(count($payables) > 0)

                    <?php $i = 1; ?>
                    @foreach($payables as $payable)

                        @php
                        $document = \App\MasterDocument::find($payable->document_id);
                        $vendor = \App\MasterVendor::find($payable->vendor_id);
                        $unit = \App\MasterUnit::find($payable->unit_id);
                        $user = Auth::user();
                        $jobsheetId = $payable->jobsheet_id;
                        @endphp

                        @if($payable->user_id == $user->id)
                            <tr class="<?php
                            echo $requestedPayableIds && in_array($payable->getKey(), $requestedPayableIds) ? "danger" : "";
                            ?>">
                                <td class="text-center">
                                    @if( $requestedPayableIds && in_array($payable->getKey(), $requestedPayableIds)  )
                                        <span class="btn btn-primary">Requested</span>
                                    @else
                                        <input type="checkbox" name="payable_ids[]" value="{!! $payable->getKey() !!}" class='payable_ids'>
                                    @endif
                                </td>
                                <td>
                                    @if( $requestedPayableDates && isset($requestedPayableDates[$payable->getKey()])  )
                                        {!! $requestedPayableDates[$payable->getKey()] !!}
                                    @else
                                        <input type="text" name="request_dates[{!! $payable->getKey() !!}]" value="{!! isset($defaultRequestDate) ? $defaultRequestDate : '' !!}" class="datepicker form-control input-sm datepicker1 text-big"/>
                                    @endif
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ $document->name }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $payable->quantity }}</td>
                                <td>x</td>
                                <td>{{ $unit->name or '' }}</td>
                                <td>{{ $payable->currency == 1 ? 'IDR':'USD' }}</td>
                                <td class="text-right"> {!! App\Helpers\ArzFormatPrice::price($payable->total) !!}</td>
                                <td class="text-right">
                                    @if($payable->currency == 2)
                                        {!! App\Helpers\ArzFormatPrice::price($payable->total) !!}
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($payable->currency == 1)
                                        {!! App\Helpers\ArzFormatPrice::price($payable->total)  !!}
                                    @endif
                                </td>
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
    </div>

    <input type="hidden" name="jobsheet_id" value="{!! $jobsheetId !!}">

    <hr>
    <button id="create-request-payable" class="btn btn-success btn-xs add-modal m-b-10 hidden">
        <i class="fa fa-plus" data-toggle="tooltip" title="Create Request from Selected Jobsheets"></i> Create Request
    </button>
    {!! Form::close() !!}
</div>