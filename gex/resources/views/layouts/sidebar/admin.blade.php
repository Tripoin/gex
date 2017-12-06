@if(Auth::user()->role == 'admin' || Auth::user()->role == 'admin2')
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-master" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('master.role.index') }}" class="">Role</a></li>
                <li><a href="{{ route('master.user.index') }}" class="">User</a></li>
                <li><a href="{{ route('master.customer.index') }}" class="">Customer</a></li>
                <li><a href="{{ route('master.vendor.index') }}" class="">Vendor</a></li>
                <li><a href="{{ route('master.bank.index') }}" class="">Bank</a></li>
                <li><a href="{{ route('master.document.index') }}" class="">Document</a></li>
                <li><a href="{{ route('master.port.index') }}" class="">Port</a></li>
                <li><a href="{{ route('master.rate.index') }}" class="">Rate</a></li>
                <li><a href="{{ route('master.unit.index') }}" class="">Unit</a></li>
                <li><a href="{{ route('master.term.index') }}" class="">Term</a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-operation-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Operation</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-operation-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('operation.jobsheet.uncreated') }}" class="{{ Request::path() == 'jobsheet/operation/uncreated' ? 'active':'' }}">JobSheet - Create</a></li>
                    <li><a href="{{ route('operation.jobsheet.index') }}" class="">Jobsheet - Index</a></li>
                    <li><a href="{{ route('operation.jobsheet.revision') }}" class="">JobSheet - Revision</a>
                        @php
                        $notif = \App\Revision::where('receiver', Auth::user()->id)->count();
                        @endphp
                        @if($notif>0)
                            <span class="notif">{{ $notif }}</span>
                        @endif
                    </li>
                    <hr>

                    <hr>
                @endif
                <!--<li><a href="{{-- route('operation.jobsheet.reportall') --}}" class="">Report - All Job</a></li>
                <li><a href="{{-- route('operation.jobsheet.reportcompleted') --}}" class="">Report - Completed Job</a></li>
                <li><a href="{{-- route('operation.jobsheet.reportuncompleted') --}}" class="">Report - Uncompleted Job</a></li>
                <li><a href="{{-- route('jobsheet.report.unrequested') --}}" class="">Report - Unreq Charges</a></li>-->
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-marketing-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Marketing</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-marketing-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('marketing.jobsheet.uncreated') }}" class="">Jobsheet - Uncreated</a></li>
                    <li><a href="{{ route('marketing.jobsheet.index') }}" class="">Jobsheet - Index</a></li>
                    <li>
                        <a href="{{ route('marketing.jobsheet.revision') }}" class="">Jobsheet - Revision</a>
                        @php
                        $notif = \App\Revision::where('receiver', Auth::user()->id)->count();
                        @endphp
                        @if($notif>0)
                            <span class="notif">{{ $notif }}</span>
                        @endif
                    </li>
                    <hr>
                    <li><a href="{{ route('marketing.request-rc.create') }}" class="">Request - Create</a></li>
                    <li><a href="{{ route('marketing.request-rc.list') }}" class="">Request - List</a></li>
                    <hr>
                @endif
                <li><a href="{{-- route('jobsheet.marketing.reportjob') --}}" class="">Report - Job</a></li>
                <li>
                    <a href="{{-- route('jobsheet.marketing.reportcharge') --}}" class="">Report - Charges</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-invoice-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Invoice</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-invoice-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{route('invoice.receivable.uncreatedreceivable') }}" class="">Receivable - Create</a></li>
                    <li><a href="{{route('invoice.receivable.index') }}" class="">Receivable - Invoice</a></li>
                    <li><a href="{{route('invoice.revision.receivable') }}" class="">Receivable - Revision</a></li>
                    <hr>
                    <li><a href="{{route('invoice.reimbursement.uncreatedreimbursement') }}" class="">Reimbursement - Create</a></li>
                    <li><a href="{{route('invoice.reimbursement') }}" class="">Reimbursement - Invoice</a></li>
                    <li><a href="{{route('invoice.revision.reimbursement') }}" class="">Reimbursement - Revision</a></li>
                    <hr>
                @endif
                <li><a href="{{ route('invoice.report.receivable') }}" class="">Report - Receivable</a></li>
                <li><a href="{{ route('invoice.report.reimbursement') }}" class="">Report - Reimbursement</a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-receivable-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Receivable</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-receivable-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('receivable.invoice') }}" class="">Invoice Collection</a></li>
                    <li><a href="{{ route('receivable.payment.create') }}" class="">Receivables Payment</a></li>
                    <li><a href="{{ route('receivable.payment.createover') }}" class="">Receivables Overpayment</a></li>
                    <li><a href="{{ route('receivable.history') }}" class="">Invoice History</a></li>
                @endif
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-pricing-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Pricing</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-pricing-role" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('pricing.jobsheet.uncreated') }}" class="">Jobsheet - Create</a></li>
                <li><a href="{{ route('pricing.jobsheet.index') }}" class="">Jobsheet - Index</a></li>
                <li><a href="{{ route('pricing.jobsheet.revision') }}" class="">Jobsheet - Revision</a>
                    @php
                    $notif = \App\Revision::where('role', 'pricing')->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
                <hr>
                <li><a href="{{ route('pricing.request.create') }}" class="">Request - Create</a></li>
                <li><a href="{{ route('pricing.request.list') }}" class="">Request - List</a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-payable-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Payable</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-payable-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('payable.jobsheet.index') }}" class="">JobSheet - Index</a></li>
                    <hr>
                    <li><a href="{{ route('payable.request.create') }}" class="">Request - Create</a></li>
                    <li><a href="{{ route('payable.request.list') }}" class="">Request - List Payable</a></li>
                    <li><a href="{{ route('payable.overpayment') }}" class="">Request - Over Payment</a></li>
                    <li><a href="{{ route('payable.listoverpayment') }}" class="">List Over Payment</a></li>
                    <hr>
                    <li><a href="{{-- route('payable.payment.payable') --}}" class="">Payables Payment</a>
                        @php
                        $notif = \App\RequestModel::where('status','requested')->where('type','!=','marketing')->count();
                        @endphp
                        @if($notif>0)
                            <span class="notif">{{ $notif }}</span>
                        @endif
                    </li>
                    <li><a href="{{ route('request.payable.payable_terms') }}">Payable Terms</a></li>
                    <li><a href="{{ route('payable.listpayment') }}" class="">Payables List Payment</a></li>
                    <hr>
                    <li><a href="{{ route('payable.payment.rc') }}" class="">RC Payment</a>
                        @php
                        $notif = \App\RequestModel::where('status','requested')->where('type','marketing')->count();
                        @endphp
                        @if($notif>0)
                            <span class="notif">{{ $notif }}</span>
                        @endif
                    </li>
                    <li><a href="{{ route('payable.listpaymentrc') }}" class="">List Payment</a></li>
                    <hr>
                @endif
                <li class=""><a href="{{ route('payable.report') }}"><span>Report</span></a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-approval-receivable-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Approval Receivable</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-approval-receivable-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{-- route('approverec.invoice') --}}" class="">Invoice Collection</a></li>
                    <li><a href="{{-- route('approverec.invoicecancel') --}}" class="">Invoice Req Cancel</a></li>
                @endif
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-approval-payable-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Approval Payable</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-approval-payable-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{-- route('listpayment') ---}}" class="">List Payable Payment</a></li>
                    <li><a href="{{-- route('approve.payable') --}}" class="">Approved Payable Payment</a></li>
                    <li><a href="{{-- route('listpaymentrc') --}}" class="">List RC Payment</a></li>
                    <li><a href="{{-- route('approve.paymentrc') --}}" class="">Approved RC Payment</a></li>
                    <hr>
                @endif
                <li class=""><a href="{{-- route('approve.report') --}}"><span>Report</span></a></li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#sb-pajak-role" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Pajak</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="sb-pajak-role" class="collapse ">
            <ul class="nav">
                @if(Auth::user()->role == 'admin')
                    <li><a href="{{-- route('pajak.jobsheet') --}}" class="">Jobsheet - All Index</a></li>
                    <li><a href="{{-- route('pajak.invoice') --}}" class="">Invoice Collection</a></li>
                    <hr>
                @endif
                <li><a href="{{-- route('pajak.report') --}}"><span>Report</span></a></li>
            </ul>
        </div>
    </li>
@endif
