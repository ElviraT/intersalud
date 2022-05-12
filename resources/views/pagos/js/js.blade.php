<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    //Date picker
    var dtn = new Date();
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        todayHighlight: true,
        language: 'es',
        endDate : dtn
    });
   
  });

$('#paciente').on('select2:select', function (e) {
   var paciente = $('#paciente').val();
   $.getJSON('{{ route('paciente_datos') }}?paciente='+paciente, function(obj){
        $('#tel').val(obj.Telefono);
        $('#cel').val(obj.Celular);
        $('#correo').val(obj.Correo);
    });
});

</script>