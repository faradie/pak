@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Berkas Baru Ketua TIM</li>
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
				<th scope="col">Diterima pada
				</th>
				<th scope="col">Action
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($ketua_new_files as $ketua_new_file)
			<tr>
				<th  scope="row">{{$loop->iteration}}</th >
				<td>{{ strtoupper($ketua_new_file->id) }}</td>
				<td>{{$ketua_new_file->nip}}</td>
				<td>{{$ketua_new_file->nama}}</td>
				<td>{{$ketua_new_file->created_at}}</td>
				<td align="center">  
					<form action="{{ route('make_team_for',$ketua_new_file->id) }}"><input class="btn btn-info" type="submit" value="Buat Tim" /></form>
				</td>
			</tr>
			@endforeach
		</tbody>


	</table>
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
