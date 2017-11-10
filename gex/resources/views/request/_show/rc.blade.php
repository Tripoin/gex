<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">
    {!! Form::open(['url' => route($controllerRole.'.request-rc.store'), 'method' => 'POST','class'=>'form-horizontal']) !!}

    <div class="table-responsive">
        <table class="table table-bordered table-body-condensed table-striped no-margin">
            <thead>
            <tr>
                <th class="valign-middle text-center" rowspan="2">
                    <input type="checkbox" name="rc_all_id" value="" class="rc_all_id">
                </th>
                <td class="valign-middle text-center" rowspan="2">DATE</td>
                <td class="valign-middle text-center" rowspan="2">NO</td>
                <td class="valign-middle text-center" rowspan="2">DOCUMENT</td>
                <td class="valign-middle text-center" rowspan="2">VENDOR</td>
                <td class="valign-middle text-center" rowspan="2">UNIT</td>
                <td class="valign-middle text-center" rowspan="2">PRICE</td>
                <td class="valign-middle text-center" rowspan="2">CURRENCY</td>
                <td class="valign-middle text-center" rowspan="2">QUANTITY</td>
                <td class="valign-middle text-center" rowspan="2">TOTAL</td>
                <td class="valign-middle text-center" rowspan="2">TYPE</td>
                <td class="valign-middle text-center" rowspan="2">RATE</td>
                <td class="valign-middle text-center" rowspan="2">PAYMENT_ID</td>
            </tr>
            </thead>
            <tbody>
            <?php $jobsheetId = ''; ?>
            @if(count($rcs) > 0)

                <?php $i = 1; ?>
                @foreach($rcs as $rc)

                    @php
                    $document = \App\MasterDocument::find($rc->document_id);
                    $vendor = \App\MasterVendor::find($rc->vendor_id);
                    $unit = \App\MasterUnit::find($rc->unit_id);
                    $jobsheetId = $rc->jobsheet_id;
                    @endphp

                    <tr class="<?php
                    echo $requestedRCIds && in_array($rc->getKey(), $requestedRCIds) ? "danger" : "";
                    ?>">
                        <td class="text-center">
                            @if( $requestedRCIds && in_array($rc->getKey(), $requestedRCIds)  )
                                <span class="btn btn-primary">Requested</span>
                            @else
                                <input type="checkbox" name="rc_ids[]" value="{!! $rc->getKey() !!}" class='rc_ids'>
                            @endif
                        </td>
                        <td>
                            @if( $requestedDates && isset($requestedDates[$rc->getKey()])  )
                                {!! $requestedDates[$rc->getKey()] !!}
                            @else
                                <input type="text" name="request_dates[{!! $rc->getKey() !!}]" value="{!! isset($defaultRequestDate) ? $defaultRequestDate : '' !!}" class="datepicker form-control input-sm datepicker1 text-big"/>
                            @endif
                        </td>
                        <td>{{ $i }}</td>
                        <td>{{ $document ? $document->name : '' }}</td>
                        <td>{{ $vendor ? $vendor->name : '' }}</td>
                        <td>{{ $unit ? $unit->name : '' }}</td>
                        <td>{{ $rc->currency == 1 ? 'IDR':'USD' }}</td>
                        <td class="text-right">{{ number_format((double) $rc->price) }}</td>
                        <td>{{ $rc->quantity }}</td>
                        <td class="text-right">{{ number_format((double) $rc->total) }}</td>
                        <td class="text-right">{!! $rc->type !!}</td>
                        <td class="text-right">{!! $rc->rate !!}</td>
                        <td class="text-right">{!! $rc->payment_id !!}</td>
                    </tr>
                    <?php $i++; ?>

                @endforeach

            @else
                <tr>
                    <td class="text-center" colspan="10">This job doesn't have rc</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <input type="hidden" name="jobsheet_id" value="{!! $jobsheetId !!}">

    <hr>
    <button id="create-request" class="btn btn-success btn-xs add-modal m-b-10 hidden">
        <i class="fa fa-plus" data-toggle="tooltip" title="Create Request from Selected Jobsheets"></i> Create Request
    </button>
    {!! Form::close() !!}
</div>