<li class="sb-nav-child sb-has-child">
    <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
    <div id="request" class="collapse ">
        <ul class="nav">
            <li><a href="{{ route('marketing.request-rc.create') }}" class="">Create New</a></li>
            <li><a href="{{ route('marketing.request-rc.list') }}" class="">List Request</a></li>
            <li><a href="{{ route('marketing.request-rc.approvable') }}" class="">Approvable</a></li>
            <li><a href="{{ route('marketing.request-rc.approved') }}" class="">Approved</a></li>
        </ul>
    </div>
</li>
<li class="sb-nav-child sb-has-child">
    <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
    <div id="report" class="collapse ">
        <ul class="nav">
            <li><a href="{{ route('marketing.report.jobsheet.all') }}" class="">All Job</a></li>
            <li><a href="{{ route('marketing.report.jobsheet.completed') }}" class="">Completed Job</a></li>
            <li><a href="{{ route('marketing.report.jobsheet.uncompleted') }}" class="">Uncompleted Job</a></li>
            <li><a href="{{ route('marketing.report.request-rc.requested') }}" class="">Requested Charges</a></li>
            <li><a href="{{ route('marketing.report.request-rc.approvable') }}" class="">Approvable Charges</a></li>
            <li><a href="{{ route('marketing.report.request-rc.approved') }}" class="">Approved Charges</a></li>
        </ul>
    </div>
</li>