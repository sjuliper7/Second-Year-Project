@extends('adminlte::layouts.errors')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.serviceunavailable') }}
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red"><i class="fa fa-warning text-red"></i></h2>
        <div class="error-content">
            <h3> Oops! Anda HARUS Punya Akun</h3>
            <p>
                Jika Anda ingin melakukan pembookingan Anda terlebih dahulu harus LOGIN!! di sitem kami
                <a href="{{url('login')}}">Login    </a> <a href="{{url('')}}">Kembali</a>
            </p>
        </div>
    </div><!-- /.error-page -->
@endsection
