@if(Auth::user()->role == 'operation' || Auth::user()->role == 'admin')
    @if(Request::path() == 'operation/jobsheet/uncreated')
        <div class="clearfix">
            <div class="row">
            <label class="col-sm-3">DETAIL OF CHARGES</label>
            <label class="col-sm-3">VENDOR</label>
            <label class="col-sm-1">QTY</label>
            <label class="col-sm-2">UNIT</label>
            <label class="col-sm-1">CURR</label>
            <label class="col-sm-2">AMOUNT</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <div class="input-group">
                    
                    {!! Form::select(
                        'document_id[]', 
                        [''=>'']+App\MasterDocument::where('type', 'payable')->pluck('name','id')->all(),
                        old('document_id'), 
                        ['class'=>'form-control input-sm options_doc','id'=>'','required']) 
                    !!}

                    <span class="input-group-btn"><button class="btn btn-primary btn-sm add-charge" type="button"><i class="fa fa-plus"></i></button></span>
                </div>
                <div class="error">{!! $errors->first('document_id') !!}</div>
            </div>
            <div class="col-sm-3">
                
                {!! Form::select(
                    'vendor_id[]', 
                    [''=>'']+App\MasterVendor::pluck('name','id')->all(),
                    old('vendor_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'','required']) 
                !!}
            </div>
            <div class="col-sm-1">
                
                {!! Form::text('quantity[]',old('quantity'),['class'=>'form-control input-sm text-big','placeholder'=>'Quantity','required']) !!}

                <label class="x-mark">X</label>
            </div>
            <div class="col-sm-2">
                
                {!! Form::select(
                    'unit_id[]', 
                    [''=>'']+App\MasterUnit::pluck('name','id')->all(),
                    old('unit_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'']) 
                !!}

            </div>
            <div class="col-sm-1">
                {!! Form::select('currency[]', ['1'=>'IDR','2'=>'USD'], '2', ['class'=>'form-control input-sm','disabled'=>'true']) !!}
            </div>
            <div class="col-sm-2">
                @if(Auth::user()->role == 'operation')
                    {!! Form::hidden('pay_price[]', null) !!}
                    {!! Form::text('pay_price[]','-', ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'Amount','disabled'=>'true']) !!}
                @else
                    {!! Form::text('pay_price[]',old('pay_price'), ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'Amount','disabled'=>'false']) !!}
                @endif
            </div>   
        </div>
    @elseif(Request::path() == 'operation/jobsheet/'.$jobsheet->id.'/edit')
        @if(count($payables) > 0)
            <div class="clearfix">
                <div class="row">
                <label class="col-sm-3">DETAIL OF CHARGES</label>
                <label class="col-sm-3">VENDOR</label>
                <label class="col-sm-1">QTY</label>
                <label class="col-sm-2">UNIT</label>
                <label class="col-sm-1">CURR</label>
                <label class="col-sm-2">AMOUNT</label>
                </div>
            </div>
            @foreach($payables as $payable)
                <div class="form-group">
                    
                    {!! Form::hidden('payable_id[]', $payable->id) !!}
                    
                    <div class="col-sm-3">
                        <div class="input-group">
                            <!-- <select name="document_id[]" class="form-control input-sm options_doc" id="pay_doc">
                                <option value=""></option>
                                <option value="{{ $payable->document->id }}">{{ $payable->document->name }}</option>
                                @php
                                    $doc = App\MasterDocument::where('type','payable')->get();
                                @endphp
                                @foreach($doc as $do)
                                    <option value="{{ $do->id }}">{{ $do->name }}</option>
                                @endforeach
                            </select> -->

                            {!! Form::select(
                                'document_id[]', 
                                [''=>'']+App\MasterDocument::where('type', 'payable')->pluck('name','id')->all(),
                                $payable->document->id, 
                                ['class'=>'form-control input-sm options_doc','id'=>'pay_doc']) 
                            !!}

                            <span class="input-group-btn"><button class="btn btn-danger btn-sm empty-charge" type="button"><i class="fa fa-minus"></i></button></span>
                            <span class="input-group-btn"><button class="btn btn-primary btn-sm add-charge" type="button"><i class="fa fa-plus"></i></button></span>

                        </div>
                        <div class="error">{!! $errors->first('doc_error') !!}</div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::select(
                            'vendor_id[]', 
                            [''=>'']+App\MasterVendor::pluck('name','id')->all(),
                            $payable->vendor->id, 
                            ['class'=>'form-control input-sm options_doc','id'=>'vdr']) 
                        !!}
                    </div>
                    <div class="col-sm-1">
                        {!! Form::text('quantity[]',$payable->quantity,['class'=>'form-control input-sm text-big','placeholder'=>'Quantity', 'id'=>'qty']) !!}
                        <label class="x-mark">X</label>
                    </div>
                    <div class="col-sm-2">
                        {!! Form::select(
                            'unit_id[]', 
                            [''=>'']+App\MasterUnit::pluck('name','id')->all(),
                            isset($payable->unit->id) ? $payable->unit->id:'', 
                            ['class'=>'form-control input-sm options_doc','id'=>'unt']) 
                        !!}
                    </div>
                    <div class="col-sm-1">
                        {!! Form::select('pay_currency[]', ['1'=>'IDR','2'=>'USD'], '2', ['class'=>'form-control input-sm','disabled'=>'true']) !!}
                    </div>
                    <div class="col-sm-2">
                        @if(Auth::user()->role == 'operation')
                            {!! Form::hidden('pay_price[]', $payable->price) !!}
                            {!! Form::text('pay_price[]','-', ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'Amount','disabled'=>'true']) !!}
                        @elseif(Auth::user()->role == 'pricing')
                            {!! Form::text('pay_price[]',$payable->price, ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'Amount','disabled'=>'false']) !!}
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="clearfix">
                <div class="row">
                    <label class="col-sm-3">DETAIL OF CHARGES</label>
                    <label class="col-sm-3">VENDOR</label>
                    <label class="col-sm-1">QTY</label>
                    <label class="col-sm-2">UNIT</label>
                    <label class="col-sm-1">CURR</label>
                    <label class="col-sm-2">AMOUNT</label>
                </div>
            </div>
            <div class="form-group">

                {!! Form::hidden('payable_id[]', 0) !!}

                <div class="col-sm-3">
                    <div class="input-group">
                        
                        {!! Form::select(
                            'document_id[]', 
                            [''=>'']+App\MasterDocument::where('type', 'payable')->pluck('name','id')->all(),
                            old('document_id'), 
                            ['class'=>'form-control input-sm options_doc','id'=>'','required']) 
                        !!}

                        <span class="input-group-btn"><button class="btn btn-primary btn-sm add-charge" type="button"><i class="fa fa-plus"></i></button></span>
                    </div>
                    <div class="error">{!! $errors->first('document_id') !!}</div>
                </div>
                <div class="col-sm-3">
                    
                    {!! Form::select(
                        'vendor_id[]', 
                        [''=>'']+App\MasterVendor::pluck('name','id')->all(),
                        old('vendor_id'), 
                        ['class'=>'form-control input-sm options_doc','id'=>'','required']) 
                    !!}
                </div>
                <div class="col-sm-1">
                    
                    {!! Form::text('quantity[]',old('quantity'),['class'=>'form-control input-sm text-big','placeholder'=>'Quantity','required']) !!}

                    <label class="x-mark">X</label>
                </div>
                <div class="col-sm-2">
                    
                    {!! Form::select(
                        'unit_id[]', 
                        [''=>'']+App\MasterUnit::pluck('name','id')->all(),
                        old('unit_id'), 
                        ['class'=>'form-control input-sm options_doc','id'=>'']) 
                    !!}

                </div>
                <div class="col-sm-1">
                    {!! Form::select('pay_currency[]', ['1'=>'IDR','2'=>'USD',], '2', ['class'=>'form-control input-sm','disabled'=>'true']) !!}
                </div>
                <div class="col-sm-2">
                    @if(Auth::user()->role == 'operation')
                        {!! Form::hidden('pay_price[]', null) !!}
                        {!! Form::text('pay_price[]','-', ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'Amount','disabled'=>'true']) !!}
                    @else
                        {!! Form::text('pay_price[]',old('pay_price'), ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'Amount','disabled'=>'false']) !!}
                    @endif
                </div>   
            </div>
        @endif
    @endif
@elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'admin')
    @if(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/create')
        <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">
            <div class="row charge-wrap">
                <div class="col-sm-12 charge-group">
                    <div class="clearfix">
                        <div class="row">
                        <label class="col-sm-3">DETAIL OF CHARGES</label>
                        <label class="col-sm-2">VENDOR</label>
                        <label class="col-sm-1">QTY</label>
                        <label class="col-sm-1">UNIT</label>
                        <label class="col-sm-1">CURR</label>
                        <label class="col-sm-2">AMOUNT</label>
                        <label class="col-sm-2">TOTAL</label>
                        </div>
                    </div>
                    @foreach($payables as $payable)
                        <div class="form-group ">
                            <input type="hidden" name="user_id[]" value="{{ $payable->user_id }}">
                            <input type="hidden" name="payable_id[]" value="{{ $payable->id }}">

                            <div class="col-sm-3 no-padding-right">
                                <div class="input-group">
                                    {!! Form::select('document_id[]', [''=>'']+App\MasterDocument::pluck('name','id')->all(), $payable->document->id, ['class'=>'form-control input-sm','id'=>'']) !!}
                                    <span class="input-group-btn"><button class="btn btn-primary btn-sm add-charge" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2 no-padding-right">
                                {!! Form::select('vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(), $payable->vendor->id, ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::text('quantity[]',$payable->quantity,['class'=>'form-control input-sm qty','placeholder'=>'Qty']) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1">
                                {!! Form::select('unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(), isset($payable->unit->id)?$payable->unit->id:'0', ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::select('currency[]', ['1'=>'IDR','2'=>'USD',], $payable->currency, ['class'=>'form-control input-sm currency']) !!}
                            </div>
                            <div class="col-sm-2 no-padding-left no-padding-right">
                                {!! Form::text('price[]', isset($payable->price) ? number_format((double)$payable->price) : null, ['class'=>'form-control input-sm text-right text-money ammount','placeholder'=>'Amount','required'=>'true']) !!}

                            </div>
                            <div class="col-sm-2 text-right">
                                @php
                                    $total = $payable->quantity * $payable->price;
                                @endphp
                                <input type="text" class="form-control input-sm text-right subtotal" id="email" value="{{ number_format($total) }}" readonly param="1">
                            </div>
                        </div>
                    @endforeach
                        
                </div>
            </div>
            <hr>
        </div>
    @endif
@elseif(Auth::user()->role == 'payable' || Auth::user()->role == 'admin')
    @if(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/edit')
        <div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active" id="tabcharges{{ $jobsheet->id }}">
            <div class="row charge-wrap">
                <div class="col-sm-12 charge-group">
                    <div class="clearfix">
                        <div class="row">
                        <label class="col-sm-3">DETAIL OF CHARGES</label>
                        <label class="col-sm-2">VENDOR</label>
                        <label class="col-sm-1">QTY</label>
                        <label class="col-sm-1">UNIT</label>
                        <label class="col-sm-1">CURR</label>
                        <label class="col-sm-2">AMOUNT</label>
                        <label class="col-sm-2">TOTAL</label>
                        </div>
                    </div>
                    @foreach($payables as $payable)
                        <div class="form-group ">
                            <input type="hidden" name="user_id[]" value="{{ $payable->user_id }}">
                            <input type="hidden" name="payable_id[]" value="{{ $payable->id }}">

                            <div class="col-sm-3 no-padding-right">
                                <div class="input-group">
                                    {!! Form::select('document_id[]', [''=>'']+App\MasterDocument::pluck('name','id')->all(), $payable->document->id, ['class'=>'form-control input-sm','id'=>'']) !!}
                                    <span class="input-group-btn"><button class="btn btn-primary btn-sm add-charge" type="button"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <div class="col-sm-2 no-padding-right">
                                {!! Form::select('vendor_id[]', [''=>'']+App\MasterVendor::pluck('name','id')->all(), $payable->vendor->id, ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::text('quantity[]',$payable->quantity,['class'=>'form-control input-sm qty','placeholder'=>'Qty']) !!}
                                <label class="x-mark">X</label>
                            </div>
                            <div class="col-sm-1">
                                {!! Form::select('unit_id[]', [''=>'']+App\MasterUnit::pluck('name','id')->all(), isset($payable->unit->id)?$payable->unit->id:'0', ['class'=>'form-control input-sm','id'=>'']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::select('currency[]', ['1'=>'IDR','2'=>'USD',], $payable->currency, ['class'=>'form-control input-sm currency']) !!}
                            </div>
                            <div class="col-sm-2 no-padding-left no-padding-right">
                                {!! Form::text('price[]', number_format((double)$payable->price), ['class'=>'form-control input-sm text-right text-money ammount','placeholder'=>'Amount','required'=>'true']) !!}

                            </div>
                            <div class="col-sm-2 text-right">
                                @php
                                    $total = $payable->quantity * $payable->price;
                                @endphp
                                <input type="text" class="form-control input-sm text-right subtotal" id="email" value="{{ number_format($total) }}" readonly param="1">
                            </div>
                        </div>
                    @endforeach
                        
                </div>
            </div>
            <hr>
        </div>
    @endif
@endif