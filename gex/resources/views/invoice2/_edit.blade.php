@extends('layouts.app')

@section('content')

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- JOBSHEET -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Invoice {{ $jobsheet->code }}</h3>
                        </div>

                            <div class="panel-body">
                            {!! Form::model($jobsheet, ['url' => route('invoice.nextedit', [$jobsheet->id, $invoice->type, $invoice->id]), 'method' => 'post','class'=>'form-horizontal']) !!}
                                {{ csrf_field() }}

                                @include('invoice._editdetailinvoice', [$jobsheet->id])

                                <div class="text-right">
                                    <!-- <button type="submit" class="btn btn-primary">Create</button> -->
                                    {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
                                </div>

                            {!! Form::close() !!}
                            </div>
                    </div>
                    <!-- END JOBSHEET -->
                </div>
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