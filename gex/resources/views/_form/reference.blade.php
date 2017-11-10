@if(Request::path() != 'operation/jobsheet/uncreated')
    @if(count($references) > 0)
        @foreach($references as $reference)
            
            {!! Form::hidden('reference_id[]', $reference->id) !!}
            {!! Form::hidden('jobsheet_id[]', $jobsheet->id) !!}

            <div class="form-group">
                <div class="col-sm-4 form-group-body">
                    <div class="input-group">

                        {!! Form::select(
                            'ref_document_id[]', 
                            [''=>'']+App\MasterDocument::where('type', null)->pluck('name','id')->all(),
                            $reference->document_id, 
                            ['class'=>'form-control input-sm options_doc','id'=>'document_id']) 
                        !!}

                        <span class="input-group-btn"><button class="btn btn-primary btn-sm add-doc" type="button"><i class="fa fa-plus"></i></button></span>

                        <div class="error">{!! $errors->first('ref_document_id') !!}</div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="input-group">
                        {!! Form::text('ref_no[]',$reference->ref_no,['class'=>'form-control input-sm text-big','placeholder'=>'References Number','id'=>'ref_no']) !!}

                        <span class="input-group-btn"><button class="btn btn-danger btn-sm empty-doc" type="button"><i class="fa fa-minus"></i></button></span>

                        <div class="error">{!! $errors->first('ref_no') !!}</div>
                    </div>
                </div>
            </div>
            
        @endforeach
    @else
        <div class="form-group">
            <div class="col-sm-4 form-group-body">
                <div class="input-group">
                    
                    {!! Form::select(
                        'ref_document_id[]', 
                        [''=>'']+App\MasterDocument::where('type', null)->pluck('name','id')->all(),
                        old('document_id[]'), 
                        ['class'=>'form-control input-sm options_doc','id'=>'document_id']) 
                    !!}

                    <span class="input-group-btn"><button class="btn btn-primary btn-sm add-doc" type="button"><i class="fa fa-plus"></i></button></span>

                    <div class="error">{!! $errors->first('document_id') !!}</div>
                </div>
            </div>
            <div class="col-sm-8">
                
                {!! Form::text('ref_no[]',old('ref_no[]'),['class'=>'form-control input-sm text-big','placeholder'=>'References Number']) !!}

                <div class="error">{!! $errors->first('ref_no') !!}</div>
            </div>
        </div>
    @endif
@else
    <div class="form-group">
        <div class="col-sm-4 form-group-body">
            <div class="input-group">
                
                {!! Form::select(
                    'ref_document_id[]', 
                    [''=>'']+App\MasterDocument::where('type', null)->pluck('name','id')->all(),
                    null, 
                    ['class'=>'form-control input-sm options_doc','id'=>'document_id']) 
                !!}

                <span class="input-group-btn"><button class="btn btn-primary btn-sm add-doc" type="button"><i class="fa fa-plus"></i></button></span>

                <div class="error">{!! $errors->first('ref_document_id') !!}</div>
            </div>
        </div>
        <div class="col-sm-8">
            
            {!! Form::text('ref_no[]',null,['class'=>'form-control input-sm text-big','placeholder'=>'References Number']) !!}

            <div class="error">{!! $errors->first('ref_no') !!}</div>
        </div>
    </div>
@endif