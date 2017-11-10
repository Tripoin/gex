@extends('layouts.app')

@section('content')
    
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable float-alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{-- <i class="fa fa-shield fa-2x"></i> --}}
            <p><strong>Error !</strong> Failed to create new jobsheet</p>   
        </div>
    @endif

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- JOBSHEET -->
                    <div class="panel">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title">Create Invoice {{ $jobsheet->code }}</h3>
                        </div>
                        <!-- <form action="{{ route('jobsheet.operation.store') }}" method="POST" class="form-horizontal" role="form" id="form-jobsheet"> -->
                        {!! Form::open(['url' => route('invoice.storeedit', [$jobsheet->id, $invoice->type, $invoice->id]), 'method' => 'post','class'=>'form-horizontal']) !!}
                            {{ csrf_field() }}
                            <div class="panel-body">
                                @include('invoice._editformdetail', [$jobsheet->id])
                            </div>
                            <div class="panel-footer text-right">
                            </div>
                        {!! Form::close() !!}
                        </form>
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

@endsection