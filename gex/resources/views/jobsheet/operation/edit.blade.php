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
                            <h3 class="panel-title">Edit JobSheet {{ $jobsheet->code }}</h3>
                        </div>
                        
                        {!! Form::model($jobsheet, ['url' => route('operation.jobsheet.update', $jobsheet->id), 'method' => 'PUT','class'=>'form-horizontal']) !!}

                            {{ csrf_field() }}
                            @include('_form.jobsheet', [$jobsheet->id])
                            
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

    @include('_form.script')

@endsection