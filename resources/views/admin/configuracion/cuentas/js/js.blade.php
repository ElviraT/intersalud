{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_cuentas = $('#table_cuentas').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });
$(function () {
    var dtn = new Date();
    //Date picker
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        startDate : dtn,
        todayHighlight: true,
        language: 'es'
    });
});
$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        dropdownParent: $('#modal_cuentaUSD'),
         });
    });

$('#modal_cuentaUSD').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_cuentaUSD_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#entidad').val(obj.Entidad_USD_id);
            $('#entidad').change();
            $('#medico').val(obj.Medico_id);
            $('#medico').change();
            $('#status').val(obj.Status_Pago);
            $('#status').change();
            $('#numero', modal).val(obj.Numero_Cuenta);
            $('#tipo', modal).val(obj.Tipo);
            $('#tipo').change();
            $('#fecha', modal).val(obj.Fecha);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_cuentaUSD').on('hidden.bs.modal', function (e) {
    $('#numero').val('');
    $('#tipo').val('');
    $('#fecha').val('');
    $('#entidad').val('').change();
    $('#medico').val('').change();
    $('#status').val('').change();
});
$('#confirm-delete26').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_cuentaUSD_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete26').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_cuentaUSD_eliminar",  this).attr('action', data.action);
    $('#modal_registo_cuentaUSD_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
