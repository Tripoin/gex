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
                                @if(Request::path() == 'receivables/payment')
                                    <ul class="nav nav-tabs nav-tabs-1" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">RECEIVABLE PAYMENT {{ $tes }} {{ $rate->rate }}</a>
                                        </li>
                                    </ul>
                                    <br>
                                    {!! Form::open(['url' => route('receivable.payment.create'), 'method' => 'post','class'=>'form-horizontal','id'=>'filter']) !!}
                                        {{ csrf_field() }}
                                        @include('receivable._form')
                                    {!! Form::close() !!}


                                    {!! Form::open(['url' => route('receivable.payment.store'), 'method' => 'post','class'=>'form-horizontal','id'=>'store']) !!}
                                        {{ csrf_field() }}  
                                        @include('receivable._table')
                                    {!! Form::close() !!}
                                @elseif(Request::path() == 'receivables/overpayment')
                                    <ul class="nav nav-tabs nav-tabs-1" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">RECEIVABLE OVERPAYMENT {{ $tes }}</a>
                                        </li>
                                    </ul>
                                    <br>
                                    {!! Form::open(['url' => route('receivable.filterover'), 'method' => 'post','class'=>'form-horizontal','id'=>'filter']) !!}
                                        {{ csrf_field() }}
                                        @include('receivable._form')
                                    {!! Form::close() !!}

                                    {!! Form::open(['url' => route('receivable.payment.storeover'), 'method' => 'post','class'=>'form-horizontal','id'=>'store']) !!}
                                        {{ csrf_field() }}  
                                        @include('receivable._table')
                                    {!! Form::close() !!}
                                @endif

                                
                                <!-- Tab panes -->
                                <!-- <div class="tab-content tab-content-1">
                                    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                                <thead>  
                                                  <tr class="text-center">
                                                    <th>NO.</th>
                                                    <th><input type="checkbox" onchange="checkAll(this)" name="chk[]" /></th>  
                                                    <th>INVOICE</th>  
                                                    <th>JOB</th>  
                                                    <th>AMOUNT</th>  
                                                    <th>OUTSTANDING</th>
                                                    <th>CURR</th>
                                                    <th>AMOUNT RECEIVED</th>
                                                    <th>RATE</th>
                                                    <th>PPH 23</th>
                                                    <th>ADM BANK</th>
                                                    <th>OTHER</th>
                                                    <th>REMARKS</th>  
                                                  </tr>  
                                                </thead>
                                                <?php $no = 1; ?>  
                                                <tbody>
                                                    @foreach($invoicerec->sortByDesc('id') as $rec)
                                                        @php
                                                            $job = App\Jobsheet::find($rec->jobsheet_id);
                                                            $customer_id = App\MasterCustomer::find($rec->customer_id);

                                                            $amount = App\Receivable::where('rec_invoice_id', $rec->id)->get();
                                                            $total_amount = collect($amount)->sum('rec_total');
                                                            $array = $amount->toArray();

                                                            $amount_rec = App\ReceivablePayment::where('invoice_id', $rec->id)->first();
                                                            $amount_fix = App\ReceivablePayment::where('invoice_id', $rec->id)->sum('amount_rec');
                                                        @endphp
                                                         <tr class="text-center">
                                                            <td class="text-center">{{ $no }}</td> 
                                                            <td>{{ Form::checkbox('id[]', $rec->id, false, ['class' => 'check-req','form'=>'store']) }}</td> 
                                                            <td>
                                                                    <a href="{{ route('receivable.show', [$rec->id, $rec->type]) }}"> {{ $rec->code }} </a>
                                                            </td>  
                                                            <td>{{ $job->code }}</td>
                                                            <td>
                                                                @if(Request::path() == 'receivables/payment')
                                                                    {{ number_format($total_amount) }}
                                                                @elseif(Request::path() == 'receivables/overpayment')
                                                                    {{ number_format($amount_fix - $total_amount) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(Request::path() == 'receivables/payment')
                                                                    @if(count($amount_rec) > 0)
                                                                        {{ number_format($amount_fix) }}
                                                                    @else
                                                                        {{ number_format($total_amount) }}
                                                                    @endif
                                                                @elseif(Request::path() == 'receivables/overpayment')
                                                                    {{ number_format($amount_fix - $total_amount) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($array[0]['rec_currency'] == 1)
                                                                        (IDR)
                                                                    @else
                                                                        (USD)
                                                                    @endif
                                                            </td>  
                                                            <td>
                                                                <input type="text" name="amount_rec[]" class="" form="store">
                                                            </td>
                                                            <td>
                                                                @if(!empty($amount_rec))
                                                                    @if(count($amount_rec) > 0)
                                                                        <input type="text" name="rate[]" value="{{ $amount_rec->rate }}" form="store">
                                                                    @else
                                                                        <input type="text" name="rate[]" value="{{ $rate->rate }}" form="store">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(!empty($amount_rec))
                                                                    @if(count($amount_rec) > 0)
                                                                        <input type="text" name="pph[]" class="" form="store" value="{{ $amount_rec->pph }}">
                                                                    @else
                                                                        <input type="text" name="pph[]" class="" form="store">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(!empty($amount_rec))
                                                                    @if(count($amount_rec) > 0)
                                                                        <input type="text" name="adm_bank[]" class="" form="store" value="{{ $amount_rec->adm_bank or '' }}">
                                                                    @else
                                                                        <input type="text" name="adm_bank[]" class="" form="store">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(!empty($amount_rec))
                                                                    @if(count($amount_rec) > 0)
                                                                        <input type="text" name="other[]" class="" form="store" value="{{ $amount_rec->other }}">
                                                                    @else
                                                                        <input type="text" name="other[]" class="" form="store">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(!empty($amount_rec))
                                                                    @if(count($amount_rec) > 0)
                                                                        <input type="text" name="remarks[]" form="store" value="{{ $amount_rec->remarks }}">
                                                                    @else
                                                                        <input type="text" name="remarks[]" form="store">
                                                                    @endif
                                                                @endif
                                                            </td>
                                                          </tr>
                                                          <?php $no++; ?>  
                                                    @endforeach
                                                </tbody>  
                                            </table>
                                        </div>
                                        <br>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" form="store">Submit</button>
                                        </div>
                                    </div>
                                </div> -->
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