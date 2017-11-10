@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissable float-alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{-- <i class="fa fa-shield fa-2x"></i> --}}
		@foreach($errors->getMessages() as $errorMessages)
			@foreach($errorMessages as $errorMessage)
			<p><strong>Error !</strong> {!! $errorMessage !!}</p>
			@endforeach
		@endforeach
	</div>
@endif
