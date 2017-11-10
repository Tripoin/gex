<div class="row">
    <div class="col-md-12">
    <input type="hidden" name="status" value="uncompleted">
    <div class="col-md-4">
        <div class="form-group @if($errors->first('customer_id')) has-error @endif ">
            <label class="control-label col-sm-4">CUSTOMER</label>
            <div class="col-sm-8">
               
                {!! Form::select(
                    'customer_id', 
                    [''=>'']+App\MasterCustomer::pluck('name','id')->all(),
                    old('customer_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'customers','required']) 
                !!}

                <!-- <select class="form-control input-sm options_doc text-big" 
                        name="customer_id" 
                        required="true" 
                        id="customers" form="filter">
                    @foreach(App\MasterCustomer::all() as $customer)
                        <option value="{{ $customer->id }}">{{ strtoupper($customer->name) }}</option>
                    @endforeach
                </select> -->

                <div class="error">{!! $errors->first('customer_id') !!}</div>
            </div>
        </div>
        <div class="form-group @if($errors->first('date')) has-error @endif" style="margin-top: 10px;">
            <label class="control-label col-sm-4">DATE RATE</label>
            <div class="col-sm-8">

                {!! Form::date('date_rate',old('$date_rate', date('d-m-Y')),['class'=>'form-control input-sm datepicker1 text-big','placeholder'=>'Enter Date','form'=>'filter', 'required']) !!}

                <div class="error">{!! $errors->first('date_rate') !!}</div>
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="control-label col-sm-4">REFF NO</label>
            <div class="col-sm-8">
                
                {!! Form::text('ref_no',old('ref_no'),['class'=>'form-control input-sm',
                'placeholder'=>'NOMER REFERENSI']) !!}

                <div class="error">{!! $errors->first('vessel') !!}</div>
            </div>
        </div> -->
    </div>
    <div class="col-md-4">
        <div class="form-group @if($errors->first('date')) has-error @endif">
            <label class="control-label col-sm-4">PAYMENT BANK</label>
            <div class="col-sm-8">

                {!! Form::select(
                    'payment_bank', 
                    [''=>'']+App\MasterBank::pluck('name','id')->all(),
                    old('payment_bank'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'bank','required']) 
                !!}

                <!-- <select class="form-control input-sm options_doc text-big" 
                        name="bank_id" id="bank" required>
                    @foreach(App\MasterBank::all() as $bank)
                        <option value="{{ $bank->id }}">{{ strtoupper($bank->name) }}</option>
                    @endforeach
                </select> -->

                <div class="error">{!! $errors->first('payment_bank') !!}</div>
            </div>
        </div>
        <div class="form-group @if($errors->first('date')) has-error @endif" style="margin-top: 10px;">
            <label class="control-label col-sm-4">CURRENCY</label>
            <div class="col-sm-8">

                {!! Form::radio('currency', '2',['class'=>'form-control input-sm','form'=>'store','required'=>'true']) !!} USD 
                {!! Form::radio('currency', '1',['class'=>'form-control input-sm','form'=>'store','required'=>'true']) !!} IDR

                <div class="error">{!! $errors->first('currency') !!}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-sm btn-block" form="filter">FILTER</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- <div class="row">
    <div class="col-md-12">
        hahahah
    </div>
</div> -->