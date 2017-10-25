@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                   <div class="panel-heading">
                       <h3 class="panel-heading">PROFIL ANDA</h3>
                   </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3" align="center">
                                <img alt="User Pic" src="img/{{$data->foto}}" style="width: 200px; border-radius:10%;">
                            </div>
                            <div class="col-md-9 col-lg-8">
                                <table class="table table-user-information">
                                    <tr>
                                        <th>Nama </th>
                                        <td>: </td>
                                        <td>{{$data->nama}}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat  </th>
                                        <td>: </td>
                                        <td>{{$data->alamat}}</td>
                                    </tr>
                                    <tr>
                                        <th>Perkerjaan</th>
                                        <td>: </td>
                                        <td>{{$data->pekerjaan}}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>: </td>
                                        <td>{{$data->no_telepon}}</td>
                                    </tr>
                                    <tr>
                                        <th>No Rekening </th>
                                        <td>: </td>
                                        <td>{{$data->no_rekening}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                  <div class="panel-footer">
                      <a href="{{url('profiledit/'.$data->id)}}" data-original-title="Edit this user" data-toggle="tooltio" type="button" class="btn btn-sm btn-warning">
                        <span class="glyphicon glyphicon-edit"></span>    Edit Profil
                      </a>
                  </div>
                </div>
@endsection
            </div>
            </div>
        </div>
