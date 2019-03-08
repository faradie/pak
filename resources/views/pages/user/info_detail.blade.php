@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">{{ $info->information_title }}</li>
	</ol>
</nav>

<div class="card">
  <div class="card-header">
    Dibuat pada : {{ \Carbon\Carbon::parse($info->created_at)->format('d/M/Y H:i') }}
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>{{ $info->information_content }}</p>
      <footer class="blockquote-footer">Dibuat oleh <cite title="{{ $info->nip }}">{{ $info->nip }}</cite></footer>
    </blockquote>
  </div>
</div>
<br>
@if (auth()->user()->hasRole('admin'))
	<form action="{{ route('create_information') }}"><input class="btn btn-primary btn-block" type="submit" value="Edit" />
	<input class="btn btn-danger btn-block" type="submit" value="Hapus" /></form>
@endif
<br>
@stop
