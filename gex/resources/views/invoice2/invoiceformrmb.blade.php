    <div class="row ref-detail">
        <div class="col-sm-4">
            <table class="table table-borderless table-condensed detail-table no-margin">
                {{-- <tr>
                    <td>No. Job</td>
                    <td>:</td>
                    <td class="td-input"><input type="text" class="form-control input-sm" id="email" placeholder="Enter Job Sheet"></td>
                </tr> --}}

                @php
                    $customer_id = App\MasterCustomer::find($jobsheet->customer_id);
                    $poo_id = App\MasterPort::find($jobsheet->poo_id);
                    $pod_id = App\MasterPort::find($jobsheet->pod_id);
                    $partymeas_unit = App\MasterUnit::find($jobsheet->partymeas_unit);
                @endphp

                <tr>
                    <td>CUSTOMER</td>
                    <td>:</td>
                    <td>{{ $customer_id->name }}</td>
                </tr>
                <tr>
                    <td>ORIGIN</td>
                    <td>:</td>
                    <td>{{ $poo_id->nick_name }}</td>
                </tr>
                <tr>
                    <td>DESTINATION</td>
                    <td>:</td>
                    <td>{{ $poo_id->nick_name }}</td>
                </tr>
                <tr>
                    <td>PARTY/MEAS</td>
                    <td>:</td>
                    <td>{{ $jobsheet->partymeas }} x {{ $partymeas_unit->name }}</td>
                </tr>
                <tr>
                    <td>REMARKS</td>
                    <td>:</td>
                    <td>{{ $jobsheet->remarks }}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-4">
            <table class="table table-borderless table-condensed detail-table no-margin">
            @php
                $marketing_id = App\User::find($jobsheet->marketing_id);
                //$operation_id = App\User::find($jobsheet->operation_id);
            @endphp
                <tr>
                    <td>MARKETING</td>
                    <td>:</td>
                    <td>{{ $marketing_id->name }}</td>
                </tr>
                <tr>
                    <td>FREIGHT TYPE</td>
                    <td>:</td>
                    <td>
                        @if($jobsheet->freight_type==0)
                            PREPAID
                        @else
                            COLLECT
                        @endif
                    </td>
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
                <tr>
                    <td>INSTRUCTION</td>
                    <td>:</td>
                    <td>{{ $jobsheet->instruction }}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-4">
            <table class="table table-borderless table-condensed detail-table no-margin">
                <tr>
                    <td>DATE</td>
                    <td>:</td>
                    <td class="text-right">{{date('d F y', strtotime($jobsheet->date))}}</td>
                </tr>
                <tr>
                    <td>ETD</td>
                    <td>:</td>
                    <td class="text-right">{{date('d F y', strtotime($jobsheet->etd))}}</td>
                </tr>
                <tr>
                    <td>ETA</td>
                    <td>:</td>
                    <td class="text-right">{{date('d F y', strtotime($jobsheet->eta))}}</td>
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
    <hr class="hide-ref" title="Hide Reference">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped invoice-table no-margin">
                    <thead>
                        <tr>
                            <td class="valign-middle text-center" rowspan="2">NO</td>
                            <td class="valign-middle text-center" rowspan="2" width="1%"><input type="checkbox" onchange="checkAll(this)" name="chk[]" /></td>
                            <td class="valign-middle text-center" rowspan="2">CHARGES</td>
                            <td class="valign-middle text-center" rowspan="2">BILL TO</td>
                            <td class="valign-middle text-center" rowspan="2">TERMS</td>
                            <td class="valign-middle text-center" rowspan="2">QTY</td>
                            <td class="valign-middle text-center" rowspan="2">UNIT</td>
                            <td class="valign-middle text-center" rowspan="2">TAX</td>
                            <td class="valign-middle text-center" rowspan="2">CURR</td>
                            <td class="valign-middle text-center" rowspan="2">AMOUNT</td>
                            <td class="text-center" colspan="2">TOTAL</td>
                        </tr>
                        <tr>
                            <td class="text-center" width="10%">USD</td>
                            <td class="text-center" width="10%">IDR</td>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <input type="hidden">
                        @foreach($reimbursement as $rmb)
                        @php $no=1; @endphp
                                @php
                                    $rec_bill = App\MasterCustomer::find($rmb->rmb_marketing->customer_id);
                                    $rec_term = App\MasterTerm::find($rmb->rmb_marketing->term_id);
                                    $rec_unit = App\MasterUnit::find($rmb->rmb_unit_id);
                                    $rec_doc  = App\MasterDocument::find($rmb->rmb_document_id);
                                    $rec_tax  = $rmb->rmb_tax;
                                    $rec_cur  = $rmb->rmb_currency;
                                    $rec_ttl  = $rmb->rmb_price * $rmb->rmb_quantity;
                                @endphp
                        <tr>
                        <input type="hidden" name="total[]" value="{{ $rmb->rmb_total }}">
                            <td>{{ $no }}</td>
                            <td>
                                <label class="fancy-checkbox">
                                    <!-- <input  type="checkbox" name="charges" class="check-req" value="{{ $rmb->id }}" required autofocus="">
                                     -->
                                     {{ Form::checkbox('charges[]', $rmb->id, false, ['class' => 'check-req']) }}
                                <span></span></label></td> 
                            <td>B. PENGGANTIAN - {{ $rec_doc->name }}</td>
                            <td>{{ $rec_bill->name }}</td>
                            <td>{{ $rec_term->name }}</td>
                            <td>{{ $rmb->rmb_quantity }}</td>
                            <td>{{ $rec_unit->name }}</td>
                            <td>
                                        @if($rec_tax == 1)
                                            PPN 1
                                        @elseif($rec_tax == 2)
                                            PPN 2
                                        @else
                                            NON PPN
                                        @endif
                            </td>
                            <td>
                                        @if($rec_cur == 1)
                                            IDR
                                        @else
                                            USD
                                        @endif
                            </td>
                            <td class="text-right number">{{ number_format($rmb->rmb_price) }}</td>
                            <td class="text-right number usd">
                                        @if($rec_cur == 2)
                                            {{ number_format($rec_ttl) }}
                                        @endif
                            </td>
                            <td class="text-right number idr">
                                        @if($rec_cur == 1)
                                            {{ number_format($rec_ttl) }}
                                        @endif
                            </td>
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>