@extends('layouts.default')
@section('content')
<form action="{{ route('tu_disposition',$submission->id) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<div class="form-group">
		<label for="disposition_content">Ajukan Disposisi</label>
		<textarea class="form-control" id="disposition_content" name="disposition_content" placeholder="Isi Disposisi" rows="3"></textarea>
	</div>
	
	<button type="submit" class="btn btn-primary">Terima</button>
</form>
@stop
