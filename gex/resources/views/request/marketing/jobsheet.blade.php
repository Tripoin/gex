@include('request._show.jobsheet')
<hr>
<div class="row">
    <div class="col-sm-12">
        <!-- RC -->
        @include('request.marketing.rc', compact('defaultRequestDate','requestedRCIds','requestedRCDates'))
    </div>
</div>
<BR><BR>