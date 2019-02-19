@extends('layouts.default')
@section('content')

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari dengan nama..">
<div class="table-responsive">
  <table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No
        </th>
        <th scope="col">NIP
        </th>
        <th scope="col">Nama
        </th>
        <th scope="col">Angka Kredit
        </th>
        <th scope="col">Role
        </th>
        <th scope="col">Action
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th  scope="row">{{$loop->iteration}}</th >
        <td>{{$user->id}}</td>
        <td>{{$user->nama}}</td>
        <td>{{$user->credit}}</td>
        <td>{{$user->getRoleNames()}}</td>
        <td >

          <div class="btn-group" role="group" aria-label="...">
            <a class="btn btn-info" name="detailData" type="button" value="Detail" href="{{ route('editData',$user->id) }}">Detail</a>
            <a class="btn btn-dark" name="editData" type="button" value="Edit" href="{{ route('user.settings',$user->id) }}">Edit</a>
            <a class="btn btn-danger" name="hapusData" type="button" value="Hapus" href="{{ route('editData',$user->id) }}">Hapus</a>
          </div>
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

