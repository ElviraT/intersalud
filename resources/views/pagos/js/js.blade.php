<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
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
    $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
            });
    });
  $(document).ready(function() {
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

var xhr;
var select_paciente, $select_paciente;
$select_paciente = $('#paciente').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('paciente_datos') }}?paciente='+value,
                success: function(results) {
                    console.log(results);
                    if(!results.Correo) {
                        Swal.fire(
                            '¡Error!',
                            'Faltan datos del pacientes!',
                            'error'
                          );
                    }else{
                        $('#tel').val(results.Telefono);
                        $('#cel').val(results.Celular);
                        $('#correo').val(results.Correo);
                    }
                },
                error: function() {
                }
            });
    }
});
select_paciente = $select_paciente[0].selectize;

var select_moneda, $select_moneda;
$select_moneda = $('#moneda').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        if($('#monto').val() == ''){
            var total = 0;
        }else{
            var total = $('#monto').val();
        }
        var impuesto = 0;

        switch (value) {
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
      
    }
});
select_moneda = $select_moneda[0].selectize;


var xhr2;
var xhr3;
var select_medico, $select_medico;
var select_cuentausd, $select_cuentausd;
var select_cuentabs, $select_cuentabs;

$select_medico = $('#medico_id').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar cuentas usd*/
        select_cuentausd.disable();
        select_cuentausd.clearOptions();
        select_cuentausd.load(function(callback) {
            xhr2 && xhr2.abort();
            xhr2 = $.ajax({
                url: '{{ route('medico_cuentausd') }}?medico='+value,
                success: function(results) {
                    select_cuentausd.enable();
                    if (!results[0]) {
                        $('#negacion').attr('hidden', false);
                    }else{
                        callback(results);
                        $('#negacion').attr('hidden', true);
                    }
                },
                error: function() {
                    callback();
                }
            })
        });
        /*listar cuentas bs*/
        select_cuentabs.disable();
        select_cuentabs.clearOptions();
        select_cuentabs.load(function(callback) {
            xhr3 && xhr3.abort();
            xhr3 = $.ajax({
                url: '{{ route('medico_cuentabs') }}?medico='+value,
                success: function(results) {
                    select_cuentabs.enable();
                    if (!results[0]) {
                        $('#negacion2').attr('hidden', false);
                    }else{
                        callback(results);
                        $('#negacion2').attr('hidden', true);
                    }
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

$select_cuentausd = $('#cusd').selectize({
                    labelField: 'name',
                    valueField: 'id',
                    searchField: ['name'],
                    loadingClass: 'loading',
                });

$select_cuentabs = $('#cbs').selectize({
                    labelField: 'name',
                    valueField: 'id',
                    searchField: ['name'],
                    loadingClass: 'loading',
                });

                select_cuentausd  = $select_cuentausd[0].selectize;
                select_cuentabs  = $select_cuentabs[0].selectize;
                select_medico = $select_medico[0].selectize;

                select_cuentausd.disable();
                select_cuentabs.disable();

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