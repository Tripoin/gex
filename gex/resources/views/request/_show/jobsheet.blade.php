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