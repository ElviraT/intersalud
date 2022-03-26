<script type="text/javascript">
    $(document).ready(function() {
       var table_reportesc = $('#table_reportesc').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });
</script>