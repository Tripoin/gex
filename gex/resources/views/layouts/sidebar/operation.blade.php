@if(Auth::user()->role == 'operation')
    <li class="sb-nav-child sb-has-child">
        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="jobsheet" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('operation.jobsheet.uncreated') }}" class="{{ Request::path() == 'jobsheet/operation/uncreated' ? 'active':'' }}">Create New</a></li>
                <li><a href="{{ route('operation.jobsheet.index') }}" class="">Jobsheet</a></li>
                <li><a href="{{ route('operation.jobsheet.revision') }}" class="">Revision</a>
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
    
    @include("layouts.sidebar.arz.arz_operation")

    <li class="sb-nav-child sb-has-child">
        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-master" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('master.customer.index') }}" class="">Customer</a></li>
                <li><a href="{{ route('master.vendor.index') }}" class="">Vendor</a></li>
                <li><a href="{{ route('master.document.index') }}" class="">Document</a></li>
                <li><a href="{{ route('master.document.index_payable') }}" class="">Payable</a></li>
                <li><a href="{{ route('master.unit.index') }}" class="">Unit</a></li>
                <li><a href="{{ route('master.port.index') }}" class="">Port</a></li>
            </ul>
        </div>
    </li>
@endif