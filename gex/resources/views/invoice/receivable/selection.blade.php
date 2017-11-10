@extends('layouts.app')

@section('content')

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- JOBSHEET -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Create Invoice {{ $jobsheet->code }}</h3>
                        </div>

                            <div class="panel-body">
                            {!! Form::model($jobsheet, ['url' => route('invoice.receivable.create', [$jobsheet->id]), 'method' => 'post','class'=>'form-horizontal']) !!}
                                {{ csrf_field() }}

                                @include('invoice.receivable._form_selection', [$jobsheet->id])

                                <div class="text-right">
                                    <button 
                                       type="button" 
                                       class="btn btn-danger" 
                                       data-toggle="modal" 
                                       data-target="#modal-decline{{ $jobsheet->id }}">
                                        Decline
                                    </button>
                                    <!-- <button type="submit" class="btn btn-primary">Create</button> -->
                                    {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
                                </div>

                            {!! Form::close() !!}
                            </div>
                    </div>
                    <!-- END JOBSHEET -->
                </div>
            </div>
        </div>
    </div>

{{-- Modal Decline --}}
<div class="modal fade" id="modal-decline{{ $jobsheet->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Decline Job Sheet</h4>
            </div>
            {!! Form::open(['url' => route('invoice.receivable.decline', $jobsheet->id), 'method' => 'post','class'=>'']) !!}
                <div class="modal-body">

                    {!! Form::hidden('sender_id', Auth::user()->id) !!}
                    <div class="form-group">
                        <label for="">RETURN TO</label>
                        <select name="receiver" id="" class="form-control input-sm">
                            <option value="{{ $jobsheet->operation_id }}">OPERATION</option>
                            <option value="{{ $jobsheet->marketing_id }}">MARKETING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">NOTE</label>
                        <textarea name="note" type="text" class="form-control" id="" placeholder="Input Note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
    @include('invoice._script')
    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{asset('vendor/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/cleave.js/cleave.min.js') }}"></script>

    <script>
         function checkAll(ele) {
         var checkboxes = document.getElementsByTagName('input');
         if (ele.checked) {
             for (var i = 0; i < checkboxes.length; i++) {
                 if (checkboxes[i].type == 'checkbox') {
                     checkboxes[i].checked = true;
                 }
             }
         } else {
             for (var i = 0; i < checkboxes.length; i++) {
                 console.log(i)
                 if (checkboxes[i].type == 'checkbox') {
                     checkboxes[i].checked = false;
                 }
             }
         }
        }
    </script>

@endsection