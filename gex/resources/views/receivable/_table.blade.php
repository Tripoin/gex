<!-- Tab panes -->
<div class="tab-content tab-content-1">
    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
        <div class="table-responsive">
            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                <thead>  
                  <tr class="text-center">
                    <!-- <th>NO.</th> -->
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
                            $amount = App\Receivable::where('rec_invoice_id', $rec->id)->get();
                            $total_amount = collect($amount)->sum('rec_total');
                            $array = $amount->toArray();

                            $amount_rec = App\ReceivablePayment::where('invoice_id', $rec->id)->first();
                            $amount_fix = App\ReceivablePayment::where('invoice_id', $rec->id)->sum('amount_rec');
                        @endphp
                         <tr class="text-center">
                            <!-- <td class="text-center">{{ $no }}</td>  -->
                            <td>{{ Form::checkbox('id[]', $rec->id, false, ['class' => 'check-req','form'=>'store']) }}</td> 
                            <td>
                                    <a href="{{ route('receivable.show', [$rec->id, $rec->type]) }}"> {{ $rec->code }} </a>
                            </td>  
                            <td>{{ $rec->jobsheet->code }}</td>
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
                                {{ $array[0]['rec_currency'] == 1? 'IDR':'USD' }}
                            </td>  
                            <td>
                                <input type="text" name="amount_rec[]" class="" form="store">
                            </td>
                            <td>
                                @if(!empty($amount_rec) && count($amount_rec) > 0)
                                    <input type="text" name="rate[]" value="{{ number_format($amount_rec->rate) }}">
                                @else
                                    <input type="text" name="rate[]" value="{{ number_format($rate->rate) }}">
                                @endif
                            </td>
                            <td>
                                @if(!empty($amount_rec) && count($amount_rec) > 0)
                                    <input type="text" name="pph[]" class="" form="store" value="{{ $amount_rec->pph }}">
                                @else
                                    <input type="text" name="pph[]" class="" form="store">
                                @endif
                            </td>
                            <td>
                                @if(!empty($amount_rec) && count($amount_rec) > 0)
                                    <input type="text" name="adm_bank[]" class="" form="store" value="{{ $amount_rec->adm_bank or '' }}">
                                @else
                                    <input type="text" name="adm_bank[]" class="" form="store">
                                @endif
                            </td>
                            <td>
                                @if(!empty($amount_rec) && count($amount_rec) > 0)
                                    <input type="text" name="other[]" class="" form="store" value="{{ $amount_rec->other }}">
                                @else
                                    <input type="text" name="other[]" class="" form="store">
                                @endif
                            </td>
                            <td>
                                @if(!empty($amount_rec) && count($amount_rec) > 0)
                                    <input type="text" name="remarks[]" form="store" value="{{ $amount_rec->remarks }}">
                                @else
                                    <input type="text" name="remarks[]" form="store">
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
</div>