@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

<body class="hold-transition register-page" style="background-image: url(img/Danau2.jpg); background-size: 100% 130%;
    background-repeat:repeat;">
    <div id="app">
        <div class="register-box" >


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada beberapa masalah<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('message'))
            <div class="alert alert-info">
              {{session()->get('message')}}
            </div>
            @endif



            <div class="register-box-body">
              <div class="login-logo">
                     <a href="{{ url('/') }}"><img src="img/bulbulhomestay.jpg" alt=""></a>
                 </div><!-- /.login-logo -->
                <form action="{{ url('/daftar') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ old('email') }}"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation"/>
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="row" >


                        <div class="col-xs-4 col-xs-push-8" >
                            <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:#1dc8d9; border-color:#1dc8d9;">{{ trans('adminlte_lang::message.register') }}</button>
                        </div><!-- /.col -->
                    </div>
                </form>

                <a href="{{ url('/login') }}" class="text-center">Saya telah memiliki akun</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    @include('adminlte::auth.terms')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>

</body>

@endsection
