<!-- <div class="form-group">
    <label class="control-label col-sm-2" for="id">ID:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="id_show" value="" >
    </div>
</div> -->
<div class="form-group">
    <label class="control-label col-sm-2" for="code">Date:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="code_show" value="" > -->
        {!! Form::date('date', null, ['class'=>'form-control']) !!}
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="name">Rate:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('rate', null, ['class'=>'form-control']) !!}
        {!! $errors->first('rate', '<p class="help-block">:message</p>') !!}
    </div>
</div>