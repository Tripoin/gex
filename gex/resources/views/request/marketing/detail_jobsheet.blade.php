@extends('layouts.app')

@section('content')

	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">

					<!-- JOBSHEET -->
					<div class="panel">
						<div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs nav-tabs-1" role="tablist">
								<li role="presentation" class="active">
									<a href="#jobsheetlist" aria-controls="jobsheetlist" role="tab" data-toggle="tab">{{ $jobsheet->code }}</a>
								</li>
							</ul>

							@include('message.info')

							<!-- Tab panes -->
							<div class="tab-content tab-content-1">
								<div role="tabpanel" class="tab-pane active" id="jobsheetlist">

									@include('request.marketing.jobsheet', [
									'defaultRequestDate'=>$defaultRequestDate,
									'requestedRCIds'=>$requestedRCIds,
									'requestedRCDates'=>$requestedRCDates
									])

								</div>
							</div>
						</div>

					</div>
					<!-- END JOBSHEET -->
				</div>
			</div>
		</div>
	</div>
@endsection


@section('script')

	@include('request._show.scripts');

@endsection

