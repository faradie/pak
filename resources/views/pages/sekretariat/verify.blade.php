@extends('layouts.default')
@section('content')
<script src="{{ asset('assets/js/pdfobject.min.js') }}"></script>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Verifikasi Permohonan {{ strtoupper($submission->id) }}</li>
	</ol>
</nav>
<h3>Berkas Administrasi</h3>
<div class="list-group">
	@foreach ($administrations as $administration)
	<a href="#" id="{{ $administration->nameID }}" class="list-group-item list-group-item-action">
		{{ $administration->name }}
	</a>
	<div id="{{ "di".$administration->nameID }}" style="display:none">
		<div>
			<iframe onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:500px;width:150%;border:none;overflow:hidden;" src="{{ URL::to('/') . '/dupakFiles/' . $administration->fileUrl }}"></iframe>
		</div>
	</div> 

	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			$('{{ "#".$administration->nameID }}').click(function(){
				$("{{ "#di".$administration->nameID }}").dialog();
			}); 
		});      

	</script>
	@endforeach
</div>
<br>
<h3>File Pengajuan</h3>

<div class="list-group">
	@foreach ($files as $file)
	<a href="#" id="{{ $file->id }}" class="list-group-item list-group-item-action">
		{{ $file->id ." - Pengali : ".$file->times." - ".strtoupper($file->type)." - ".$file->item_name }}
	</a>
	<div id="{{ "di".$file->id }}" style="display:none">
		<div>
			<iframe onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:500px;width:150%;border:none;overflow:hidden;" src="{{ URL::to('/') . '/dupakFiles/' . $file->fileUrl }}"></iframe>
		</div>
	</div> 

	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			$('{{ "#".$file->id }}').click(function(){
				$("{{ "#di".$file->id }}").dialog();
			}); 
		});      

	</script>
	@endforeach
</div>
<br>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <form action="{{ route('sekretariat_verify_files',$submission->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input class="btn btn-danger" name="submitbutton" type="submit" value="Tolak" />
        <input class="btn btn-primary" name="submitbutton" type="submit" value="Teruskan" />
      </form>
      
    </div>
  </div>
</div>
<br>

@stop
