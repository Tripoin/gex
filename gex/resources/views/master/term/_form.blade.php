
<div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Type:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('type', null, ['class'=>'form-control']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Days:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('days', null, ['class'=>'form-control']) !!}
        {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
    </div>
</div>