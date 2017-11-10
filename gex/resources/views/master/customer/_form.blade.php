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
    <label class="control-label col-sm-2" for="name">Full Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Nickname:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('nick_name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('nick_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Address 1:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('address1', null, ['class'=>'form-control']) !!}
        {!! $errors->first('address1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Address 2:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="address_show" > -->
        {!! Form::text('address2', null, ['class'=>'form-control']) !!}
        {!! $errors->first('address2', '<p class="help-block">:message</p>') !!}
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
    <label class="control-label col-sm-2" for="phone_1">Phone 1:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_1_show" > -->
        {!! Form::text('phone1', null, ['class'=>'form-control']) !!}
        {!! $errors->first('phone1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_2">Phone 2:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_2_show" > -->
        {!! Form::text('phone2', null, ['class'=>'form-control']) !!}
        {!! $errors->first('phone2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_3">Fax:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_3_show" > -->
        {!! Form::text('fax', null, ['class'=>'form-control']) !!}
        {!! $errors->first('fax', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_3">Zipcode:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_3_show" > -->
        {!! Form::text('zipcode', null, ['class'=>'form-control']) !!}
        {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_3">Type:</label>
    <div class="col-sm-10">
        {!! Form::checkbox('agent', 'AGENT') !!} AGENT<br>
        {!! Form::checkbox('shipper', 'SHIPPER') !!} SHIPPER<br>
        {!! Form::checkbox('consignee', 'CONSIGNEE') !!} CONSIGNEE
        {!! Form::text('type', null, ['class'=>'form-control', 'disabled','placeholder'=>'pilih pilihan diatas']) !!}
        
    </div>
</div>