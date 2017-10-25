@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')

<body class="hold-transition login-page" style="background-image: url(img/Danau2.jpg); background-size: 100% 130%;
    background-repeat:repeat;">


    <div id="app">

        <div class="login-box" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 20px 0px, rgba(0, 0, 0, 0.239216) 0px 5px 5px 0px;  ">
            <!-- <div class="login-logo">
                <a href="{{ url('/home') }}"><b>SIBH</b></a>
            </div><!-- /.login-logo -->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>Ada beberapa masalah<br><br>
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

        <div class="login-box-body" >
        <!-- <p class="login-box-msg"> {{ trans('adminlte_lang::message.siginsession') }} </p> -->
         <div class="login-logo">
                <a href="{{ url('/') }}"><img src="img/bulbulhomestay.jpg" alt=""></a>
            </div><!-- /.login-logo -->
        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-6 " style="float:right;">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:#1dc8d9; border-color:#1dc8d9;">{{ trans('adminlte_lang::message.buttonsign') }}</button>
                </div><!-- /.col -->
            </div>
        </form>




        <a href="{{ url('/daftar') }}" class="text-center"style="color:#1dc8d9;">Daftar akun baru</a>

    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

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
