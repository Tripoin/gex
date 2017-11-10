@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
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
                                        <a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">CREATE NEW JOBSHEET</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tab-content-1">
                                    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                                <thead>  
                                                  <tr>
                                                    <th>NO.</th>  
                                                    <th>JOB</th>  
                                                    <th>DATE</th>  
                                                    <th>CUSTOMER</th>  
                                                    <th>MARKETING</th>
                                                    <th>ORIGIN</th>
                                                    <th>DESTINATION</th>
                                                    <th>ETD</th>
                                                    <th>ETA</th>
                                                    <th>ACTION</th>
                                                  </tr>  
                                                </thead>
                                                <?php $no = 1; ?>  
                                                <tbody>  
                                                    @foreach($jobsheets->sortByDesc('id') as $jobsheet)
                                                        @php
                                                            $customer_id = App\MasterCustomer::find($jobsheet->customer_id);
                                                            $marketing_id = App\User::find($jobsheet->marketing_id);
                                                            $poo_id = App\MasterPort::find($jobsheet->poo_id);
                                                            $pod_id = App\MasterPort::find($jobsheet->pod_id);
                                                            $cek = App\Invoice::where('jobsheet_id', $jobsheet->id)->count();
                                                        @endphp
                                                        
                                                        @if(Auth::user()->role=='marketing' || Auth::user()->role == 'admin')
                                                            <tr>
                                                                <td>{{ $no }}</td>  
                                                                <td>
                                                                    <a href="{{ route('marketing.jobsheet.create', $jobsheet->id) }}"> {{ $jobsheet->code }} </a>
                                                                </td>  
                                                                <td>{{ $jobsheet->date }}</td>
                                                                <td>{{ $customer_id->name }}</td>  
                                                                <td>{{ $marketing_id->name }}</td>
                                                                <td>{{ $poo_id->city }}</td>
                                                                <td>{{ $pod_id->city }}</td>  
                                                                <td>{{ $jobsheet->eta }}</td>
                                                                <td>{{ $jobsheet->etd }}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('marketing.jobsheet.create', $jobsheet->id) }}" class="btn btn-primary btn-sm">create</a> 
                                                                </td>
                                                            </tr>
                                                        @elseif(Auth::user()->role=='pricing' || Auth::user()->role == 'admin')
                                                            <tr>
                                                                <td>{{ $no }}</td>  
                                                                <td>
                                                                    <a href="{{ route('pricing.jobsheet.create', $jobsheet->id) }}" > {{ $jobsheet->code }} </a>
                                                                </td>  
                                                                <td>{{ $jobsheet->date }}</td>
                                                                <td>{{ $customer_id->name }}</td>  
                                                                <td>{{ $marketing_id->name }}</td>
                                                                <td>{{ $poo_id->city }}</td>
                                                                <td>{{ $pod_id->city }}</td>  
                                                                <td>{{ $jobsheet->eta }}</td>
                                                                <td>{{ $jobsheet->etd }}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('pricing.jobsheet.create', $jobsheet->id) }}" class="btn btn-primary btn-sm">create</a> 
                                                                </td>
                                                            </tr>
                                                        @elseif(Auth::user()->role=='invoice' || Auth::user()->role == 'admin')
                                                            <tr>
                                                                <td>{{ $no }}</td>  
                                                                <td>
                                                                    <a href="{{ route('invoice.receivable.create', $jobsheet->id) }}"> {{ $jobsheet->code }} </a>
                                                                </td>  
                                                                <td>{{ $jobsheet->date }}</td>
                                                                <td>{{ $customer_id->name }}</td>  
                                                                <td>{{ $marketing_id->name }}</td>
                                                                <td>{{ $poo_id->city }}</td>
                                                                <td>{{ $pod_id->city }}</td>  
                                                                <td>{{ $jobsheet->eta }}</td>
                                                                <td>{{ $jobsheet->etd }}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('invoice.receivable.create', $jobsheet->id) }}" class="btn btn-primary btn-sm">create</a> 
                                                                </td>
                                                              </tr>
                                                        @endif
                                                        
                                                        <?php $no++; ?>  
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

@endsection