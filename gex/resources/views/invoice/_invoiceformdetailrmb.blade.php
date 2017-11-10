<div class="row">
    <div class="col-sm-7 col-md-6">
        <div class="form-group">
            <label class="control-label col-sm-4">DATE</label>
            <div class="col-sm-8">
                <div class="input-group">
				    <input class="form-control input-sm datepicker" name="date" placeholder="Create Date" type="text" value="{{date('d-m-Y')}}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
            </div>
        </div>
        <input type="hidden" name="id_job_sheet" id="id_job_modal">
        <div class="form-group">
            <label class="control-label col-sm-4">BANK ACCOUNT</label>
            <div class="col-sm-8">
                {!! Form::select('bank_id', [''=>'']+App\MasterBank::pluck('name','id')->all(),null, ['class'=>'form-control input-sm', 'id'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">REFERENCES</label>
            <div class="col-sm-8">
                @foreach($references as $ref)
                @php
                    $doc = \App\MasterDocument::find($ref->document_id)
                @endphp
                <input type="checkbox" name="ref[]" value="{{ $doc->name.'-'.$ref->ref_no }}"> {{ $doc->name }} - {{ $ref->ref_no }} <br />
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label class="control-label col-sm-4">CUSTOMER</label>
            <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
            <label class="control-label col-sm-6 col-md-7 label-right">
                @php
                    $char = App\Reimbursement::find($charges[0]);
                    $customer_id = App\MasterCustomer::find($jobsheet->customer_id);
                    $cust = App\MasterCustomer::find($char->rmb_marketing->customer_id);
                    $term = App\MasterTerm::find($char->rmb_marketing->term_id);
                @endphp
                {{ $customer_id->name }}
                <input type="hidden" name="customer" value="{{ $customer_id->id }}">
            </label>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">BILL TO</label>
            <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
            <label class="control-label col-sm-6 col-md-7 label-right">
                {{ $cust->name }}
            </label>
        </div>
        {{-- <div class="form-group">
            <label class="control-label col-sm-4">TAX</label>
            <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
            <label class="control-label col-sm-6 col-md-7 label-right">
                    @if($char->rmb_tax == 1)
                        PPN 1
                    @elseif($char->rmb_tax == 2)
                        PPN 2
                    @else
                        NON PPN
                    @endif
            </label>
        </div> --}}
        <div class="form-group">
            <label class="control-label col-sm-4">TERMS</label>
            <label class="control-label col-sm-2 col-md-1 label-normal">:</label>
            <label class="control-label col-sm-6 col-md-7 label-right">
                {{ $term->name }}
            </label>
        </div>
    </div>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-body-condensed table-striped no-margin">
        <thead>
            <tr>
                <td width="2%">NO</td>
                <td class="valign-middle text-center">DETAIL OF CHARGES</td>
                <td class="valign-middle text-center">QTY x UNIT</td>
                <td class="valign-middle text-center">CURR</td>
                <td class="valign-middle text-center">PRICE</td>
                <td class="valign-middle text-center">TOTAL</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; $sum = 0; ?>
        @foreach($charges as $charge)
            <?php
                $cha = App\Reimbursement::find($charge);
                $doc = App\MasterDocument::find($cha->rmb_document_id);
                $unit = App\MasterUnit::find($cha->rmb_unit_id);
                $sum += $cha->rmb_total;
            ?>
            <input type="hidden" name="rmb_id[]" value="{{ $charge }}">
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $doc->name }}</td>
                <td class="text-center">{{ $cha->rmb_quantity }} x {{ $unit->name }}</td>
                <td class="text-center">
                    @if($cha->rmb_currency == 1)
                        IDR
                    @else
                        USD
                    @endif
                </td>
                <td class="text-right">{{ number_format($cha->rmb_price) }}</td>
                <td class="text-right">
                    {{-- @if($max == $cha->rmb_total)
                        @if($cha->rmb_tax == 1)
                            {{ number_format($cha->rmb_total) }}
                        @elseif($cha->rmb_tax == 2)
                            {{ number_format($cha->rmb_total - $tot/1.01 * 1/100) }}
                        @else
                            {{ number_format($cha->rmb_total - $tot/1.01 * 1/100) }}
                        @endif
                    @else
                        {{ number_format($cha->rmb_total) }}
                    @endif --}}
                    {{ number_format($cha->rmb_total) }}
                </td>
            </tr>
            <?php $no++ ?>
        @endforeach
            {{-- <tr>
                <td colspan="3"></td>
                <td colspan="2"><strong>NET VALUE</strong></td>
                <td class="text-right"><strong>
                    @if($char->rmb_tax == 1)
                        {{ number_format($sum) }}
                    @elseif($char->rmb_tax == 2)
                        {{ number_format($sum - $sum/1.01 * 1/100) }}
                    @else
                        {{ number_format($sum - $sum/1.01 * 1/100) }}
                    @endif
                </strong></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2"><strong>VAT</strong></td>
                <td class="text-right"><strong>
                    @if($char->rmb_tax == 1)
                        {{ number_format($sum * 1/100) }}
                    @elseif($char->rmb_tax == 2)
                        {{ number_format($sum/1.01 * 1/100) }}
                    @else
                        {{ number_format($sum/1.01 * 1/100) }}
                    @endif
                </strong></td>
            </tr> --}}
            <tr>
                <td colspan="3"></td>
                <td colspan="2"><strong>AMMOUNT DUE</strong></td>
                <td class="text-right"><strong>
                {{-- @if($char->rmb_tax == 1)
                    {{ number_format($sum + $sum * 1/100) }}
                @else
                    {{ number_format($sum) }}
                @endif --}}
                {{ number_format($sum) }}
                </strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br />
<div class="text-right">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>