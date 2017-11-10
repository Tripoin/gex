<div class="modal fade" id="showModal{{ $bank->id }}" 
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
                id="favoritesModalLabel">Show Bank</h4>
            </div>
            {!! Form::model($bank, ['url' => '#','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.bank._form',[$bank->id])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Tutup
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>