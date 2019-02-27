@extends('layouts.default')
@section('content')
<form action="{{ route('tu_reject',$submission->id) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<div class="form-group">
		<label for="reject_content">Alasan di Tolak</label>
		<textarea class="form-control" id="disposition_content" name="reject_content" placeholder="Isi alasan di tolak" rows="3"></textarea>
	</div>
	
	<button type="submit" class="btn btn-danger">Tolak</button>
</form>
@stop
