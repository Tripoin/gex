<div class="modal fade" id="createModal" 
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
                id="favoritesModalLabel">Create Unit</h4>
            </div>
            {!! Form::open(['url' => route('master.unit.store'), 
              'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.unit._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                    </button>
                    <span class="pull-right">
                        <div class="">
                          <div class="col-md-4 col-md-offset-2">
                            {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                          </div>
                        </div>
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>