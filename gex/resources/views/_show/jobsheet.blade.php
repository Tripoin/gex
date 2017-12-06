<div class="row">

    @php
        $customer_id = App\MasterCustomer::find($jobsheet->customer_id);
        $marketing_id = App\User::find($jobsheet->marketing_id);
        $operation_id = App\User::find($jobsheet->operation_id);
        $poo_id = App\MasterPort::find($jobsheet->poo_id);
        $pod_id = App\MasterPort::find($jobsheet->pod_id);
    @endphp

    <div class="col-sm-4">
        <table class="table table-borderless table-condensed detail-table no-margin">
            <tr>
                <td>CUSTOMER</td>
                <td>:</td>
                <td>{{ $customer_id->name }}</td>
            </tr>
            <tr>
                <td>ORIGIN</td>
                <td>:</td>
                <td>{{ $poo_id->city }}</td>
            </tr>
            <tr>
                <td>DESTINATION</td>
                <td>:</td>
                <td>{{ $pod_id->city }}</td>
            </tr>
            <tr>
                <td>PARTY/MEAS</td>
                <td>:</td>
                <td>{{ $jobsheet->partymeas }} x {{ $jobsheet->party_unit->name }}</td>
            </tr>
            <tr>
                <td>FREIGHT TYPE</td>
                <td>:</td>
                <td>
                    {{ $jobsheet->freight_type == 0 ? 'PREPAID':'COLLECT' }}
                </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-borderless table-condensed detail-table no-margin">
            <tr>
                <td>OPERATION</td>
                <td>:</td>
                <td>{{ $operation_id->name }}</td>
            </tr>
            <tr>
                <td>MARKETING</td>
                <td>:</td>
                <td>{{ $marketing_id->name }}</td>
            </tr>
            <tr>
                <td>VESSEL</td>
                <td>:</td>
                <td>{{ $jobsheet->vessel }}</td>
            </tr>
            <tr>
                <td>DESCRIPTION</td>
                <td>:</td>
                <td>{{ $jobsheet->description }}</td>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-borderless table-condensed detail-table no-margin">
            <tr>
                <td>DATE</td>
                <td>:</td>
                <td class="text-right">{{ date('d F Y', strtotime($jobsheet->date)) }}</td>
            </tr>
            <tr>
                <td>ETD</td>
                <td>:</td>
                <td class="text-right">{{ date('d F Y', strtotime($jobsheet->etd)) }}</td>
            </tr>
            <tr>
                <td>ETA</td>
                <td>:</td>
                <td class="text-right">{{ date('d F Y', strtotime($jobsheet->eta)) }}</td>
            </tr>
            @foreach($references as $ref)
            <tr>
                @php
                    $doc = \App\MasterDocument::find($ref->document_id)
                @endphp
                <td>{{ $doc->name }}</td>
                <td>:</td>
                <td class="text-right">{{ $ref->ref_no }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>REMARKS</td>
                    <td>:</td>
                    <td>{{ $jobsheet->remarks }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-borderless detail-table no-margin">
            <tbody>
                <tr>
                    <td>INSTRUCTION</td>
                    <td>:</td>
                    <td class="text-right">{{ $jobsheet->instruction }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        @if(Auth::user()->role == 'marketing')

            <!-- RECEIVABLE / REIMBURSEMENT / RC -->
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-tabs-3" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tabcharges{{ $jobsheet->id }}" aria-controls="tabcharges" role="tab" data-toggle="tab">RECEIVABLES</a>
                    </li>
                    <li role="presentation">
                        <a href="#tabreimburse{{ $jobsheet->id }}" aria-controls="tabreimburse" role="tab" data-toggle="tab">REIMBURSEMENT</a>
                    </li>
                    <li role="presentation">
                        <a href="#tabrc{{ $jobsheet->id }}" aria-controls="tabrc" role="tab" data-toggle="tab">R/C</a>
                    </li>
                </ul>

                <div class="tab-content">
                    @if(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/show')
                        @include('_show.receivable')
                        @include('_show.reimbursement', $reimbursements)
                        @include('_show.rc')
                    @else
                        @include('_form.receivable')
                        @include('_form.reimbursement')
                        @include('_form.rc')
                    @endif
                </div>
            </div>
        @elseif(Auth::user()->role == 'pricing' || Auth::user()->role == 'payable' || Auth::user()->role == 'manager')
             <!-- DETAIL OF CHARGE / REIMBURSEMENT / RC -->
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-tabs-3" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tabcharges{{ $jobsheet->id }}" aria-controls="tabcharges" role="tab" data-toggle="tab">DETAIL OF CHARGES</a>
                    </li>
                    <li role="presentation">
                        <a href="#tabreimburse{{ $jobsheet->id }}" aria-controls="tabreimburse" role="tab" data-toggle="tab">REIMBURSEMENT</a>
                    </li>
                    <li role="presentation">
                        <a href="#tabrc{{ $jobsheet->id }}" aria-controls="tabrc" role="tab" data-toggle="tab">R/C</a>
                    </li>
                </ul>
                <div class="tab-content tab-content-charge">

                    <!-- PRICING ROLE -->
                    @if(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/show')
                        @include('_show.payable')
                        @include('_show.reimbursement', $reimbursements)
                        @include('_show.rc')
                    @elseif(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/create')
                        @include('_form.payable')
                        @include('_form.reimbursement')
                        @include('_form.rc')
                    @endif

                    <!-- PAYABLE ROLE -->
                    @if(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/show')
                        @include('_show.payable')
                        @include('_show.reimbursement')
                        @include('_show.rc')
                    @elseif(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/edit')
                        @include('_form.payable')
                        @include('_form.reimbursement')
                        @include('_form.rc')
                    @endif

                    <!-- MANAGER ROLE -->
                    @if(Request::path() == 'manager/jobsheet/'.$jobsheet->id.'/show')
                        @include('_show.payable')
                        @include('_show.reimbursement')
                        @include('_show.rc')
                    @elseif(Request::path() == 'manager/jobsheet/'.$jobsheet->id.'/edit')
                        @include('_form.payable')
                        @include('_form.reimbursement')
                        @include('_form.rc')
                    @endif
                </div>
            </div>
        @else
            <!-- PAYABLE -->
            @include('_show.payable')
        @endif
    </div>
</div>
<BR><BR>
<div class="text-right">

    @php
        $cek = App\Invoice::where('jobsheet_id', $jobsheet->id)->count();
        $req = App\RequestModel::where('jobsheet_id', $jobsheet->id)->count();
        $rec = App\Receivable::where('jobsheet_id', $jobsheet->id)->count();
        $rmb = App\Reimbursement::where('jobsheet_id', $jobsheet->id)->count();
    @endphp

    @if(Auth::user()->role == 'operation')
        <a href="{{ route('operation.jobsheet.index') }}" class="btn btn-success">Back</a>
        @if($cek < 1)
            <a href="{{ route('operation.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning">Edit</a>
        @endif
    @elseif(Auth::user()->role == 'marketing')
        @if(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/create')
            <a href="{{ route('marketing.jobsheet.uncreated') }}" class="btn btn-success">Back</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal{{ $jobsheet->id }}">Decline</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        @elseif(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/show')
            <a href="{{ route('marketing.jobsheet.index') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <a href="{{ route('marketing.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning">Edit</a>
            @endif
        @elseif(Request::path() == 'marketing/jobsheet/'.$jobsheet->id.'/edit' && $cek < 1)
            <a href="{{ route('marketing.jobsheet.index') }}" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        @endif
    @elseif(Auth::user()->role == 'pricing')
        @if(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/create')
            <a href="{{ route('pricing.jobsheet.uncreated') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal{{ $jobsheet->id }}">Decline</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        @elseif(Request::path() == 'pricing/jobsheet/'.$jobsheet->id.'/show')
            <a href="{{ route('pricing.jobsheet.index') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <a href="{{ route('pricing.jobsheet.create', $jobsheet->id) }}" class="btn btn-warning">Edit</a>
            @endif
        @endif
    @elseif(Auth::user()->role == 'payable')
        @if(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/edit')
            <a href="{{ route('payable.jobsheet.index') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal{{ $jobsheet->id }}">Decline</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        @elseif(Request::path() == 'payable/jobsheet/'.$jobsheet->id.'/show')
            <a href="{{ route('payable.jobsheet.index') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <a href="{{ route('payable.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning">Edit</a>
            @endif
        @endif
    @elseif(Auth::user()->role == 'manager')
        @if(Request::path() == 'manager/jobsheet/'.$jobsheet->id.'/edit')
            <a href="{{ route('manager.jobsheet.index') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declineModal{{ $jobsheet->id }}">Decline</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        @elseif(Request::path() == 'manager/jobsheet/'.$jobsheet->id.'/show')
            <a href="{{ route('manager.jobsheet.index') }}" class="btn btn-success">Back</a>
            @if($req < 1 && $cek < 1)
                <a href="{{ route('manager.jobsheet.edit', $jobsheet->id) }}" class="btn btn-warning">Edit</a>
            @endif
        @endif
    @endif
</div>
