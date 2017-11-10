@if(Auth::user()->role == 'invoice')
    <li class="sb-nav-child sb-has-child">
        <a href="#invoice" data-toggle="collapse" class="collapsed"><i class="lnr lnr-bookmark"></i> <span>Invoice Receivable</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="invoice" class="collapse ">
            <ul class="nav">
                <li><a href="{{route('invoice.receivable.uncreated') }}" class="">Create New</a></li>
                <!-- <li><a href="{{route('invoice.receivable.uncreatedreceivable') }}" class="">Create New</a></li> -->
                <li><a href="{{route('invoice.receivable.index') }}" class="">Invoice</a></li>
                <li><a href="{{route('invoice.revision.receivable') }}" class="">Revision</a>
                    @php
                    $notif = \App\Invoice::where('status', 5)->where('type','receivable')->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
            </ul>
        </div>
    </li>
    <li class="sb-nav-child sb-has-child">
        <a href="#invoicermb" data-toggle="collapse" class="collapsed"><i class="lnr lnr-bookmark"></i> <span>Invoice Reimbursement</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <div id="invoicermb" class="collapse ">
            <ul class="nav">
                <li><a href="{{route('invoice.reimbursement.uncreatedreimbursement') }}" class="">Create New</a></li>
                <li><a href="{{route('invoice.reimbursement') }}" class="">Invoice</a></li>
                <li><a href="{{route('invoice.revision.reimbursement') }}" class="">Revision</a>
                    @php
                    $notif = \App\Invoice::where('status', 5)->where('type','reimbursement')->count();
                    @endphp
                    @if($notif>0)
                        <span class="notif">{{ $notif }}</span>
                    @endif
                </li>
            </ul>
        </div>
    </li>
    @include("layouts.sidebar.arz.arz_invoice");
@endif