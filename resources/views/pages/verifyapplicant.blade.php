@extends('layouts.default')
@section('content')

<?php $i=1;?>
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
                          <th  scope="row">{{$i}}</th >
                          <td>{{$user->id}}</td>
                          <td>{{$user->nama}}</td>
                          <td>{{$user->kredit}}</td>
                          <td>{{$user->getRoleNames()}}</td>
                          <td align="center">
                                  
                                  <button type="button" class="btn btn-primary">Terima</em></button>
                                  <button type="button" class="btn btn-danger">Tolak</em></button>
                                </td>
                    </tr>
                    <?php $i++;?>
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

