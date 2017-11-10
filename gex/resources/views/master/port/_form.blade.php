<!-- <div class="form-group">
    <label class="control-label col-sm-2" for="id">ID:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="id_show" value="" >
    </div>
</div> -->
<!-- <div class="form-group">
    <label class="control-label col-sm-2" for="code">Code:</label>
    <div class="col-sm-10">
        <input type="name" class="form-control" id="code_show" value="" >
        {!! Form::text('code', null, ['class'=>'form-control']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Nickname:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('nick_name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('nick_name', '<p class="help-block">:message</p>') !!}
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
    <label class="control-label col-sm-2" for="city">City:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="city_show" > -->
        {!! Form::text('city', null, ['class'=>'form-control']) !!}
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="state">Province:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="state_show" > -->
        {!! Form::text('province', null, ['class'=>'form-control']) !!}
        {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="state">Country:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="state_show" > -->
        {!! Form::text('country', null, ['class'=>'form-control']) !!}
        {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_1">Type:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_1_show" > -->
        {!! Form::select(
            'type', [
                'destination'=>'DESTINATION',
                'origin'=>'ORIGIN',
            ],old('type'), ['class'=>'form-control input-sm options_doc','id'=>'freight_type']) 
        !!}

        {!! $errors->first('destination', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_2">Loading:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_2_show" > -->
        {!! Form::text('loading', null, ['class'=>'form-control']) !!}
        {!! $errors->first('loading', '<p class="help-block">:message</p>') !!}
    </div>
</div>