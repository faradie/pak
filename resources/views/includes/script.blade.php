  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/js/custom-file-input.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/bootstrap/js/scripts/klorofil-common.js') }}"></script> --}}

  

  <script>
    $('#deleteAdministrationFile').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var recipient = button.data('nameid') 

      var modal = $(this)
      modal.find('.modal-body #name_id').val(recipient)
    })

    $('#deleteItemFile').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var recipient = button.data('nameid') 

      var modal = $(this)
      modal.find('.modal-body #name_id').val(recipient)
    })

    $('#deletePeriodModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var recipient = button.data('nameid') 

      var modal = $(this)
      modal.find('.modal-body #name_id').val(recipient)
    })

    $('#disposisiModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var title = button.data('mytitle') 
      var dis = button.data('mydisp')
      var by = button.data('myby')

      var modal = $(this)
      document.getElementById("p1").innerHTML = title;
      document.getElementById("p2").innerHTML = dis;
      document.getElementById("by").innerHTML = by;
  // modal.find('.modal-title #title').val(title);
})

    $('#infoModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var title = button.data('mytitleinfo') 
      var con = button.data('myinfo')
      var ty = button.data('type')

      var modal = $(this)
      document.getElementById("p1").innerHTML = title;
      document.getElementById("p2").innerHTML = con;
      document.getElementById("by").innerHTML = ty;
  // modal.find('.modal-title #title').val(title);
})


</script>





