@extends('layouts.default')
@section('content')
<form action="{{ route('sekretariat_reject',$submission->id) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<p> <h3>File Administrasi</h3>(Pilih yang tidak sesuai)</p>
	<div class="form-group">
		@foreach ($item_administrations as $item_administration)
		<div class="checkbox">
			<label for="{{ $item_administration->id }}">
				<input type="checkbox" name="administration_reason[]" value="{{ $item_administration->name }}"> {{ $item_administration->name }}
			</label>
		</div>
		@endforeach
	</div>
	<br>
	<p> <h3>File Pengajuan</h3>(Pilih yang tidak sesuai)</p>
	<div class="form-group">
		@foreach ($submission_items as $submission_item)
		<div class="checkbox">
			<label for="{{ $submission_item->id }}">
				<input type="checkbox" name="item_reason[]" value="{{ $submission_item->id }}"> {{ $submission_item->id." - ".$submission_item->item_name }}
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

<br>
@stop
