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
                    <!-- JOB SHEET -->
                    <div class="panel">
                        <div class="panel-body no-padding">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-1" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">HISTORY PAYMENT INVOICE {{ $invoice->code }}</a>
                                    </li>
                                </ul>
                                <br>

                                <!-- Tab panes -->
                                <div class="tab-content tab-content-1">
                                    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                                <thead>  
                                                  <tr class="text-center">
                                                    <th>NO.</th>  
                                                    <th>JOB</th>  
                                                    <th>DATE</th>
                                                    <th>CURR</th>
                                                    <th>BANK</th>  
                                                    <th>AMOUNT RECEIVED</th>
                                                    <th>RATE</th>
                                                    <th>PPH 23</th>
                                                    <th>ADM BANK</th>
                                                    <th>OTHER</th>
                                                    <th>REMARKS</th>
                                                    <th>NOTE</th>  
                                                  </tr>  
                                                </thead>
                                                <?php $no = 1; ?>  
                                                <tbody>
                                                    @foreach($rec->sortByDesc('id') as $rec_payment)
                                                        @php
                                                            $job = App\Jobsheet::find($rec_payment->jobsheet_id);
                                                            $bank = App\MasterBank::find($rec_payment->payment);
                                                        @endphp
                                                         <tr class="text-center">
                                                            <td class="text-center">{{ $no }}</td> 
                                                            <td>{{ $job->code }}</td>
                                                            <td>
                                                                {{ $rec_payment->created_at->format('d M Y - H:i:s') }}
                                                            </td>
                                                            <td>
                                                                @if($rec_payment->currency == 1)
                                                                        (IDR)
                                                                    @else
                                                                        (USD)
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                {{ $bank->name }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($rec_payment->amount_rec) }}
                                                            </td>
                                                            <td>
                                                                {{ $rec_payment->rate }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($rec_payment->pph) }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($rec_payment->adm_bank) }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($rec_payment->other) }}
                                                            </td>
                                                            <td>
                                                                {{ $rec_payment->remarks }}
                                                            </td>
                                                            <td>
                                                                {{ $rec_payment->note }}
                                                            </td>
                                                          </tr>
                                                          <?php $no++; ?>  
                                                    @endforeach
                                                </tbody>  
                                            </table>
                                        </div>
                                        <br>
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

    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{asset('vendor/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('vendor/cleave.js/cleave.min.js') }}"></script>

    <script>
        $(document).ready(function() { $("#customers").select2(); });
        $(document).ready(function() { $("#bank").select2(); });
    </script>

    <script>
        var cleave = new Cleave('.', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    </script>

    <script>
        var cleave = new Cleave('.', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    </script>

    <script>
        var cleave = new Cleave('.', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    </script>

    <script>
        var cleave = new Cleave('.', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    </script>

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