@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>
<div class="row">
        <div class="col-sm-3 col-md-3 col-xs-12">
                <div class="card">
                        <img src="data:image/jpeg;base64,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" class="card-img-top img-thumbnail" alt="Responsive image">
                </div>
        </div>
            <div class="col-sm-9 col-md-9 col-xs-12">

                    <div class="card">
                            <div class="card-header">
                                    <h3>{{auth()->user()->id}} - <small class="text-muted">{{auth()->user()->nama}}</small></h3>   
                            </div>
                            <table class="table">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Email</th>
                                            <td>{{auth()->user()->email}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Tempat, tanggal lahir</th>
                                            <td>{{auth()->user()->birth_place}}, {{auth()->user()->birth_date}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Jenis Kelamin</th>
                                            <td>{{auth()->user()->gender == null ? 'Jenis kelamin belum diatur' : auth()->user()->gender}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Alamat</th>
                                            <td>{{auth()->user()->address}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Kredit</th>
                                            <td>{{auth()->user()->credit}}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                            {{-- <ul class="list-group list-group-flush">
                              <li class="list-group-item">Alamat : {{auth()->user()->address}}</li>
                              <li class="list-group-item">{{auth()->user()->email}}</li>
                              <li class="list-group-item">Credit : {{auth()->user()->credit}}</li>
                              <li class="list-group-item">{{auth()->user()->credit}}</li>
                            </ul> --}}
                          </div>
                                     
                    
                           
                         
            </div>
</div>
    @if(auth()->user()->hasRole('admin'))<!-- Icon Cards-->
    
        Dashboard Admin
    
            {{-- <!-- Breadcrumbs-->
          <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">404 Error</li>
              </ol>
    
              <!-- Page Content -->
              <h1 class="display-1">404</h1>
              <p class="lead">Page not found. You can
                <a href="javascript:history.back()">go back</a>
                to the previous page, or
                <a href="index.html">return home</a>.</p> --}}
    @else
        Dashboard Pemohon
    @endif
@stop