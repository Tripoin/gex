<div class="modal fade" id="createModal" 
     tabindex="0" role="dialog" 
     aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" 
                data-dismiss="modal" 
                aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" 
                id="favoritesModalLabel">Create New Customer</h4>
            </div>
            {!! Form::open(['url' => route('master.customer.store'), 
              'method' => 'post','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.customer._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                    </button>
                    <span class="pull-right">
                        <div class="">
                          <div class="col-md-4">
                            {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                          </div>
                        </div>
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>