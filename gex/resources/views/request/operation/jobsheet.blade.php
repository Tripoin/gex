@include('request._show.jobsheet')
<hr>
<div class="row">
    <div class="col-sm-12">
        <!-- PAYABLE -->
        @include('request.operation.payable', compact('defaultRequestDate','requestedPayableIds','requestedPayableDates'))
    </div>
</div>
<BR><BR>