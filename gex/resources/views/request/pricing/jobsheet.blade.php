@include('request._show.jobsheet')
<hr>
<div class="row">
    <div class="col-sm-12">
        <!-- PAYABLE -->
        @include('request.pricing.payable', compact('defaultRequestDate','requestedPayableIds','requestedPayableDates'))
        <!-- RC -->
        @include('request.pricing.rc', compact('defaultRequestDate','requestedRCIds','requestedRCDates'))
    </div>
</div>
<BR><BR>