<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom term-rmb" id="tabreimburse{{ $jobsheet->id }}">

@php $index = 0; @endphp

@if(Auth::user()->role == 'marketing' || Auth::user()->role == 'admin')
    @if(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/create')
        <div class="terms-group term-reimbursement" index="{{ $index }}">
            <div class="row">
                <div class="col-sm-12">

                    {!! Form::hidden('rmb_marketing_id[]', 0) !!}

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>TERMS OF PAYMENT</label><br />
                            {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),old('rmb_term_id'), ['class'=>'form-control input-sm input-reimburse term','id'=>'rmb_terms']) !!}
                        </div>
                        <div class="col-sm-3">
                            <label>BILL TO</label><br />
                            {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),old('rmb_customer_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'rmb_bill']) !!}
                        </div>
                        <div class="col-sm-6 text-right">
                            <label></label>
                            <div>
                                <button class="btn btn-sm btn-primary add-terms-reimburse" type="button"><i class="fa fa-plus fa-fw"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 charge-group">
                    <div class="form-group">

                        {!! Form::hidden('rmb_id[][]', 0) !!}

                        <div class="col-sm-3">
                            <label>DETAIL</label><br />
                            <div class="input-group">
                                {!! Form::select(
                                    'rmb_document_id[0][]',
                                    [''=>'']+App\MasterDocument::pluck('name','id')->all(),
                                    null,
                                    ['class'=>'form-control input-sm input-reimburse','id'=>''])
                                !!}

                                <span class="input-group-btn"><button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>CHARGE</label>
                            <input type="text" class="form-control input-sm bpeng" value="B. PENGGANTIAN" readonly>
                        </div>
                        <div class="col-sm-1">
                            <label>QTY</label>
                            {!! Form::text('rmb_quantity[][]',null, [
                            'class'=>'form-control input-sm input-reimburse rmb_qty',
                            'placeholder'=>'Qty'
                            ]) !!}
                            <label class="x-mark">X</label>
                        </div>
                        <div class="col-sm-1 no-padding-right">
                            <label>UNIT</label>
                            {!! Form::select('rmb_unit_id[][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),null, ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                        </div>
                        <div class="col-sm-1">
                            <label>CURR</label>
                            {!! Form::select('rmb_currency[][]', [
                                '1'=>'IDR',
                                '2'=>'USD',
                            ],null, ['class'=>'form-control input-sm input-reimburse rmb_currency']) !!}
                        </div>
                        <div class="col-sm-1 no-padding-left no-padding-right">
                            <label>AMOUNT</label>
                            {!! Form::text('rmb_price[][]',null, [
                            'class'=>'form-control input-sm input-reimburse rmb_ammount',
                            'placeholder'=>'Amount'
                            ]) !!}
                        </div>
                        <div class="col-sm-3 text-right">
                            <label class="text-right">TOTAL</label>
                            <input type="text" class="form-control input-sm text-right rmb_subtotal" param="1" value="0.00" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    @elseif(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/edit')
        @if(count($reimbursements) > 0)
            @foreach($reimbursements->unique('rmb_marketing_id') as $rmb)
                <div class="terms-group term-reimbursement" index="{{ $index }}">
                    <div class="row">

                        <div class="col-sm-12">

                            {!! Form::hidden('rmb_marketing_id[]', $rmb->rmb_marketing_id) !!}

                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label>TERMS OF PAYMENT</label><br />
                                    {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),$rmb->rmb_marketing->term_id, ['class'=>'form-control input-sm input-reimburse term','id'=>'rmb_terms']) !!}
                                </div>
                                <div class="col-sm-3">
                                    <label>BILL TO</label><br />
                                    {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),$rmb->rmb_marketing->customer_id, ['class'=>'form-control input-sm input-reimburse','id'=>'rmb_bill']) !!}
                                </div>
                                <div class="col-sm-6 text-right">
                                    <label></label>
                                    <div>
                                        <button class="btn btn-sm btn-danger empty-terms-reimburse" type="button"><i class="fa fa-minus fa-fw"></i></button>
                                        <button class="btn btn-sm btn-primary add-terms-reimburse" type="button"><i class="fa fa-plus fa-fw"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 charge-group">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label>DETAIL</label>
                                </div>
                                <div class="col-sm-2">
                                    <label>CHARGE</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>QTY</label>
                                </div>
                                <div class="col-sm-1 no-padding-right">
                                    <label>UNIT</label>
                                </div>
                                <div class="col-sm-1">
                                    <label>CURRENCY</label>
                                </div>
                                <div class="col-sm-1 no-padding-left no-padding-right">
                                    <label>AMOUNT</label>
                                </div>
                                <div class="col-sm-3 text-right">
                                    <label class="text-right">SUB TOTAL</label>
                                </div>
                            </div>
                            @foreach($reimbursements->where('rmb_marketing_id', $rmb->rmb_marketing->id) as $doc)

                                {!! Form::hidden('rmb_id['.$index.'][]', $doc->id) !!}

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <div class="input-group">

                                            {!! Form::select('rmb_document_id['.$index.'][]', [''=>'']+App\MasterDocument::pluck('name','id')->all(),$doc->rmb_document_id, ['class'=>'form-control input-sm document', 'id'=>'rmb_documents']) !!}
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm btn-danger empty-reimburse" type="button"><i class="fa fa-minus"></i></button>
                                                <button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control input-sm bpeng" value="B. PENGGANTIAN" readonly>
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::text('rmb_quantity['.$index.'][]',$doc->rmb_quantity, [
                                            'class'=>'form-control input-sm qty', 'id'=>'rmb_qty',
                                            'placeholder'=>'Qty'
                                        ]) !!}
                                        <label class="x-mark">X</label>
                                    </div>
                                    <div class="col-sm-1 no-padding-right">
                                        {!! Form::select('rmb_unit_id['.$index.'][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$doc->rmb_unit_id, ['class'=>'form-control input-sm unit','id'=>'rmb_unit']) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::select('rmb_currency['.$index.'][]', [
                                            '1'=>'IDR',
                                            '2'=>'USD',
                                        ],$doc->rmb_currency, ['class'=>'form-control input-sm currency','id'=>'rmb_curr']) !!}
                                    </div>
                                    <div class="col-sm-1 no-padding-left no-padding-right">
                                        {!! Form::text('rmb_price['.$index.'][]',number_format($doc->rmb_price), [
                                            'class'=>'form-control input-sm ammount','id'=>'rmb_price',
                                            'placeholder'=>'Amount'
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-3 text-right">
                                        @php
                                            $total = $doc->rmb_quantity * $doc->rmb_price;
                                        @endphp
                                        <input type="text" class="form-control input-sm text-right subtotal" id="rmb_total" value="{{ number_format($total) }}" readonly param="1">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div><br>

                <?php $index++; ?>
            @endforeach
        @else
            <div class="terms-group term-reimbursement" index="{{ $index }}">
                <div class="row">
                    <div class="col-sm-12">

                        {!! Form::hidden('rmb_marketing_id[]', 0) !!}

                        <div class="form-group">
                            <div class="col-sm-3">
                                <label>TERMS OF PAYMENT</label><br />
                                {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),old('rmb_term_id'), ['class'=>'form-control input-sm input-reimburse term','id'=>'']) !!}
                            </div>
                            <div class="col-sm-3">
                                <label>BILL TO</label><br />
                                {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),old('rmb_customer_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-6 text-right">
                                <label></label>
                                <div>
                                    <button class="btn btn-sm btn-primary add-terms-reimburse" type="button"><i class="fa fa-plus fa-fw"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">

                            {!! Form::hidden('rmb_id[][]', 0) !!}

                            <div class="col-sm-3">
                                <label>DETAIL</label><br />
                                <div class="input-group">
                                    {!! Form::select(
                                        'rmb_document_id[0][]',
                                        [''=>'']+App\MasterDocument::pluck('name','id')->all(),
                                        null,
                                        ['class'=>'form-control input-sm input-reimburse','id'=>''])
                                    !!}
                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>CHARGE</label>
                                <input type="text" class="form-control input-sm bpeng" value="B. PENGGANTIAN" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                                {!! Form::text('rmb_quantity[][]',null, [
                                'class'=>'form-control input-sm input-reimburse rmb_qty',
                                'placeholder'=>'Qty'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1 no-padding-right">
                                <label>UNIT</label>
                                {!! Form::select('rmb_unit_id[][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),null, ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                                {!! Form::select('rmb_currency[][]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],null, ['class'=>'form-control input-sm input-reimburse rmb_currency']) !!}
                            </div>
                            <div class="col-sm-1 no-padding-left no-padding-right">
                                <label>AMOUNT</label>
                                {!! Form::text('rmb_price[][]',null, [
                                'class'=>'form-control input-sm input-reimburse rmb_ammount',
                                'placeholder'=>'Amount'
                                ]) !!}
                            </div>
                            <div class="col-sm-3 text-right">
                                <label class="text-right">TOTAL</label>
                                <input type="text" class="form-control input-sm text-right rmb_subtotal" param="1" value="0.00" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <!-- <div class="row total-group">
                <div class="col-md-4 col-md-offset-8">
                    <table class="table table-borderless charge-table no-margin">
                        <tbody>
                            <tr>
                                <td class="text-right"><strong>TOTAL USD</strong></td>
                                <td class="text-right"><strong id="rmb_total-usd">0.00</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>TOTAL IDR</strong></td>
                                <td class="text-right"><strong id="rmb_total-idr">0.00</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->
        @endif
    @endif
@elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'admin')
    @if(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/create')
        <div class="terms-group term-reimbursement" index="0">
            <div class="row">
            @foreach($reimbursements->unique('rmb_marketing_id') as $rmb)

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>TERMS OF PAYMENT</label>
                            {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),$rmb->rmb_marketing->term_id, ['class'=>'form-control input-sm input-reimburse term','disabled']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label>BILL TO</label>
                            {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),$rmb->rmb_marketing->customer_id, ['class'=>'form-control input-sm input-reimburse','disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 charge-group">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>DETAIL</label>
                        </div>
                        <div class="col-sm-2">
                            <label >VENDOR</label>
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
                            <label class="text-right">TOTAL</label>
                        </div>
                    </div>
                    @foreach($reimbursements->where('rmb_marketing_id', $rmb->rmb_marketing_id) as $rmbs)
                        {!! Form::hidden('rmb_id[]', $rmbs->id) !!}

                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="input-group">

                                    {!! Form::select('rmb_document_id[]', [''=>'']+App\MasterDocument::pluck('name','id')->all(),$rmbs->rmb_document_id, ['class'=>'form-control input-sm document', 'id'=>'','disabled']) !!}
                                    <!-- <span class="input-group-btn">
                                        <button class="btn btn-sm btn-danger rem-reimburse" type="button"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button>
                                    </span> -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::select('rmb_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),$rmbs->rmb_vendor_id, ['class'=>'form-control input-sm','id'=>'','required']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::text('rmb_quantity[]',$rmbs->rmb_quantity, [
                                    'class'=>'form-control input-sm qty',
                                    'placeholder'=>'Qty','disabled'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1 no-padding-right">
                                {!! Form::select('rmb_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$rmbs->rmb_unit_id, ['class'=>'form-control input-sm unit','disabled']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::select('rmb_currency[]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],$rmbs->rmb_currency, ['class'=>'form-control input-sm currency','disabled']) !!}
                            </div>
                            <div class="col-sm-1 no-padding-left no-padding-right">
                                {!! Form::text('rmb_price[]',number_format($rmbs->rmb_price), [
                                    'class'=>'form-control input-sm ammount',
                                    'placeholder'=>'Amount','disabled'
                                ]) !!}
                            </div>
                            <div class="col-sm-3 text-right">
                                @php
                                    $rmb_total = $rmbs->rmb_quantity * $rmbs->rmb_price;
                                @endphp
                                <input type="text" class="form-control input-sm text-right rmb_subtotal" id="email" value="{{ number_format($rmb_total) }}" readonly param="1">
                            </div>
                        </div>
                    @endforeach
                    <hr>
                </div>
            @endforeach
            </div>
        </div>
    @elseif(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/edit')
        <div class="terms-group term-reimbursement" index="0">
            <div class="row">
            @foreach($reimbursements->unique('rmb_marketing_id') as $rmb)

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>TERMS OF PAYMENT</label>
                            {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),$rmb->rmb_marketing->term_id, ['class'=>'form-control input-sm input-reimburse term','disabled']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label>BILL TO</label>
                            {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),$rmb->rmb_marketing->customer_id, ['class'=>'form-control input-sm input-reimburse','disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 charge-group">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>DETAIL</label>
                        </div>
                        <div class="col-sm-2">
                            <label >VENDOR</label>
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
                            <label class="text-right">TOTAL</label>
                        </div>
                    </div>
                    @foreach($reimbursements->where('rmb_marketing_id', $rmb->rmb_marketing_id) as $rmbs)
                        {!! Form::hidden('rmb_id[]', $rmbs->id) !!}

                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="input-group">

                                    {!! Form::select('rmb_document_id[]', [''=>'']+App\MasterDocument::pluck('name','id')->all(),$rmbs->rmb_document_id, ['class'=>'form-control input-sm document', 'id'=>'','disabled']) !!}
                                    <!-- <span class="input-group-btn">
                                        <button class="btn btn-sm btn-danger rem-reimburse" type="button"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button>
                                    </span> -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::select('rmb_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),$rmbs->rmb_vendor_id, ['class'=>'form-control input-sm','id'=>'','required']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::text('rmb_quantity[]',$rmbs->rmb_quantity, [
                                    'class'=>'form-control input-sm qty',
                                    'placeholder'=>'Qty','disabled'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1 no-padding-right">
                                {!! Form::select('rmb_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$rmbs->rmb_unit_id, ['class'=>'form-control input-sm unit','disabled']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::select('rmb_currency[]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],$rmbs->rmb_currency, ['class'=>'form-control input-sm currency','disabled']) !!}
                            </div>
                            <div class="col-sm-1 no-padding-left no-padding-right">
                                {!! Form::text('rmb_price[]',number_format($rmbs->rmb_price), [
                                    'class'=>'form-control input-sm ammount',
                                    'placeholder'=>'Amount','disabled'
                                ]) !!}
                            </div>
                            <div class="col-sm-3 text-right">
                                @php
                                    $rmb_total = $rmbs->rmb_quantity * $rmbs->rmb_price;
                                @endphp
                                <input type="text" class="form-control input-sm text-right rmb_subtotal" id="email" value="{{ number_format($rmb_total) }}" readonly param="1">
                            </div>
                        </div>
                    @endforeach
                    <hr>
                </div>
            @endforeach
            </div>
        </div>
    @endif
@elseif(Auth::user()->role == 'payable' || Auth::user()->role == 'admin' || Auth::user()->role = 'manager')
    @if(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/edit' || Request::path() == 'manager/jobsheet/'.$jobsheet->id.'/edit')
        @if(count($reimbursements) > 0)
            <div class="terms-group term-reimbursement" index="0">
                <div class="row">
                @foreach($reimbursements->unique('rmb_marketing_id') as $rmb)

                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label>TERMS OF PAYMENT</label>
                                {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),$rmb->rmb_marketing->term_id, ['class'=>'form-control input-sm input-reimburse term','disabled']) !!}
                            </div>
                            <div class="col-sm-2">
                                <label>BILL TO</label>
                                {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),$rmb->rmb_marketing->customer_id, ['class'=>'form-control input-sm input-reimburse','disabled']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label>DETAIL</label>
                            </div>
                            <div class="col-sm-2">
                                <label >VENDOR</label>
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
                                <label class="text-right">TOTAL</label>
                            </div>
                        </div>
                        @foreach($reimbursements->where('rmb_marketing_id', $rmb->rmb_marketing_id) as $rmbs)
                            {!! Form::hidden('rmb_id[]', $rmbs->id) !!}

                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="input-group">

                                        {!! Form::select('rmb_document_id[]', [''=>'']+App\MasterDocument::pluck('name','id')->all(),$rmbs->rmb_document_id, ['class'=>'form-control input-sm document', 'id'=>'','disabled']) !!}
                                        <!-- <span class="input-group-btn">
                                            <button class="btn btn-sm btn-danger rem-reimburse" type="button"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button>
                                        </span> -->
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('rmb_vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(),$rmbs->rmb_vendor_id, ['class'=>'form-control input-sm','id'=>'','required']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::text('rmb_quantity[]',$rmbs->rmb_quantity, [
                                        'class'=>'form-control input-sm qty',
                                        'placeholder'=>'Qty','disabled'
                                    ]) !!}
                                    <label class="x-mark">X</label>
                                </div>
                                <div class="col-sm-1 no-padding-right">
                                    {!! Form::select('rmb_unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$rmbs->rmb_unit_id, ['class'=>'form-control input-sm unit','disabled']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rmb_currency[]', [
                                        '1'=>'IDR',
                                        '2'=>'USD',
                                    ],$rmbs->rmb_currency, ['class'=>'form-control input-sm currency','disabled']) !!}
                                </div>
                                <div class="col-sm-1 no-padding-left no-padding-right">
                                    {!! Form::text('rmb_price[]',number_format($rmbs->rmb_price), [
                                        'class'=>'form-control input-sm ammount',
                                        'placeholder'=>'Amount','disabled'
                                    ]) !!}
                                </div>
                                <div class="col-sm-3 text-right">
                                    @php
                                        $rmb_total = $rmbs->rmb_quantity * $rmbs->rmb_price;
                                    @endphp
                                    <input type="text" class="form-control input-sm text-right rmb_subtotal" id="email" value="{{ number_format($rmb_total) }}" readonly param="1">
                                </div>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                @endforeach
                </div>
            </div>
        @else
            <div class="terms-group term-reimbursement" index="{{ $index }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label>TERMS OF PAYMENT</label><br />
                                {!! Form::select('rmb_term_id[]', [''=>'']+App\MasterMonths::pluck('name','id')->all(),old('rmb_term_id'), ['class'=>'form-control input-sm input-reimburse term','id'=>'']) !!}
                            </div>
                            <div class="col-sm-3">
                                <label>BILL TO</label><br />
                                {!! Form::select('rmb_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),old('rmb_customer_id'), ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-6 text-right">
                                <label></label>
                                <div>
                                    <button class="btn btn-sm btn-primary add-terms-reimburse" type="button"><i class="fa fa-plus fa-fw"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 charge-group">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label>DETAIL</label><br />
                                <div class="input-group">
                                    {!! Form::select(
                                        'rmb_document_id[0][]',
                                        [''=>'']+App\MasterDocument::pluck('name','id')->all(),
                                        null,
                                        ['class'=>'form-control input-sm input-reimburse','id'=>''])
                                    !!}
                                    <span class="input-group-btn"><button class="btn btn-sm btn-primary add-reimburse" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>CHARGE</label>
                                <input type="text" class="form-control input-sm bpeng" value="B. PENGGANTIAN" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label>QTY</label>
                                {!! Form::text('rmb_quantity[][]',null, [
                                'class'=>'form-control input-sm input-reimburse rmb_qty',
                                'placeholder'=>'Qty'
                                ]) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1 no-padding-right">
                                <label>UNIT</label>
                                {!! Form::select('rmb_unit_id[][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),null, ['class'=>'form-control input-sm input-reimburse','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                <label>CURR</label>
                                {!! Form::select('rmb_currency[][]', [
                                    '1'=>'IDR',
                                    '2'=>'USD',
                                ],null, ['class'=>'form-control input-sm input-reimburse rmb_currency']) !!}
                            </div>
                            <div class="col-sm-1 no-padding-left no-padding-right">
                                <label>AMOUNT</label>
                                {!! Form::text('rmb_price[][]',null, [
                                'class'=>'form-control input-sm input-reimburse rmb_ammount',
                                'placeholder'=>'Amount'
                                ]) !!}
                            </div>
                            <div class="col-sm-3 text-right">
                                <label class="text-right">TOTAL</label>
                                <input type="text" class="form-control input-sm text-right rmb_subtotal" param="1" value="0.00" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        @endif
    @endif
    <!-- <div class="row total-group">
        <div class="col-md-4 col-md-offset-8">
            <table class="table table-borderless charge-table no-margin">
                <tbody>
                    <tr>
                        <td class="text-right"><strong>TOTAL USD</strong></td>
                        <td class="text-right"><strong id="rmb_total-usd">0.00</strong></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>TOTAL IDR</strong></td>
                        <td class="text-right"><strong id="rmb_total-idr">0.00</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->
@endif
<div class="row total-group"></div>
</div>
