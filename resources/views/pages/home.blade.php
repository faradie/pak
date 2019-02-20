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
                        <img src="{{ auth()->user()->photoUrl == null ? asset('dupakFiles/avatar_employee.png') : asset('dupakFiles/' . auth()->user()->photoUrl )}}" class="card-img-top img-thumbnail" alt="Responsive image">
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
                                            <th scope="row">Nomor Serial Kartu</th>
                                            <td>{{auth()->user()->CardSerialNumber}}</td>
                                          </tr>
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
                                            <th scope="row">Jabatan Pranata Komputer</th>
                                            <td>{{$positionName->group}} - {{$positionName->position}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Alamat</th>
                                            <td>{{auth()->user()->address}}</td>
                                          </tr>
                                          
                                          <tr>
                                            <th scope="row">Angka Kredit</th>
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