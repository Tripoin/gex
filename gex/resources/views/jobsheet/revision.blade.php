@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
	
	<div class="main-content">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <!-- JOB SHEET -->
	                <div class="panel">
	                    <div class="panel-body no-padding">
	                        <div role="tabpanel">
	                            <!-- Nav tabs -->
	                            <ul class="nav nav-tabs nav-tabs-1" role="tablist">
	                                <li role="presentation" class="active">
	                                    <a href="#revisionlist" aria-controls="revisionlist" role="tab" data-toggle="tab">REVISION</a>
	                                </li>
	                            </ul>

	                            <!-- Tab panes -->
	                            <div class="tab-content tab-content-1">
	                                <div role="tabpanel" class="tab-pane active" id="revisionlist">
	                                    <div class="table-responsive">
	                                        <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
	                                            <thead>  
										          <tr>
										          	<th>NO.</th>
										            <th>JOBSHEET</th>  
										            <th>FROM</th>  
										            <th>NOTE</th>
										            <th>ACTION</th>  
										          </tr>  
										        </thead>
										        
										        <tbody>  
										        	@if(count($revisions) > 0)
										        		<?php $no = 1; ?>
											        	@foreach($revisions as $revision)
												            
												            @php
												            	$from = App\User::find($revision->sender);
												            @endphp  
													        
														    @if(Auth::user()->role == 'operation')
														    	<tr>
														          	<td>{{ $no }}</td>
														            <td>
															            <a href="{{ route('operation.jobsheet.show', $revision->jobsheet_id) }}">{{ $revision->jobsheet->code }}</a>
														            </td>
														            <td>{{ $from->name }} - {{ $from->role }}</td>
														            <td>{{ $revision->note }}</td>
														            <td class="text-center">
															            <a href="{{ route('operation.jobsheet.edit', $revision->jobsheet_id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
														            </td>
														         </tr> 
															@elseif(Auth::user()->role == 'marketing')
														        <tr>
														          	<td>{{ $no }}</td>
														            <td>	
															            <a href="{{ route('marketing.jobsheet.show', $revision->jobsheet_id) }}">{{ $revision->jobsheet->code }}</a>
														            </td>
														            <td>{{ $from->name }} - {{ $from->role }}</td>
														            <td>{{ $revision->note }}</td>
														            <td class="text-center">
															            <a href="{{ route('marketing.jobsheet.edit', $revision->jobsheet_id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
														            </td>
														         </tr> 
															@elseif(Auth::user()->role == 'pricing')
																<tr>
														          	<td>{{ $no }}</td>
														            <td>	
															            <a href="{{ route('pricing.jobsheet.show', $revision->jobsheet_id) }}">{{ $revision->jobsheet->code }}</a>
														            </td>
														            <td>{{ $from->name }} - {{ $from->role }}</td>
														            <td>{{ $revision->note }}</td>
														            <td class="text-center">
															            <a href="{{ route('pricing.jobsheet.edit', $revision->jobsheet_id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
														            </td>
														         </tr> 
														        @endif
												          	<?php $no++; ?>
											          	@endforeach
											        @else
											        	<tr>
										                    <td class="text-center" colspan="5">yeah, no revision!</td>
										                </tr>
											        @endif
										        </tbody>  
	                                        </table>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div> 
	                </div>
	                <!-- END JOB SHEET -->
	            </div>
	        </div>
	    </div>
	</div>

@endsection
