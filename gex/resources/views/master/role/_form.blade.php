<div class="form-group">
    <label class="control-label col-sm-2" for="name">Role Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('name', old('name'), ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Description:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('description', null, ['class'=>'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>