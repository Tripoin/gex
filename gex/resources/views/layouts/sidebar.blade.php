<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li class="sb-nav-child">
                    <a href="{{ route('home') }}" class="{{ Request::path() == 'home' ? 'active':'' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>

                @include('layouts.sidebar.admin')

                @include('layouts.sidebar.operation')

                @include('layouts.sidebar.marketing')

                @include('layouts.sidebar.pricing')

                @include('layouts.sidebar.payable')

                @include('layouts.sidebar.invoice')

                @include('layouts.sidebar.receivable')

                @include('layouts.sidebar.manager')

                @include('layouts.sidebar.receivable')

                @include('layouts.sidebar.pajak')

            </ul>
        </nav>
    </div>
</div>