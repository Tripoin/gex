<div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Cabang:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('cabang', null, ['class'=>'form-control']) !!}
        {!! $errors->first('cabang', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Account:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('account', null, ['class'=>'form-control']) !!}
        {!! $errors->first('account', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Account:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('atas_nama', 'PT. GLOBALINDO EXPRESS CARGO', ['class'=>'form-control']) !!}
        {!! $errors->first('atas_nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Address:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('address', null, ['class'=>'form-control']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Swift Code:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('swiftcode', null, ['class'=>'form-control']) !!}
        {!! $errors->first('swiftcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Remark:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('remarks', null, ['class'=>'form-control']) !!}
        {!! $errors->first('remarks', '<p class="help-block">:message</p>') !!}
    </div>
</div>