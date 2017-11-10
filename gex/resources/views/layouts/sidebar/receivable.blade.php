@if(Auth::user()->role == 'receivable')
    <li class="sb-nav-child sb-has-child">
        <a href="#jobsheet" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Receivables</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="jobsheet" class="collapse ">
            <ul class="nav">
                <li><a href="{{ route('receivable.invoice') }}" class="">Invoice Collection</a></li>
                <li><a href="{{ route('receivable.payment.create') }}" class="">Receivables Payment</a></li>
                <li><a href="{{ route('receivable.payment.createover') }}" class="">Receivables Overpayment</a></li>
                <li><a href="{{ route('receivable.profit.index') }}" class="">Profit Marketing</a></li>
                <li><a href="{{ route('receivable.history') }}" class="">Invoice History</a></li>
                <li><a href="{{-- route('receivable.payment/list') --}}" class="">List Payment</a></li>
                <li><a href="{{-- route('receivable.newreceipt') --}}" class="">Create Receipt</a></li>
                <li><a href="{{-- route('receivable.receipt') --}}" class="">List Receipt</a></li>
            </ul>
        </div>
    </li>
    <!-- <li class="sb-nav-child sb-has-child">
                        <a href="#report" data-toggle="collapse" class="collapsed"><i class="lnr lnr-book"></i> <span>Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="report" class="collapse ">
                            <ul class="nav">
                                <li><a href="{{-- route('receivable.report.padioff') --}}" class="">Paid Off</a></li>
                                <li><a href="{{-- route('receivable.report.overpayment') --}}" class="">Overpayment</a></li>
                                <li><a href="{{-- route('receivable.report.insufficient') --}}" class="">Insufficient Payment</a></li>
                                <li><a href="{{-- route('receivable.report.duedate') --}}" class="">Due Date</a></li>
                                <li><a href="{{-- route('receivable.report.overdue') --}}" class="">Overdue</a></li>
                            </ul>
                        </div>
                    </li> -->
@endif