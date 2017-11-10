<div class="row">
    <div class="col-md-12">
        <div class="well" style="font-size: 15px;">
            <strong>Warning!</strong> {{ $revision['note'] }}.
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group @if($errors->first('customer')) has-error @endif ">
            <label class="control-label col-sm-4">CUSTOMER</label>
            <div class="col-sm-8">
               
                {!! Form::select(
                    'customer_id', 
                    [''=>'']+App\MasterCustomer::pluck('name','id')->all(),
                    old('customer_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'customers']) 
                !!}

                <div class="error">{!! $errors->first('customer') !!}</div>
            </div>
        </div>

        <div class="form-group @if($errors->first('poo')) has-error @endif">
            <label class="control-label col-sm-4">ORIGIN</label>
            <div class="col-sm-8">

                {!! Form::select(
                    'poo_id', 
                    [''=>'']+App\MasterPort::pluck('city','id')->all(),
                    old('poo_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'poo']) 
                !!}

                <div class="error">{!! $errors->first('poo') !!}</div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">DESTINATION</label>
            <div class="col-sm-8">

                {!! Form::select(
                    'pod_id', 
                    [''=>'']+App\MasterPort::pluck('city','id')->all(),
                    old('pod_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'pod']) 
                !!}

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">FREIGHT TYPE</label>
            <div class="col-sm-8">

                {!! Form::select(
                    'freight_type', [
                        '1'=>'COLLECT',
                        '2'=>'PREPAID',
                    ],old('freight_type'), ['class'=>'form-control input-sm options_doc','id'=>'freight_type']) 
                !!}

                <div class="error">{!! $errors->first('freight_type') !!}</div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">VESSEL</label>
            <div class="col-sm-8">
                
                {!! Form::text('vessel',old('vessel'),['class'=>'form-control input-sm','placeholder'=>'Vessel']) !!}

            </div>
        </div>
        <div class="form-group partymeas @if($errors->first('partymeas') || $errors->first('partymeas_unit')) has-error @endif">
            <label class="control-label col-sm-4">PARTY/MEAS</label>
            <div class="col-sm-8 clearfix">
                
                {!! Form::text('partymeas',old('partymeas'),['class'=>'form-control input-sm text-big text-number','placeholder'=>'Amount','required']) !!}
                
                <span class="partymeas-addon">X</span>
                
                {!! Form::select(
                    'partymeas_unit', 
                    [''=>'']+App\MasterUnit::pluck('name','id')->all(),
                    old('partymeas_unit'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'partymeas_unit']) 
                !!}

                {{-- msh butuh dirapihin --}}
                <div class="error">{!! $errors->first('partymeas').' '.$errors->first('partymeas_unit') !!}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group @if($errors->first('marketing')) has-error @endif">
            <label class="control-label col-sm-4">MARKETING</label>
            <div class="col-sm-8">

                {!! Form::select(
                    'marketing_id', 
                    [''=>'']+App\User::where('role','marketing')->pluck('name','id')->all(),
                    old('marketing_id'), 
                    ['class'=>'form-control input-sm options_doc','id'=>'marketing']) 
                !!}

                <div class="error">{!! $errors->first('marketing_id') !!}</div>
            </div>
        </div>
        <div class="form-group @if($errors->first('description')) has-error @endif">
            <label class="control-label col-sm-4">DESCRIPTION</label>
            <div class="col-sm-8">
                
                {!! Form::text('description',old('description'),['class'=>'form-control input-sm','placeholder'=>'Enter Description Of Goods','size'=>'20x3','required']) !!}

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">REMARKS</label>
            <div class="col-sm-8">

                {!! Form::textarea('remarks',old('remarks'),['class'=>'form-control input-sm','placeholder'=>'Enter Remarks','size'=>'20x3']) !!}
                
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">INSTRUCTION</label>
            <div class="col-sm-8">

                {!! Form::textarea('instruction',old('instruction'),['class'=>'form-control input-sm','placeholder'=>'Enter Instruction','size'=>'20x3']) !!}

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group @if($errors->first('date')) has-error @endif">
            <label class="control-label col-sm-4">DATE</label>
            <div class="col-sm-8">

                @if(Request::path() != 'jobsheet/operation/uncreated')
                    {!! Form::text('tanggal',date('d-m-Y', strtotime($jobsheet->date)),['class'=>'form-control input-sm datepicker1 text-big','placeholder'=>'Enter Date']) !!}
                @else
                    {!! Form::text('tanggal',date('d-m-Y'),['class'=>'form-control input-sm datepicker1 text-big','placeholder'=>'Enter Date']) !!}
                @endif

                <div class="error">{!! $errors->first('date') !!}</div>
            </div>
        </div>

        
        <div class="form-group @if($errors->first('etd')) has-error @endif">
            <label class="control-label col-sm-4">ETD</label>
            <div class="col-sm-8">
                
                @if(Request::path() != 'jobsheet/operation/uncreated')
                    {!! Form::text('etd',date('d-m-Y', strtotime($jobsheet->etd)),['class'=>'form-control input-sm datepicker2 text-big','placeholder'=>'Estimated Time Of Departure','required']) !!}
                @else
                    {!! Form::text('etd',old('etd'),['class'=>'form-control input-sm datepicker2 text-big','placeholder'=>'Estimated Time Of Departure','required']) !!}
                @endif

                <div class="error">{!! $errors->first('etd') !!}</div>
            </div>
        </div>

        <div class="form-group @if($errors->first('eta')) has-error @endif">
            <label class="control-label col-sm-4">ETA</label>
            <div class="col-sm-8">
                
                @if(Request::path() != 'jobsheet/operation/uncreated')
                    {!! Form::text('eta',date('d-m-Y', strtotime($jobsheet->eta)),['class'=>'form-control input-sm datepicker2 text-big','placeholder'=>'Estimated Time Of Arrival','required']) !!}
                @else
                    {!! Form::text('eta',old('eta'),['class'=>'form-control input-sm datepicker2 text-big','placeholder'=>'Estimated Time Of Arrival','required']) !!}
                @endif
                
                <div class="error">{!! $errors->first('eta') !!}</div>
            </div>
        </div>
        <div class="document-group">

            @include('jobsheet.operation._formReference')
            
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 charge-wrapper">
        <div class="charge-group">
            
            @include('jobsheet.operation._formPayable')

        </div>
    </div>
</div>