@extends('layouts.default')
@section('content')
<form action="{{ route('tu_reject',$submission->id) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<div class="form-group">
		@foreach ($item_administrations as $item_administration)
		<div class="checkbox">
			<label for="{{ $item_administration->id }}">
				<input type="checkbox" name="reason[]" value="{{ $item_administration->item_name }}"> {{ $item_administration->item_name }}
			</label>
		</div>
		@endforeach
	</div>
	<div class="form-group">
		<label for="reject_content">Alasan tambahan di Tolak</label>
		<textarea class="form-control" id="disposition_content" name="reject_content" placeholder="Boleh diisi atau dikosongi" rows="3"></textarea>
	</div>
	
	<button type="submit" class="btn btn-danger">Tolak</button>
</form>
@stop
