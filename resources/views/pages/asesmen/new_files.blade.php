@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Berkas Baru Asesmen</li>
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
				<th scope="col">Action
				</th>
				<th scope="col">Disposisi
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($asesmen_files as $asesmen_file)
			<tr>
				<th  scope="row">{{$loop->iteration}}</th >
				<td>{{ strtoupper($asesmen_file->id) }}</td>
				<td>{{$asesmen_file->id_pemohon}}</td>
				<td>{{$asesmen_file->nama}}</td>
				<td>{{$asesmen_file->created_at}}</td>
				<td align="center">  
					<form action="{{ route('asesmen_forward_files',$asesmen_file->id) }}"><input class="btn btn-info" type="submit" value="Teruskan" /></form>
				</td>
				<td ><button title="Disposisi" data-mytitle="{{ $asesmen_file->id }}" data-mydisp="{{ $asesmen_file->disposition_content }}" data-myby="{{ $asesmen_file->nip }}" data-toggle="modal" data-target="#disposisiModal" class="btn btn-dark"><i class="fa fa-tags" aria-hidden="true"></i>
				</button></td>
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
              	td = tr[i].getElementsByTagName("td")[2];
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
