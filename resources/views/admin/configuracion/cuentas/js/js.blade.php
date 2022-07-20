{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- selectize -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

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
$(function() {
    $('.pickerSelectClass').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
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
            var $entidad = $('#entidad').selectize();
            $entidad[0].selectize.setValue(obj.Entidad_USD_id);
            var $medico = $('#medico').selectize();
            $medico[0].selectize.setValue(obj.Medico_id);
            var $tipo = $('#tipo').selectize();
            $tipo[0].selectize.setValue(obj.Tipo);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_Pago);            
            $('#numero', modal).val(obj.Numero_Cuenta);            
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
    $('#entidad')[0].selectize.clear();
    $('#medico')[0].selectize.clear();
    $('#status')[0].selectize.clear();
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
