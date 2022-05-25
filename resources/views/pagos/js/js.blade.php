<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

{{--fileinput--}}
<script src="{{ asset('js/piexif.min.js')}}"></script>
<script src="{{ asset('js/sortable.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/fileinput.min.js')}}"></script>
<script src="{{ asset('js/LANG.js')}}"></script>

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
$('#moneda').on('select2:select', function (e) {
    var moneda = $('#moneda').val();
    if($('#monto').val() == ''){
        var total = 0;
    }else{
        var total = $('#monto').val();
    }
    var impuesto = 0;

    switch (moneda) {
      case "Bs":
        $('#bs').attr('hidden', false);
        $('#banco').attr('hidden', false);
        $('#usd').attr('hidden', true);
        $('#entidad').attr('hidden', true);
        $('#billetera').attr('hidden', true);
        $('#impuesto').val(0);
        break;
      case "USD":
        $('#usd').attr('hidden', false);
        $('#entidad').attr('hidden', false);
        $('#bs').attr('hidden', true);
        $('#banco').attr('hidden', true);
        $('#billetera').attr('hidden', true);
        $('#imp').attr('hidden', false);
        impuesto= (total * 3 / 100);
        total= parseFloat(total)+parseFloat(impuesto);
        $('#impuesto').val(impuesto.toFixed(2));
        break;
      default:
        $('#billetera').attr('hidden', false);
        $('#usd').attr('hidden', true);
        $('#bs').attr('hidden', true);
        break;
    }
    
  });
$("#comprobante").fileinput({
    languaje: 'es',
    overwriteInitial: false,
    showClose: false,
    showCaption: false,
    showBrowse: false,
    browseOnZoneClick: true,
    removeLabel: '',
    removeIcon: '<i class="ti-eraser"></i>',
    removeTitle: 'Cancelar o restablecer cambios',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    layoutTemplates: {main2: '{preview} {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
    });
</script>