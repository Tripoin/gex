<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">
    {!! Form::open(['url' => route($controllerRole.'.request.store'), 'method' => 'POST','class'=>'form-horizontal']) !!}

    @if(Auth::user()->role == 'payable')
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
                @if(isset($actionPayable) && $actionPayable)
                    <?php $jobsheetId = ''; ?>
                @endif
                @if(count($payables) > 0)

                    <?php $i = 1; ?>
                    @foreach($payables as $payable)

                        @php
                            $document = \App\MasterDocument::find($payable->document_id);
                            $vendor = \App\MasterVendor::find($payable->vendor_id);
                            $unit = \App\MasterUnit::find($payable->unit_id);
                            $user = Auth::user();
                            if(isset($actionPayable) && $actionPayable)
                                $jobsheetId = $payable->jobsheet_id;
                        @endphp

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
                                @if( $requestedDates && isset($requestedDates[$payable->getKey()])  )
                                    {!! $requestedDates[$payable->getKey()] !!}
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

    <input type="hidden" name="jobsheet_id" value="{!! $jobsheetId !!}">

    <hr>
    <button id="create-request" class="btn btn-success btn-xs add-modal m-b-10 hidden">
        <i class="fa fa-plus" data-toggle="tooltip" title="Create Request from Selected Jobsheets"></i> Create Request
    </button>
    {!! Form::close() !!}
</div>