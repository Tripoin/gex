@if (\Session::has('message-success'))
	<div class="alert alert-success alert-dismissable float-alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{-- <i class="fa fa-shield fa-2x"></i> --}}
		<p><strong>Info</strong> {!! \Session::get('message-success') !!}</p>
	</div>
	<?php
	\Session::forget('message-success');
	?>
@elseif (\Session::has('message-error'))
	<div class="alert alert-error alert-dismissable float-alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{-- <i class="fa fa-shield fa-2x"></i> --}}
		<p><strong>Error</strong> {!! \Session::get('message-error') !!}</p>
	</div>
	<?php
	\Session::forget('message-error');
	?>
@endif
