@if(Auth::user()->role == 'manager')
    <li class="sb-nav-child sb-has-child">
        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="jobsheet" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('manager.jobsheet.index') }}" class="">List</a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#approve" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Approve</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="approve" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('approverec.invoice') }}" class="">Invoice Collection</a></li>
                <li><a href="{{ route('approverec.invoicecancel') }}" class="">Invoice Req Cancel</a>
                    @php
                    $notif = \App\Invoice::where('status', 2)->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>REQUEST</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="request" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('manager.request.approvereq.payable')}}" class="">Payable</a></li>
                <li><a href="{{-- route('manager.request.approvable')--}}" class="">Receiveble</a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#payment" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>PAYMENT</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="payment" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('listpayment') }}" class="">List Payable Payment</a></li>
                <li><a href="{{ route('approve.payable') }}" class="">Approved Payable Payment</a></li>
                <li><a href="{{ route('listpaymentrc') }}" class="">List RC Payment</a></li>
                <li><a href="{{ route('approve.paymentrc') }}" class="">Approved RC Payment</a></li>
            </ul>
        </div>
    </li>
    @include("layouts.sidebar.arz.arz_manager");
@endif
