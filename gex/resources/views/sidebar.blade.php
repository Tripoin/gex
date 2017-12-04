<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li class="sb-nav-child">
                    <a href="{{ route('home') }}" class="{{ Request::path() == 'home' ? 'active':'' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'admin2')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
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
                @endif

                @if(Auth::user()->role == 'operation')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.operation.uncreated') }}" class="{{ Request::path() == 'jobsheet/operation/uncreated' ? 'active':'' }}">Create New</a></li>
                                <li><a href="{{ route('jobsheet.operation.index') }}" class="">Jobsheet</a></li>
                                <li><a href="{{ route('jobsheet.operation.revision') }}" class="">Revision</a>
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
                    <li class="sb-nav-child sb-has-child">
                        <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="request" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.request') }}" class="">Create New</a></li>
                                <li><a href="{{ route('jobsheet.listrequest') }}" class="">List Request</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="report" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.operation.reportall') }}" class="">All Job</a></li>
                                <li><a href="{{ route('jobsheet.operation.reportcompleted') }}" class="">Completed Job</a></li>
                                <li><a href="{{ route('jobsheet.operation.reportuncompleted') }}" class="">Uncompleted Job</a></li>
                                <li><a href="#" class="">Requested Charges</a></li>
                                <li><a href="#" class="">Unrequested Charges</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="sb-master" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('master.customer.index') }}" class="">Customer</a></li>
                                <li><a href="{{ route('master.vendor.index') }}" class="">Vendor</a></li>
                                <li><a href="{{ route('master.document.index') }}" class="">Document</a></li>
                                <li><a href="{{ route('master.unit.index') }}" class="">Unit</a></li>
                                <li><a href="{{ route('master.port.index') }}" class="">Port</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->role == 'marketing')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.marketing.uncreated.index') }}" class="">Uncreated</a></li>
                                <li><a href="{{ route('jobsheet.marketing.index') }}" class="">Jobsheet</a></li>
                                <li><a href="{{ route('jobsheet.marketing.revision') }}" class="">Revision</a>
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
                    <li class="sb-nav-child sb-has-child">
                        <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="request" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.request') }}" class="">Create New</a></li>
                                <li><a href="{{ route('jobsheet.listrequestrc') }}" class="">List Request</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="report" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.marketing.reportjob') }}" class="">Job</a></li>
                                <li><a href="{{ route('jobsheet.marketing.reportcharge') }}" class="">Charges</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="sb-master" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('master.customer.index') }}" class="">Customer</a></li>
                                <li><a href="{{ route('master.vendor.index') }}" class="">Vendor</a></li>
                                <li><a href="{{ route('master.unit.index') }}" class="">Unit</a></li>
                                <li><a href="{{ route('master.document.index') }}" class="">Document</a></li>
                                <li><a href="{{ route('master.term.index') }}" class="">Term</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->role == 'invoice')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#invoice" data-toggle="collapse" class="collapsed"><i class="lnr lnr-bookmark"></i> <span>Invoice Receivable</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="invoice" class="collapse ">
                            <ul class="nav">
                                    <li><a href="{{route('invoice.receivable.uncreatedreceivable') }}" class="">Create New</a></li>
                                    <li><a href="{{route('invoice.receivable') }}" class="">Invoice</a></li>
                                    <li><a href="{{route('invoice.revision.receivable') }}" class="">Revision</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#invoicermb" data-toggle="collapse" class="collapsed"><i class="lnr lnr-bookmark"></i> <span>Invoice Reimbursement</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="invoicermb" class="collapse ">
                            <ul class="nav">
                                    <li><a href="{{route('invoice.reimbursement.uncreatedreimbursement') }}" class="">Create New</a></li>
                                    <li><a href="{{route('invoice.reimbursement') }}" class="">Invoice</a></li>
                                    <li><a href="{{route('invoice.revision.reimbursement') }}" class="">Revision</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="report" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('invoice.report.receivable') }}" class="">Invoice Receivable</a></li>
                                <li><a href="{{ route('invoice.report.reimbursement') }}" class="">Invoice Reimbursement</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->role == 'receivable' || Auth::user()->role == 'approval_receivable')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Receivables</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('/receivable/invoice') }}" class="">Invoice Collection</a></li>
                                <li><a href="{{ route('/receivable/payment') }}" class="">Receivables Payment</a></li>
                                <li><a href="{{ route('/receivable/payment/list') }}" class="">List Payment</a></li>
                                <li><a href="{{ route('/receivable/newreceipt') }}" class="">Create Receipt</a></li>
                                <li><a href="{{ route('/receivable/receipt') }}" class="">List Receipt</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="report" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('/receivable/report/padioff') }}" class="">Paid Off</a></li>
                                <li><a href="{{ route('/receivable/report/overpayment') }}" class="">Overpayment</a></li>
                                <li><a href="{{ route('/receivable/report/insufficient') }}" class="">Insufficient Payment</a></li>
                                <li><a href="{{ route('/receivable/report/duedate') }}" class="">Due Date</a></li>
                                <li><a href="{{ route('/receivable/report/overdue') }}" class="">Overdue</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->role == 'payable')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                
                                <li><a href="{{ route('payable.index') }}" class="">Job Sheet</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="request" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.request') }}" class="">Create New</a></li>
                                <li><a href="{{ route('jobsheet.listrequest') }}" class="">List Request</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#payable" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Payables</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="payable" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('payable.payment') }}" class="">Payables Payment</a></li>
                                <li><a href="{{ route('payable.listpayment') }}" class="">List Payment</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child">
                        <a href="{{ route('payable.report') }}"><i class="lnr lnr-envelope"></i> <span>Report</span></a>
                    </li>
                @endif

                @if(Auth::user()->role == 'approvepay')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('approve.index') }}" class="">Job Sheet</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child">
                        <a href="{{ route('approve.report') }}"><i class="lnr lnr-envelope"></i> <span>Report</span></a>
                    </li>
                @endif

                @if(Auth::user()->role == 'pajak')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('pajak.index') }}" class="">Job Sheet</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child">
                        <a href="{{ route('pajak.report') }}"><i class="lnr lnr-envelope"></i> <span>Report</span></a>
                    </li>
                @endif

                @if(Auth::user()->role == 'pricing')
                    <li class="sb-nav-child sb-has-child">
                        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Job Sheet</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="jobsheet" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.pricing.uncreated') }}" class="">Create New</a></li>
                                <li><a href="{{ route('jobsheet.pricing.index') }}" class="">Jobsheet</a></li>
                                <li><a href="{{ route('jobsheet.pricing.revision') }}" class="">Revision</a>
                                @php 
                                    $notif = \App\Revision::where('role', 'pricing')->count();
                                @endphp
                                    @if($notif>0)
                                        <span class="notif">{{ $notif }}</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#request" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="request" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('jobsheet.request') }}" class="">Create New</a></li>
                                <li><a href="{{ route('jobsheet.listrequest') }}" class="">List Request</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="sb-nav-child sb-has-child">
                        <a href="#sb-master" data-toggle="collapse" class="collapsed"><i class="lnr lnr-rocket"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="sb-master" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{ route('master.vendor.index') }}" class="">Vendor</a></li>
                                <li><a href="{{ route('master.unit.index') }}" class="">Unit</a></li>
                                <li><a href="{{ route('master.document.index') }}" class="">Document</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</div>