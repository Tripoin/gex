@if(Auth::user()->role == 'pajak')
    <li class="sb-nav-child sb-has-child">
        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="jobsheet" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('pajak.jobsheet') }}" class="">All Jobsheet</a></li>
                <li><a href="{{ route('pajak.invoice') }}" class="">Invoice Collection</a></li>
            </ul>
        </div>
    </li>
    @include("layouts.sidebar.arz.arz_pajak");
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-master" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('master.rate.index') }}" class="">Rate</a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child">
        <a href="{{ route('pajak.report') }}"><i class="lnr lnr-envelope"></i> <span>Report</span></a>
    </li>
@endif