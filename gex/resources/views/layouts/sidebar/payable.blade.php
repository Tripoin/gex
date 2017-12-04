@if(Auth::user()->role == 'payable')
    <li class="sb-nav-child sb-has-child">
        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="jobsheet" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('payable.jobsheet.index') }}" class="">Job Sheet</a></li>
            </ul>
        </div>
    </li>
    @include("layouts.sidebar.arz.arz_payable_request")
    <li class="sb-nav-child sb-has-child">
        <a href="#payable" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Payment</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="payable" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('payable.payment') }}" class="">Payables Payment</a>
                    @php
                    $notif = \App\RequestModel::where('status','requested')->where('type','!=','marketing')->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
                <li><a href="{{ route('request.payable.payable_terms') }}">Payable Terms</a></li>
                <li><a href="{{ route('payable.listpayment') }}">Payable List</a></li>
                <hr>
                <li><a href="{{ route('payable.payment.rc') }}" class="">RC Payment</a>
                    @php
                    $notif = \App\RequestModel::where('status','requested')->where('type','marketing')->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
                <li><a href="{{ route('payable.listpaymentrc') }}">RC List</a></li>
            </ul>
        </div>
    </li>
    @include("layouts.sidebar.arz.arz_payable_report");
@endif
