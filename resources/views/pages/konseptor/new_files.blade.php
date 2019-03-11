@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Berkas Baru Konseptor Prakom</li>
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
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari dengan nama..">
<div class="table-responsive">
	<table id="myTable" class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No
				</th>
				<th scope="col">No Pengajuan
				</th>
				<th scope="col">NIP
				</th>
				<th scope="col">Nama
				</th>
				<th scope="col">Dibuat pada
				</th>
				<th scope="col">Disposisi
				</th>
				<th scope="col">Surat Pengantar
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($konseptor_files as $konseptor_file)
			<tr>
				<th  scope="row">{{$loop->iteration}}</th >
				<td>{{ strtoupper($konseptor_file->id) }}</td>
				<td>{{$konseptor_file->pemohonID}}</td>
				<td>{{$konseptor_file->nama}}</td>
				<td>{{$konseptor_file->created_at}}</td>
				<td ><button title="Disposisi" data-mytitle="{{ $konseptor_file->id }}" data-mydisp="{{ $konseptor_file->disposition_content }}" data-myby="{{ $konseptor_file->nip }}" data-toggle="modal" data-target="#disposisiModal" class="btn btn-dark"><i class="fa fa-tags" aria-hidden="true"></i>
				</button></td>
				<td align="center">  
					<form action="{{ route('konseptor_make_supeng',$konseptor_file->id) }}" enctype="multipart/form-data" method="POST" >
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="form-row">
							<div class="form-group">
							<input accept="application/pdf" type="file" value="{{ old('supeng') }}" name="supeng" id="supeng" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required />
							<label for="supeng"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
							@if ($errors->has('supeng'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first(supeng) }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<button class="btn btn-info" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
</button>
							
						</div>
						</div>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>


	</table>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><p id="p1"></p></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<p id="p2">isi</p>
			</div>
			<div class="modal-footer">
				<p id="by"></p>
			</div>

		</div>
	</div>
</div>

<script>
	function myFunction() {
              // Declare variables 
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");

              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
              	td = tr[i].getElementsByTagName("td")[1];
              	if (td) {
              		txtValue = td.textContent || td.innerText;
              		if (txtValue.toUpperCase().indexOf(filter) > -1) {
              			tr[i].style.display = "";
              		} else {
              			tr[i].style.display = "none";
              		}
              	} 
              }
          }
      </script>
      @stop
