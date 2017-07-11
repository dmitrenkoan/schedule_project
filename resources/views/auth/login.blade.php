@extends('layouts.app')

@section('content')
    <div class="pace  pace-inactive"><div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%" data-progress="99">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div></div>


    <div class="content"></div>
    <div class="login-wrapper">
        <div class="bg-pic">
            <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
                <h2 class="semi-bold text-white">
                    Welcome to the world's first free system for Wellness and Beauty
                </h2>
                <p class="small">
                    © 2013-2017 Surge Ventures Inc.
                </p>
            </div>
        </div>
        <div class="login-container bg-white">

            <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-35 sm-no-margin">
                <a href="https://www.shedul.com/"><img src="login_files/shedul-full-logo-light-bg-63d8928125e4469dabc395245bcf0485bd.png" alt="Shedul full logo light bg" height="22"></a>
                <h3>Login to your account</h3>
                <!-- START Login Form -->
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group email optional employee_email">
                        <input id="email" type="email" placeholder="Email address" class="string email optional input-lg form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group password optional employee_password">
                        <input id="password" type="password" class="password optional input-lg form-control" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                    </div>
                    <input type="hidden" name="remember" value="Y">

                    <input name="commit" value="Login to Shedul" class="btn btn-success full-width btn-lg" type="submit">
                    <div class="row m-b-10 m-t-40">
                        <div class="col-md-12">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Unable to login?
                            </a>
                            <!--<a target="_blank" href="https://shedul.uservoice.com/">Visit Shedul support centre</a>-->
                        </div>
                    </div>
                </form>
                <!--
                <div class="pull-bottom sm-pull-bottom">
                    <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                        <div class="col-sm-9 no-padding m-t-10">
                            <p>
                                Don't have a free Shedul account yet?
                                <a class="btn btn-default m-t-10" href="https://app.shedul.com/sign-up">Register your business</a>
                            </p>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>



@endsection
