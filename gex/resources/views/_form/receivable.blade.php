<div role="tabpanel" class="tab-pane no-padding-left no-padding-right no-padding-bottom active term-charge" id="tabcharges{{ $jobsheet->id }}">

@php $index = 0; @endphp

@if(Auth::user()->role == 'marketing' || Auth::user()->role == 'admin')
    @if(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/create')
        <div class="row terms-group" index="{{ $index }}">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::hidden('rec_marketing_id[]', 0) !!}
                    <div class="col-sm-3">
                        <label>TERMS OF PAYMENT</label>
                        {!! Form::select('rec_term_id[]', [''=>'']+App\MasterTerm::pluck('name','id')->all(),old('rec_term_id'), ['class'=>'form-control input-sm term', 'id'=>'rec_terms','required']) !!}
                        
                    </div>
                    <div class="col-sm-3">
                        <label>BILL TO</label>
                        {!! Form::select('rec_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),old('rec_customer_id'), ['class'=>'form-control input-sm', 'id'=>'','required']) !!}
                    </div>
                    <div class="col-sm-6 text-right">
                        <label></label>
                        <div>
                            <button class="btn btn-sm btn-primary add-terms" type="button"><i class="fa fa-plus fa-fw"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row terms-group" index="{{ $index }}">
            <div class="col-sm-12 charge-group">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>DETAIL</label>
                    </div>
                    <div class="col-sm-2">
                        <label>CHARGE</label>
                    </div>
                    <div class="col-sm-1">
                        <label>TAX</label>
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
                    <div class="col-sm-2 text-right">
                        <label class="text-right">SUB TOTAL</label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::hidden('rec_id[0][]', 0) !!}
                    <div class="col-sm-3">
                        <div class="input-group">
                            {!! Form::select('rec_document_id[0][]', [''=>'']+App\MasterDocument::where('type','payable')->pluck('name','id')->all(),null, ['class'=>'form-control input-sm document', 'id'=>'','required']) !!}
                            <span class="input-group-btn"><button class="btn btn-sm btn-primary add-charge" type="button"><i class="fa fa-plus"></i></button></span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        {!! Form::select('rec_charge_type[][]', [
                            '1'=>'CHARGES',
                            '2'=>'FREIGHT CHARGES',
                            '3'=>'FREIGHT CHARGES - COLLECT',
                        ],null, ['class'=>'form-control input-sm term','required']) !!}
                    </div>
                    <div class="col-sm-1">
                        {!! Form::select('rec_tax[][]', [
                            '1'=>'PPN1',
                            '2'=>'PPN2',
                            '3'=>'NON PPN',
                        ],null, ['class'=>'form-control input-sm tax','id'=>'rec_tax','required']) !!}
                    </div>
                    <div class="col-sm-1">
                        {!! Form::text('rec_quantity[][]',null, [
                            'class'=>'form-control input-sm qty',
                            'placeholder'=>'Qty','required'
                        ]) !!}
                        <label class="x-mark">X</label>
                    </div>
                    <div class="col-sm-1 no-padding-right">
                        {!! Form::select('rec_unit_id[][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),null, ['class'=>'form-control input-sm unit']) !!}
                    </div>
                    <div class="col-sm-1">
                        {!! Form::select('rec_currency[][]', [
                            '1'=>'IDR',
                            '2'=>'USD',
                        ],null, ['class'=>'form-control input-sm currency','required']) !!}
                    </div>
                    <div class="col-sm-1 no-padding-left no-padding-right">
                        {!! Form::text('rec_price[][]',null, [
                            'class'=>'form-control input-sm ammount',
                            'placeholder'=>'Amount','required'
                        ]) !!}
                    </div>
                    <div class="col-sm-2 text-right">
                        <input type="text" class="form-control input-sm text-right subtotal" id="email" value="00.00" readonly param="1">
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @elseif(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/edit')
        @if($receivables->count() > 0)
            @foreach($receivables->unique('rec_marketing_id') as $rec)

                {!! Form::hidden('rec_marketing_id[]', $rec->rec_marketing_id) !!}

                <div class="row terms-group" index="{{ $index }}">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label>TERMS OF PAYMENT</label>
                                {!! Form::select('rec_term_id['.$index.']', [''=>'']+App\MasterTerm::pluck('name','id')->all(),$rec->rec_marketing->term_id, ['class'=>'form-control input-sm term', 'id'=>'rec_terms']) !!}
                                
                            </div>
                            <div class="col-sm-3">
                                <label>BILL TO</label>
                                {!! Form::select('rec_customer_id['.$index.']', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),$rec->rec_marketing->customer_id, ['class'=>'form-control input-sm', 'id'=>'rec_bill']) !!}
                            </div>
                            <div class="col-sm-6 text-right">
                                <label></label>
                                <div>
                                    <button class="btn btn-sm btn-danger empty-terms" type="button"><i class="fa fa-minus fa-fw"></i></button>
                                    <button class="btn btn-sm btn-primary add-terms" type="button"><i class="fa fa-plus fa-fw"></i></button>
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
                                <label>TAX</label>
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
                            <div class="col-sm-2 text-right">
                                <label class="text-right">SUB TOTAL</label>
                            </div>
                        </div>
                        
                        @foreach($receivables->where('rec_marketing_id', $rec->rec_marketing->id) as $doc)
                                
                            {!! Form::hidden('rec_id['.$index.'][]', $doc->id) !!}
                            
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        {!! Form::select('rec_document_id['.$index.'][]', [''=>'']+App\MasterDocument::where('type','payable')->pluck('name','id')->all(),$doc->rec_document_id, ['class'=>'form-control input-sm document','id'=>'rec_documents']) !!}
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-danger empty-charge" type="button"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-sm btn-primary add-charge" type="button"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('rec_charge_type['.$index.'][]', [
                                        '1'=>'CHARGES',
                                        '2'=>'FREIGHT CHARGES',
                                        '3'=>'FREIGHT CHARGES - COLLECT'
                                    ],$doc->rec_charge_type, ['class'=>'form-control input-sm term', 'id'=>'rec_charge']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rec_tax['.$index.'][]', [
                                        '1'=>'PPN1',
                                        '2'=>'PPN2',
                                        '3'=>'NON PPN'
                                    ],$doc->rec_tax, ['class'=>'form-control input-sm term', 'id'=>'rec_tax']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::text('rec_quantity['.$index.'][]',$doc->rec_quantity, [
                                        'class'=>'form-control input-sm qty',
                                        'placeholder'=>'Qty', 'id'=>'rec_qty'
                                    ]) !!}
                                    <label class="x-mark">X</label>
                                </div>
                                <div class="col-sm-1 no-padding-right">
                                    {!! Form::select('rec_unit_id['.$index.'][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),$doc->rec_unit_id, ['class'=>'form-control input-sm unit', 'id'=>'rec_unit']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('rec_currency['.$index.'][]', [
                                        '1'=>'IDR',
                                        '2'=>'USD',
                                    ],$doc->rec_currency, ['class'=>'form-control input-sm currency', 'id'=>'rec_curr']) !!}
                                </div>
                                <div class="col-sm-1 no-padding-left no-padding-right">
                                    {!! Form::text('rec_price['.$index.'][]',number_format($doc->rec_price), [
                                        'class'=>'form-control input-sm ammount',
                                        'placeholder'=>'Amount', 'id'=>'rec_price'
                                    ]) !!}
                                </div>
                                <div class="col-sm-2 text-right">
                                    @php
                                        $total = $doc->rec_quantity * $doc->rec_price;
                                    @endphp
                                    <input type="text" class="form-control input-sm text-right subtotal" value="{{ number_format($total) }}" id="rec_total" readonly param="1">
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div><!-- <br>
                <div class="row terms-group" index="{{ $index }}">
                </div><hr> -->

                <?php $index++; ?>
            @endforeach
        @else
            <div class="row terms-group" index="{{ $index }}">
                <div class="col-sm-12">
                    <div class="form-group">
                        
                        {!! Form::hidden('rec_marketing_id[]', 0) !!}
                        
                        <div class="col-sm-3">
                            <label>TERMS OF PAYMENT</label>
                            {!! Form::select('rec_term_id[]', [''=>'']+App\MasterTerm::pluck('name','id')->all(),old('rec_term_id'), ['class'=>'form-control input-sm term', 'id'=>'rec_terms','required']) !!}
                            
                        </div>
                        <div class="col-sm-3">
                            <label>BILL TO</label>
                            {!! Form::select('rec_customer_id[]', [''=>'']+App\MasterCustomer::pluck('name','id')->all(),old('rec_customer_id'), ['class'=>'form-control input-sm', 'id'=>'','required']) !!}
                        </div>
                        <div class="col-sm-6 text-right">
                            <label></label>
                            <div>
                                <button class="btn btn-sm btn-primary add-terms" type="button"><i class="fa fa-plus fa-fw"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row terms-group" index="{{ $index }}">
                <div class="col-sm-12 charge-group">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>DETAIL</label>
                        </div>
                        <div class="col-sm-2">
                            <label>CHARGE</label>
                        </div>
                        <div class="col-sm-1">
                            <label>TAX</label>
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
                        <div class="col-sm-2 text-right">
                            <label class="text-right">SUB TOTAL</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                            
                        {!! Form::hidden('rec_id['.$index.'][]', 0) !!}
                        
                        <div class="col-sm-3">
                            <div class="input-group">
                                {!! Form::select('rec_document_id['.$index.'][]', [''=>'']+App\MasterDocument::where('type','payable')->pluck('name','id')->all(),old('rec_document_id'), ['class'=>'form-control input-sm document','id'=>'rem_rec_doc rec_documents'.$index]) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-primary add-charge" type="button"><i class="fa fa-plus"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            {!! Form::select('rec_charge_type['.$index.'][]', [
                                '1'=>'CHARGES',
                                '2'=>'FREIGHT CHARGES',
                                '3'=>'FREIGHT CHARGES - COLLECT'
                            ],old('rec_charge_type'), ['class'=>'form-control input-sm term']) !!}
                        </div>
                        <div class="col-sm-1">
                            {!! Form::select('rec_tax['.$index.'][]', [
                                '1'=>'PPN1',
                                '2'=>'PPN2',
                                '3'=>'NON PPN'
                            ],old('rec_tax'), ['class'=>'form-control input-sm term']) !!}
                        </div>
                        <div class="col-sm-1">
                            {!! Form::text('rec_quantity['.$index.'][]',old('rec_quantity'), [
                                'class'=>'form-control input-sm qty',
                                'placeholder'=>'Qty'
                            ]) !!}
                            <label class="x-mark">X</label>
                        </div>
                        <div class="col-sm-1 no-padding-right">
                            {!! Form::select('rec_unit_id['.$index.'][]', [''=>'']+App\MasterUnit::pluck('name','id')->all(),old('rec_unit_id'), ['class'=>'form-control input-sm unit']) !!}
                        </div>
                        <div class="col-sm-1">
                            {!! Form::select('rec_currency['.$index.'][]', [
                                '1'=>'IDR',
                                '2'=>'USD',
                            ],old('rec_currency'), ['class'=>'form-control input-sm currency']) !!}
                        </div>
                        <div class="col-sm-1 no-padding-left no-padding-right">
                            {!! Form::text('rec_price['.$index.'][]',old('rec_price'), [
                                'class'=>'form-control input-sm ammount',
                                'placeholder'=>'Amount'
                            ]) !!}
                        </div>
                        <div class="col-sm-2 text-right">
                            <input type="text" class="form-control input-sm text-right subtotal" id="email" value="00.00" readonly param="1">
                        </div>
                    </div>
                </div>
            </div><hr>
        @endif
    @endif
@elseif(Auth::user()->role == 'invoice' || Auth::user()->role == 'admin')
@endif
    <hr>
    <div class="row total-group">
        <!-- <div class="col-md-4 col-md-offset-8">
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
        </div> -->
    </div>
</div>