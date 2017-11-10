@extends('layouts.app')

@section('title', 'Profit Marketing')

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
                    <!-- JOB SHEET -->
                    <div class="panel">
                        <div class="panel-body no-padding">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-1" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">PROFIT MARKETING {{ $from_date }} - {{ $to_date }}</a>
                                    </li>
                                </ul>
                                <br>
                                
                                <div class="tab-content tab-content-1">
                                    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                                <thead>  
                                                  <tr>
                                                    <th>NO.</th>  
                                                    <th>JOB</th>  
                                                    <th>INVOICE</th>  
                                                    <th>SHIPPER</th>  
                                                    <th>PIUTANG (USD)</th>
                                                    <th>HUTANG (USD)</th>
                                                    <th>PROFIT (USD)</th>
                                                    <th>PIUTANG (IDR)</th>
                                                    <th>HUTANG (IDR)</th>
                                                    <th>PROFIT (IDR)</th>
                                                  </tr>  
                                                </thead>
                                                <?php $no = 1; ?>  
                                                <tbody>  
                                                    @foreach($jobsheets as $jobsheet)
                                                        @php
                                                            $invoice = App\Invoice::where('jobsheet_id', $jobsheet->id)->first();
                                                            $payable = App\Payable::where('jobsheet_id', $jobsheet->id)->first();
                                                            $customer = App\MasterCustomer::find($jobsheet->customer_id);
                                                            $receivables = App\Receivable::where('jobsheet_id', $jobsheet->id)->get();
                                                        @endphp

                                                        @foreach($receivables as $receivable)
                                                            <tr>
                                                                <td>{{ $no }}</td>
                                                                <td>{{ $jobsheet->code }}</td>
                                                                <td>{{ $invoice['code'] }}</td>
                                                                <td>{{ $customer->name }}</td>
                                                                <td>{{ $receivable->rec_currency == 2? $receivable->rec_total:'' }}</td>
                                                                <td>{{ $payable['currency'] == 2 ? $payable['price']:'' }}</td>
                                                                <td></td>
                                                                <td>{{ $receivable->rec_currency == 1? $receivable->rec_total:'' }}</td>
                                                                <td>{{ $payable['currency'] == 1 ? $payable['price']:'' }}</td>
                                                                <td></td>
                                                            </tr>
                                                            <?php $no++; ?>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>  
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END JOB SHEET -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    @include('jobsheet.operation._script')

    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{asset('vendor/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/cleave.js/cleave.min.js') }}"></script>

    
@endsection