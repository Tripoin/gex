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
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="name">Display Name:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="name_show" value="" > -->
        {!! Form::text('display_name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if(Request::path() == 'master/documents/index')
    {!! Form::hidden('type', null) !!}
@else
    {!! Form::hidden('type','payable') !!}
@endif

@if(Auth::user()->role != 'operation')

<div class="form-group">
    <label class="control-label col-sm-2" for="nick_name">Type:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="nick_name_show" value="" > -->
        <!-- {!! Form::select('type', ['payable'=>'payable', 'receivable'=>'receivable'], ['class'=>'form-control']) !!} -->
        @if(Auth::user()->role == 'pricing')
            <select name="type" class="form-control">
                <option value="payable">PAYABLE</option>
            </select>
        @elseif(Auth::user()->role == 'marketing')
            <select name="type" class="form-control">
                <option value="receivable">RECEIVABLE</option>
            </select>
        @else
            <select name="type" class="form-control">
                <option value="payable">PAYABLE</option>
                <option value="receivable">RECEIVABLE</option>
            </select>
        @endif
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="phone_3">Remark:</label>
    <div class="col-sm-10">
        <!-- <input type="name" class="form-control" id="phone_3_show" > -->
        {!! Form::text('remark', null, ['class'=>'form-control']) !!}
        {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif