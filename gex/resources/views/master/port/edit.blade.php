<div class="modal fade" id="editModal{{ $port->id }}" 
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
                id="favoritesModalLabel">Edit Port</h4>
            </div>
            {!! Form::model($port, ['url' => route('master.port.update', $port->id), 
              'method' => 'put', 'class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.port._form', [$port->id])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    </button>
                    <span class="pull-right">
                        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>