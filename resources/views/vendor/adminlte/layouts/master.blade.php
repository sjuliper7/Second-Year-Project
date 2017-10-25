<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('adminlte::layouts.partialweb.htmlheader')
    @include('adminlte::layouts.partialweb.htmlheader')
@show

<body>

@include('adminlte::layouts.partialweb.mainheader')

	@yield('main-content')

@include('adminlte::layouts.partialweb.mainfooter')
@include('adminlte::layouts.partialweb.scripts')
</body>
</html>
