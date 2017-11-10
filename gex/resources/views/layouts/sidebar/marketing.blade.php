@if(Auth::user()->role == 'marketing')
    <li class="sb-nav-child sb-has-child">
        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="jobsheet" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('marketing.jobsheet.uncreated') }}" class="">Uncreated</a></li>
                <li><a href="{{ route('marketing.jobsheet.index') }}" class="">Jobsheet</a></li>
                <li><a href="{{ route('marketing.jobsheet.revision') }}" class="">Revision</a>
                    @php
                    $notif = \App\Revision::where('receiver', Auth::user()->id)->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
            </ul>
        </div>
    </li>
    @include("layouts.sidebar.arz.arz_marketing");
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-master" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('master.customer.index') }}" class="">Customer</a></li>
                <li><a href="{{ route('master.vendor.index') }}" class="">Vendor</a></li>
                <li><a href="{{ route('master.unit.index') }}" class="">Unit</a></li>
                <li><a href="{{ route('master.document.index') }}" class="">Receivable</a></li>
                <li><a href="{{ route('master.term.index') }}" class="">Term</a></li>
            </ul>
        </div>
    </li>
@endif