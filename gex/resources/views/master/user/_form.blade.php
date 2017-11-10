<!-- <div class="form-group">
    <label class="control-label col-sm-2" for="id">ID:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="id_show" value="" >
    </div>
</div> -->
<div class="form-group partymeas">
    <label class="control-label col-sm-2" for="level">Role:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="level_show" value="" > -->
        <select name="role" class="form-control">
            @foreach($roles->sortBy('name') as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
        
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="code">Code:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="code_show" value="" > -->
        {!! Form::text('code', null, ['class'=>'form-control']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="name">Full Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Username:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('username', null, ['class'=>'form-control']) !!}
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Email:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{!! Form::hidden('password', bcrypt('rahasia'), ['class'=>'form-control']) !!}

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
    <label class="control-label col-sm-2" for="state">State:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="state_show" > -->
        {!! Form::text('state', null, ['class'=>'form-control']) !!}
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
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
    <label class="control-label col-sm-2" for="phone_3">Phone 3:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_3_show" > -->
        {!! Form::text('phone3', null, ['class'=>'form-control']) !!}
        {!! $errors->first('phone3', '<p class="help-block">:message</p>') !!}
    </div>
</div>
