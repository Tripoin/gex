<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    @include('layouts.head')
    <title>Gex Cargo-Login</title>
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="{{ asset('img/gex3.png') }}" alt="Klorofil Logo" style="opacity:0.7"></div>
                                <p class="lead">Login to your account</p>
                            </div>

                            {!! Form::open(['url'=>route('login'),'method'=>'post','class'=>'form-auth-small']) !!}
                                
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Username</label>
                                    {!! Form::text('username', null, ['class'=>'form-control','placeholder'=>'Username']) !!}
                                    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    {!! Form::password('password', ['id'=>'signin-password','class'=>'form-control','placeholder'=>'Password']) !!}
                                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                </div>

                                <div class="form-group clearfix"></div>

                                {!! Form::submit('LOGIN', ['class'=>'btn btn-primary btn-lg btn-block']) !!}

                            {!! Form::close() !!}
                            <!-- <form class="form-auth-small" action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Username</label>
                                    <input type="text" class="form-control" id="signin-email" placeholder="Username" name="username" autocomplete="false">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" placeholder="Password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group clearfix">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            </form> -->
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">PT. Globalindo Express Cargo</h1>
                            <p>Information System</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>

</html>
