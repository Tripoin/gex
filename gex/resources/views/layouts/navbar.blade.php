<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        <a href="{{ route('home') }}"><img src="{{ asset('img/gex3.png') }}" alt="Klorofil Logo" class="img-responsive logo" style="height:2em"></a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                {{-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="lnr lnr-alarm"></i>
                        <span class="badge bg-danger">5</span>
                    </a>
                    <ul class="dropdown-menu notifications">
                        <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                        <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                        <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                        <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                        <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                        <li><a href="#" class="more">See all notifications</a></li>
                    </ul>
                </li> --}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Basic Use</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-info">Info</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>{{Auth::user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="lnr lnr-exit"></i> <span>
                            Logout
                            </span>
                            </a>
                            <form id="logout-form" action="{{url('/logout')}}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="modal-info">
    <div class="modal-dialog modal-small modal-center">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center">Globalindo Information System</h3>
                <p class="text-center">v.1.0.0 (Beta Version)</p>
                <hr>
                <p class="text-center text-muted">Developed By <a href="https://rajadev.com">RajaDev</a></p>
            </div>
        </div>
    </div>
</div>
{{-- END EDIT JOBSHEET --}}