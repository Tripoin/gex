<div class="modal fade" id="declineModal{{ $jobsheet->id }}"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                id="favoritesModalLabel">Decline Jobsheet {{ $jobsheet->code }}</h4>
            </div>

            @if(Auth::user()->role == 'marketing')
                {!! Form::open(['url' => route('marketing.jobsheet.decline'), 'method' => 'post','class'=>'form-horizontal']) !!}

                    <div class="modal-body">

                        {{ csrf_field() }}
                        {!! Form::hidden('jobsheet_id', $jobsheet->id) !!}
                        {!! Form::hidden('sender_id', Auth::user()->id) !!}

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="code">RETURN TO</label>
                            <div class="col-sm-10">
                                <input type="receiver" name="receiver" class="form-control" id="" value="OPERATION" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">NOTE</label>
                            <div class="col-sm-10">
                                {!! Form::textarea('note', old('note'),['class'=>'form-control input-sm','size'=>'20x3']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="pull-right">
                            <div class="">
                              <div class="col-md-4 col-md-offset-2">
                                {!! Form::submit('Kirim', ['class'=>'btn btn-primary']) !!}
                              </div>
                            </div>
                        </span>
                    </div>
                {!! Form::close() !!}
            @elseif(Auth::user()->role == 'pricing')
                {!! Form::open(['url' => route('pricing.jobsheet.decline'), 'method' => 'post','class'=>'']) !!}
                    <div class="modal-body">
                        {!! Form::hidden('jobsheet_id', $jobsheet->id) !!}
                        {!! Form::hidden('sender_id', Auth::user()->id) !!}
                        <div class="form-group">
                            <label for="">RETURN TO</label>
                            <select name="receiver" id="" class="form-control input-sm">
                                <option value="{{ $jobsheet->operation_id }}">OPERATION</option>
                                <option value="{{ $jobsheet->marketing_id }}">MARKETING</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">NOTE</label>
                            <textarea name="note" type="text" class="form-control" id="" placeholder="Input Note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                {!! Form::close() !!}
            @elseif(Auth::user()->role == 'payable')
                {!! Form::open(['url' => route('payable.jobsheet.decline'), 'method' => 'post','class'=>'']) !!}
                    <div class="modal-body">
                        {!! Form::hidden('jobsheet_id', $jobsheet->id) !!}
                        {!! Form::hidden('sender_id', Auth::user()->id) !!}
                        <div class="form-group">
                            <label for="">RETURN TO</label>
                            <select name="receiver" id="" class="form-control input-sm">
                                <option value="{{ $jobsheet->operation_id }}">OPERATION</option>
                                <option value="{{ $jobsheet->marketing_id }}">MARKETING</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">NOTE</label>
                            <textarea name="note" type="text" class="form-control" id="" placeholder="Input Note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                {!! Form::close() !!}
                @elseif(Auth::user()->role == 'manager')
                    {!! Form::open(['url' => route('manager.jobsheet.decline'), 'method' => 'post','class'=>'']) !!}
                        <div class="modal-body">
                            {!! Form::hidden('jobsheet_id', $jobsheet->id) !!}
                            {!! Form::hidden('sender_id', Auth::user()->id) !!}
                            <div class="form-group">
                                <label for="">RETURN TO</label>
                                <select name="receiver" id="" class="form-control input-sm">
                                    <option value="{{ $jobsheet->operation_id }}">OPERATION</option>
                                    <option value="{{ $jobsheet->marketing_id }}">MARKETING</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">NOTE</label>
                                <textarea name="note" type="text" class="form-control" id="" placeholder="Input Note"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    {!! Form::close() !!}                
            @endif

        </div>
    </div>
</div>
