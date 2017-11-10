{!! Form::open(['url' => route('receivable.profit.index'), 'method' => 'post','class'=>'form-horizontal','id'=>'filter']) !!}
    {{ csrf_field() }}
    
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="status" value="uncompleted">
            <div class="col-md-3">
                
                <div class="form-group @if($errors->first('date')) has-error @endif">
                    <div class="col-sm-12">

                        <label class="control-label">FROM DATE</label>
                        {!! Form::text('from_date',Carbon\Carbon::today()->subMonth()->format('d-m-Y'),['class'=>'form-control input-sm datepicker1 text-big','placeholder'=>'Enter Date','form'=>'filter', 'required']) !!}

                        <div class="error">{!! $errors->first('from_date') !!}</div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group @if($errors->first('date')) has-error @endif">
                    <div class="col-sm-12">

                        <label class="control-label">TO DATE</label>
                        {!! Form::text('to_date',Carbon\Carbon::today()->format('d-m-Y'),['class'=>'form-control input-sm datepicker1 text-big','placeholder'=>'Enter Date']) !!}

                        <div class="error">{!! $errors->first('to_date') !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label">-------------------------------------------------------------------</label>
                        <button type="submit" class="btn btn-primary btn-sm btn-block" form="filter">FILTER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

{!! Form::close() !!}