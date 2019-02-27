@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Semua Pemberitahuan</li>
	</ol>
</nav>
@if(session()->has('result_berhasil'))
<div class="alert alert-success">
	{{ session()->get('result_berhasil') }}
</div>
@endif
@if(session()->has('result_gagal'))
<div class="alert alert-danger">
	{{ session()->get('result_gagal') }}
</div>
@endif
<div class="list-group">
	

	@if (auth()->user()->notifications()->count() != null)
		@foreach (auth()->user()->notifications as $notification)
		<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
			<div class="d-flex w-100 justify-content-between">
				<h5 class="mb-1">{{ $notification->data['notification_subject'] }}</h5>
				<small>{{ $notification->created_at }}</small>
			</div>
			<p class="mb-1">{{ $notification->data['notification_content'] }}</p>
			<small>{{ $notification->data['pj']==null ? "" : "Oleh : ".$notification->data['pj'] }}</small>
		</a>
		@endforeach
	@else
		<!-- Page Content -->
	<div class="text-center text-dark"><h3>Belum ada pemberitahuan</h3></div>
	
	@endif

	
</div>	

@stop
