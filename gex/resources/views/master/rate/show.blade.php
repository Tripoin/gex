<div class="modal fade" id="showModal{{ $rate->id }}" 
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
                id="favoritesModalLabel">Show Rate</h4>
            </div>
            {!! Form::model($rate, ['url' => '#','class'=>'form-horizontal']) !!}
                <div class="modal-body">
                    @include('master.rate._form',[$rate->id])
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