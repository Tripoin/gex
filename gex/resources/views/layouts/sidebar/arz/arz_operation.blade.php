<li class="sb-nav-child sb-has-child">
    <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
    <div id="request" class="collapse ">
        <ul class="nav">
            <li><a href="{{ route('operation.request.create') }}" class="">Create New</a></li>
            <li><a href="{{ route('operation.request.list') }}" class="">List Request</a></li>
            {{--<li><a href="{{ route('operation.request.approvable') }}" class="">Approvable</a></li>
            <li><a href="{{ route('operation.request.approved') }}" class="">Approved</a></li>--}}
        </ul>
    </div>
</li>
<li class="sb-nav-child sb-has-child">
    <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
    <div id="report" class="collapse ">
        <ul class="nav">
            <li><a href="{{ route('operation.report.jobsheet.all') }}" class="">All Job</a></li>
            <li><a href="{{ route('operation.report.jobsheet.completed') }}" class="">Completed Job</a></li>
            <li><a href="{{ route('operation.report.jobsheet.uncompleted') }}" class="">Uncompleted Job</a></li>
            <li><a href="{{ route('operation.report.request.requested') }}" class="">Requested Charges</a></li>
            <li><a href="{{ route('operation.report.request.approvable') }}" class="">Approvable Charges</a></li>
            <li><a href="{{ route('operation.report.request.approved') }}" class="">Approved Charges</a></li>
        </ul>
    </div>
</li>
