<div class="modal fade" id="showModal{{ $port->id }}" 
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
                id="favoritesModalLabel">Show Port</h4>
            </div>
            {!! Form::model($port, ['url' => '#','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.port._form',[$port->id])
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