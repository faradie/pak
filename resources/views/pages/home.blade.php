@extends('layouts.default')
@section('content')
    @if(auth()->user()->hasRole('admin'))
        Dashboard Admin
    @else
        Dashboard Pemohon
    @endif
@stop