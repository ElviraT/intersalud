{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- selectize -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_cuenta_bancos = $('#table_cuenta_bancos').DataTable({
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

$('#modal_cuenta_banco').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_cuenta_banco_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            var $banco = $('#banco').selectize();
            $banco[0].selectize.setValue(obj.Banco_id);
            var $medico = $('#medico').selectize();
            $medico[0].selectize.setValue(obj.Medico_id);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_id);
            var $tipo = $('#tipo').selectize();
            $tipo[0].selectize.setValue(obj.Tipo);  
            $('#numero', modal).val(obj.Numero_Cuenta);            
            $('#fecha', modal).val(obj.Fecha);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_cuenta_banco').on('hidden.bs.modal', function (e) {
    $('#numero').val('');
    $('#fecha').val('');
    $('#banco')[0].selectize.clear();
    $('#medico')[0].selectize.clear();
    $('#status')[0].selectize.clear();
    $('#tipo')[0].selectize.clear();
});
$('#confirm-delete21').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_cuenta_banco_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete21').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_cuenta_banco_eliminar",  this).attr('action', data.action);
    $('#modal_registo_cuenta_banco_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
