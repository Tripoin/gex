<div class="modal fade" id="editModal{{ $document->id }}" 
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
                id="favoritesModalLabel">Edit Document</h4>
            </div>
            {!! Form::model($document, ['url' => route('master.document.update', $document->id), 
              'method' => 'put', 'class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.document._form', [$document->id])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    </button>
                    <span class="pull-right">
                        <div class="">
                          <div class="col-md-4 col-md-offset-2">
                            {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                          </div>
                        </div>
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>