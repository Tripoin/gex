<div class="tab-content tab-content-1">
    <div role="tabpanel" class="tab-pane active" id="jobsheetlist">
        <div class="table-responsive">
            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                <thead>  
		          <tr>
		          	<th>NO.</th>  
		            <th>JOB</th>  
		            <th>INVOICE</th>  
		            <th>SHIPPER</th>  
		            <th>PIUTANG (USD)</th>
		            <th>HUTANG (USD)</th>
		            <th>PROFIT (USD)</th>
		            <th>PIUTANG (IDR)</th>
		            <th>HUTANG (IDR)</th>
		            <th>PROFIT (IDR)</th>
		          </tr>  
		        </thead>
		        <?php $no = 1; ?>  
		        <tbody>  
		        	@foreach($jobsheets as $jobsheet)
		        		<tr>
		        			<td>{{ $no }}</td>
		        			<td>{{ $jobsheet->code }}</td>
		        		</tr>
		        		$no++
		        	@endforeach
		        </tbody>  
            </table>
        </div>
    </div>
</div>