@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Riwayat Pengajuan anda</li>
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
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari dengan No Pengajuan..">
<div class="table-responsive">
	<table id="myTable" class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No
				</th>
				<th scope="col">No Pengajuan
				</th>
				<th scope="col">Jenis
				</th>
				<th scope="col">Dibuat pada
				</th>
				<th scope="col">Status
				</th>
				<th scope="col">Periode Mulai
				</th>
				<th scope="col">Periode Akhir
				</th>
				<th scope="col">Action
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($submission_histories as $submission_history)
			<tr>
				<th  scope="row">{{$loop->iteration}}</th >
				<td>{{ strtoupper($submission_history->id) }}</td>
				<td>{{ strtoupper($submission_history->submissionType) }}</td>
				<td>{{ $submission_history->created_at }}</td>
				<td>{{ strtoupper($submission_history->submission_status) }}</td>
				<td>{{ \Carbon\Carbon::parse($submission_history->starts)->format('d / M / Y') }}</td>
				<td>{{ \Carbon\Carbon::parse($submission_history->ends)->format('d / M / Y') }}</td>
				<td align="center">  
					@if ($submission_history->submissionType == "terampil")
					<form action="{{ route('fetch_history_detail',$submission_history->id) }}"><input class="btn btn-info" type="submit" value="Lihat" /></form>
					@else
					
					@endif
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
              	td = tr[i].getElementsByTagName("td")[0];
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
