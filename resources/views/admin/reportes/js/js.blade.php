<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

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

$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    });  

$(function () {
    //Date picker
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        todayHighlight: true,
        language: 'es'
    });
});

function limpiar() {
  	$('#id_medico').val('').change();
  	$('#id_especialidad').val('').change();
  	$('#id_servicio').val('').change();
  	$('#cerrado').val('').change();
  	$('#fecha').val('');
  }  
</script>