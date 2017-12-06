<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom" id="tabrc{{ $jobsheet->id }}">

    @php $index = 0; @endphp

    @if(Auth::user()->role == 'marketing' || Auth::user()->role == 'admin')
        @if(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/create')
            <div class="row">
                <div class="col-sm-12 charge-group">
                    <div class="form-group">

                        {!! Form::hidden('rc_id[]', 0) !!}

                        <div class="col-sm-1 no-padding-right">
                            <label>RC TYPE</label>
                            <div class="input-group">
                                {!! Form::select('rc_type[]', [
                                    'marketing'=>'Marketing',
                                ],'marketing', ['class'=>'form-control input-sm','disabled']) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>DETAIL</label>
                            <div class="input-group">
                                {!! Form::select(
                                    'rc_document_id[]',
                                    [''=>'']+App\MasterDocument::pluck('name','id')->all(),old('rc_document_id'),
                                    ['class'=>'form-control input-sm binding_charge','id'=>''])
                                !!}
                                <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                            </div>
                        </div>
                        <div class="col-sm-2 no-padding-right no-padding-left">
                            <label>VENDOR</label>
                            {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),old('vendor_id'), ['class'=>'form-control input-sm','id'=>'']) !!}
                        </div>
                        <div class="col-sm-1">
                            <label>QTY</label>
                            {!! Form::text('rc_quantity[]',old('quantity'), [
                                'class'=>'form-control input-sm rc_qty',
                                'placeholder'=>'Qty'
                            ]) !!}
                            <label class="x-mark">X</label>
                        </div>
                        <div class="col-sm-1">
                            <label>UNIT</label>
                            {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('unit_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                        </div>
                        <div class="col-sm-1">
                            <label>CURR</label>
                            {!! Form::select('rc_currency[]', [
                                '1'=>'IDR',
                                '2'=>'USD',
                            ],null, ['class'=>'form-control input-sm rc_currency']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label>AMOUNT</label>
                            {!! Form::text('rc_price[]',old('price'), ['class'=>'form-control input-sm rc_ammount',
                                'placeholder'=>'Amount'
                            ]) !!}
                        </div>
                        <div class="col-sm-2 text-right">
                            <label>TOTAL</label>
                            <input type="text" class="form-control input-sm text-right rc_subtotal"  value="0.00" readonly param="1">
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/edit')
            @if(count($rcs) > 0)
                <div class="row">
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label>DETAIL</label>
                            </div>
                            <div class="col-sm-3">
                                <label>VENDOR</label>
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1">
                                <label>UNIT</label>
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                            </div>
                            <div class="col-sm-2">
                                <label>AMOUNT</label>
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>TOTAL</label>
                            </div>
                        </div>
                        @foreach($rcs as $rc)
                            <div class="form-group">

                                {!! Form::hidden('rc_id[]', $rc->id) !!}

                                <div class="col-sm-1 no-padding-right">
                                    <div class="input-group">
                                        {!! Form::select('rc_type[]', [
                                            'marketing'=>'Marketing',
                                        ],'marketing', ['class'=>'form-control input-sm','disabled']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        {!! Form::select(
                                            'rc_document_id[]',
                                            [''=>'']+App\MasterDocument::pluck('name','id')->all(),$rc->rc_document_id,
                                            ['class'=>'form-control input-sm binding_charge','id'=>'rc_documents'])
                                        !!}
                                        <span class="input-group-btn"><button class="btn btn-sm btn-danger empty-rc" type="button"><i class="fa fa-minus"></i></button></span>
                                        <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                    </div>
                                </div>
                                <div class="col-sm-2 no-padding-right no-padding-left">
                                    {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),$rc->rc_vendor_id, ['class'=>'form-control input-sm','id'=>'rc_vendor']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::text('rc_quantity[]',$rc->rc_quantity, [
                                        'class'=>'form-control input-sm rc_qty',
                                        'placeholder'=>'Qty','id'=>'rc_qty'
                                    ]) !!}
                                    <label class="x-mark">X</label>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$rc->rc_unit_id, ['class'=>'form-control input-sm input-reimburse','id'=>'rc_unit']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_currency[]', [
                                        '1'=>'IDR',
                                        '2'=>'USD',
                                    ],$rc->rc_currency, ['class'=>'form-control input-sm rc_currency','id'=>'rc_curr']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('rc_price[]',number_format($rc->rc_price), ['class'=>'form-control input-sm rc_ammount','placeholder'=>'Amount','id'=>'rc_price']) !!}
                                </div>
                                <div class="col-sm-2 text-right">
                                    @php $total = $rc->rc_quantity * $rc->rc_price; @endphp
                                    <input type="text" class="form-control input-sm text-right rc_subtotal"  value="{{ $total }}" readonly param="1", id="rc_total">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">

                            {!! Form::hidden('rc_id[]', 0) !!}

                            <div class="col-sm-1 no-padding-right">
                                <label>RC TYPE</label>
                                <div class="input-group">
                                    {!! Form::select('rc_type[]', [
                                        'marketing'=>'Marketing',
                                    ],'marketing', ['class'=>'form-control input-sm','disabled']) !!}
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>DETAIL</label>
                                <div class="input-group">
                                    {!! Form::select(
                                        'rc_document_id[]',
                                        [''=>'']+App\MasterDocument::pluck('name','id')->all(),old('rc_document_id'),
                                        ['class'=>'form-control input-sm binding_charge','id'=>''])
                                    !!}
                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2 no-padding-right no-padding-left">
                                <label>VENDOR</label>
                                {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),old('vendor_id'), ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                                {!! Form::text('rc_quantity[]',old('quantity'), [
                                    'class'=>'form-control input-sm rc_qty',
                                    'placeholder'=>'Qty'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1">
                                <label>UNIT</label>
                                {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('unit_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                                {!! Form::select('rc_currency[]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],null, ['class'=>'form-control input-sm rc_currency']) !!}
                            </div>
                            <div class="col-sm-2">
                                <label>AMOUNT</label>
                                {!! Form::text('rc_price[]',old('price'), ['class'=>'form-control input-sm rc_ammount',
                                    'placeholder'=>'Amount'
                                ]) !!}
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>TOTAL</label>
                                <input type="text" class="form-control input-sm text-right rc_subtotal"  value="0.00" readonly param="1">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'admin')
        @if(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/create')

            @php
                $rcs = App\RC::where('jobsheet_id',$jobsheet->id)->where('rc_type','pricing')->get();
            @endphp

            @if(count($rcs) > 0)
                <div class="row">
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">
                            <div class="col-sm-1 no-padding-right">
                                <label>RC TYPE</label>
                            </div>
                            <div class="col-sm-2">
                                <label>DETAIL</label>
                            </div>
                            <div class="col-sm-2 no-padding-right no-padding-left">
                                <label>VENDOR</label>
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                            </div>
                            <div class="col-sm-1">
                                <label>UNIT</label>
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                            </div>
                            <div class="col-sm-2">
                                <label>AMOUNT</label>
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>TOTAL</label>
                            </div>
                        </div>
                        @foreach($rcs as $rc)
                            @if($rc->rc_type = 'pricing')

                                {!! Form::hidden('rc_id[]', $rc->id) !!}

                                <div class="form-group">
                                    <div class="col-sm-1 no-padding-right">
                                        <div class="input-group">
                                            {!! Form::select('rc_type[]', [
                                                'pricing'=>'Pricing',
                                            ],'pricing', ['class'=>'form-control input-sm','disabled']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            {!! Form::select(
                                                'rc_document_id[]',
                                                [''=>'']+App\MasterDocument::pluck('name','id')->all(),$rc->rc_document_id,
                                                ['class'=>'form-control input-sm binding_charge','id'=>''])
                                            !!}
                                            <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 no-padding-right no-padding-left">
                                        {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),$rc->rc_vendor_id, ['class'=>'form-control input-sm','id'=>'']) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::text('rc_quantity[]',$rc->rc_quantity, [
                                            'class'=>'form-control input-sm rc_qty',
                                            'placeholder'=>'Qty'
                                        ]) !!}
                                        <label class="x-mark">X</label>
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$rc->rc_unit_id, ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::select('rc_currency[]', [
                                            '1'=>'IDR',
                                            '2'=>'USD',
                                        ],$rc->rc_currency, ['class'=>'form-control input-sm rc_currency']) !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::text('rc_price[]',number_format($rc->rc_price), ['class'=>'form-control input-sm rc_ammount',
                                            'placeholder'=>'Amount'
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <input type="text" class="form-control input-sm text-right rc_subtotal"  value="{{ number_format($rc->rc_total) }}" readonly param="1">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group">

                            @if(count($rcs) < 1)
                                {!! Form::hidden('rc_id[]', '0') !!}
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        {!! Form::select(
                                            'rc_document_id[]',
                                            [''=>'']+App\MasterDocument::pluck('name','id')->all(),null,
                                            ['class'=>'form-control input-sm binding_charge','id'=>''])
                                        !!}
                                        <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),old('vendor_id'), ['class'=>'form-control input-sm','id'=>'']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::text('rc_quantity[]',old('quantity'), [
                                        'class'=>'form-control input-sm rc_qty',
                                        'placeholder'=>'Qty'
                                    ]) !!}
                                    <label class="x-mark">X</label>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('unit_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_currency[]', [
                                        '1'=>'IDR',
                                        '2'=>'USD',
                                    ],null, ['class'=>'form-control input-sm rc_currency']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('rc_price[]',old('price'), ['class'=>'form-control input-sm rc_ammount',
                                        'placeholder'=>'Amount'
                                    ]) !!}
                                </div>
                                <div class="col-sm-2 text-right">
                                    <input type="text" class="form-control input-sm text-right rc_subtotal"  value="0.00" readonly param="1">
                                </div>
                            @endif


                        </div>
                    </div>
                </div><hr>
            @else
                <div class="row">
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">

                            {!! Form::hidden('rc_id[]', 0) !!}

                            <div class="col-sm-1 no-padding-right">
                                <label>RC TYPE</label>
                                <div class="input-group">
                                    {!! Form::select('rc_type[]', [
                                        'pricing'=>'Pricing',
                                    ],'pricing', ['class'=>'form-control input-sm','disabled']) !!}
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>DETAIL</label>
                                <div class="input-group">
                                    {!! Form::select(
                                        'rc_document_id[]',
                                        [''=>'']+App\MasterDocument::pluck('name','id')->all(),old('rc_document_id'),
                                        ['class'=>'form-control input-sm binding_charge','id'=>''])
                                    !!}
                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2 no-padding-right no-padding-left">
                                <label>VENDOR</label>
                                {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),old('vendor_id'), ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                                {!! Form::text('rc_quantity[]',old('quantity'), [
                                    'class'=>'form-control input-sm rc_qty',
                                    'placeholder'=>'Qty'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1">
                                <label>UNIT</label>
                                {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('unit_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                                {!! Form::select('rc_currency[]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],null, ['class'=>'form-control input-sm rc_currency']) !!}
                            </div>
                            <div class="col-sm-2">
                                <label>AMOUNT</label>
                                {!! Form::text('rc_price[]',old('price'), ['class'=>'form-control input-sm rc_ammount',
                                    'placeholder'=>'Amount'
                                ]) !!}
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>TOTAL</label>
                                <input type="text" class="form-control input-sm text-right rc_subtotal"  value="0.00" readonly param="1">
                            </div>
                        </div>
                    </div>
                </div><hr>

                <!--<div class="row total-group">
                    <div class="col-md-4 col-md-offset-8">
                        <table class="table table-borderless charge-table no-margin">
                            <tbody>
                                <tr>
                                    <td class="text-right"><strong>TOTAL USD</strong></td>
                                    <td class="text-right" ><strong id="total-usd">0.00</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>TOTAL IDR</strong></td>
                                    <td class="text-right"><strong id="total-idr">0.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            @endif
        @endif
    @elseif(Auth::user()->role == 'payable' || Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
        @if(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/edit' || Request::path() == 'manager/jobsheet/'.$jobsheet->id.'/edit')

            @php
                $rcs = App\RC::where('jobsheet_id',$jobsheet->id)->get();
            @endphp

            @if(count($rcs) > 0)
                <div class="row">
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">
                            <div class="col-sm-1 no-padding-right">
                                <label>RC TYPE</label>
                            </div>
                            <div class="col-sm-2">
                                <label>DETAIL</label>
                            </div>
                            <div class="col-sm-2 no-padding-right no-padding-left">
                                <label>VENDOR</label>
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                            </div>
                            <div class="col-sm-1">
                                <label>UNIT</label>
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                            </div>
                            <div class="col-sm-2">
                                <label>AMOUNT</label>
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>TOTAL</label>
                            </div>
                        </div>
                        @foreach($rcs as $rc)
                            {!! Form::hidden('rc_id[]', $rc->id) !!}

                            <div class="form-group">
                                <div class="col-sm-1 no-padding-right">
                                    <div class="input-group">
                                        {!! Form::select('rc_type[]', [
                                            'marketing'=>'Marketing',
                                            'pricing'=>'Pricing',
                                        ],$rc->rc_type, ['class'=>'form-control input-sm']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        {!! Form::select(
                                            'rc_document_id[]',
                                            [''=>'']+App\MasterDocument::pluck('name','id')->all(),$rc->rc_document_id,
                                            ['class'=>'form-control input-sm binding_charge','id'=>''])
                                        !!}
                                        <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                    </div>
                                </div>
                                <div class="col-sm-2 no-padding-right no-padding-left">
                                    {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),$rc->rc_vendor_id, ['class'=>'form-control input-sm','id'=>'']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::text('rc_quantity[]',$rc->rc_quantity, [
                                        'class'=>'form-control input-sm rc_qty',
                                        'placeholder'=>'Qty'
                                    ]) !!}
                                    <label class="x-mark">X</label>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$rc->rc_unit_id, ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_currency[]', [
                                        '1'=>'IDR',
                                        '2'=>'USD',
                                    ],$rc->rc_currency, ['class'=>'form-control input-sm rc_currency']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('rc_price[]',number_format($rc->rc_price), ['class'=>'form-control input-sm rc_ammount',
                                        'placeholder'=>'Amount'
                                    ]) !!}
                                </div>
                                <div class="col-sm-2 text-right">
                                    <input type="text" class="form-control input-sm text-right rc_subtotal"  value="{{ number_format($rc->rc_total) }}" readonly param="1">
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">

                            @if(count($rcs) < 1)
                                {!! Form::hidden('rc_id[]', '0') !!}
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        {!! Form::select(
                                            'rc_document_id[]',
                                            [''=>'']+App\MasterDocument::pluck('name','id')->all(),null,
                                            ['class'=>'form-control input-sm binding_charge','id'=>''])
                                        !!}
                                        <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),old('vendor_id'), ['class'=>'form-control input-sm','id'=>'']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::text('rc_quantity[]',old('quantity'), [
                                        'class'=>'form-control input-sm rc_qty',
                                        'placeholder'=>'Qty'
                                    ]) !!}
                                    <label class="x-mark">X</label>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('unit_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rc_currency[]', [
                                        '1'=>'IDR',
                                        '2'=>'USD',
                                    ],null, ['class'=>'form-control input-sm rc_currency']) !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::text('rc_price[]',old('price'), ['class'=>'form-control input-sm rc_ammount',
                                        'placeholder'=>'Amount'
                                    ]) !!}
                                </div>
                                <div class="col-sm-2 text-right">
                                    <input type="text" class="form-control input-sm text-right rc_subtotal"  value="0.00" readonly param="1">
                                </div>
                            @endif


                        </div>
                    </div>
                </div><hr>
            @else
                <div class="row">
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">

                            {!! Form::hidden('rc_id[]', 0) !!}

                            <div class="col-sm-1 no-padding-right">
                                <label>RC TYPE</label>
                                <div class="input-group">
                                    {!! Form::select('rc_type[]', [
                                        'pricing'=>'Pricing',
                                    ],'pricing', ['class'=>'form-control input-sm','disabled']) !!}
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>DETAIL</label>
                                <div class="input-group">
                                    {!! Form::select(
                                        'rc_document_id[]',
                                        [''=>'']+App\MasterDocument::pluck('name','id')->all(),old('rc_document_id'),
                                        ['class'=>'form-control input-sm binding_charge','id'=>''])
                                    !!}
                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-rc" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2 no-padding-right no-padding-left">
                                <label>VENDOR</label>
                                {!! Form::select('rc_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),old('vendor_id'), ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                                {!! Form::text('rc_quantity[]',old('quantity'), [
                                    'class'=>'form-control input-sm rc_qty',
                                    'placeholder'=>'Qty'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1">
                                <label>UNIT</label>
                                {!! Form::select('rc_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('unit_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                                {!! Form::select('rc_currency[]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],null, ['class'=>'form-control input-sm rc_currency']) !!}
                            </div>
                            <div class="col-sm-2">
                                <label>AMOUNT</label>
                                {!! Form::text('rc_price[]',old('price'), ['class'=>'form-control input-sm rc_ammount',
                                    'placeholder'=>'Amount'
                                ]) !!}
                            </div>
                            <div class="col-sm-2 text-right">
                                <label>TOTAL</label>
                                <input type="text" class="form-control input-sm text-right rc_subtotal"  value="0.00" readonly param="1">
                            </div>
                        </div>
                    </div>
                </div><hr>

                <!--<div class="row total-group">
                    <div class="col-md-4 col-md-offset-8">
                        <table class="table table-borderless charge-table no-margin">
                            <tbody>
                                <tr>
                                    <td class="text-right"><strong>TOTAL USD</strong></td>
                                    <td class="text-right" ><strong id="total-usd">0.00</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>TOTAL IDR</strong></td>
                                    <td class="text-right"><strong id="total-idr">0.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            @endif
        @endif
    @endif

</div>
