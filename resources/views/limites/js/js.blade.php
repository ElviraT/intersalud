<!-- DATATABLE -->
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
   
    <script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/responsive.bootstrap.min.js')}}"></script>
    
<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_limites = $('#table_limites').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });

    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    });
</script>