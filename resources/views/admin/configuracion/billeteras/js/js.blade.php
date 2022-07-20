<!-- selectize -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_billeteras = $('#table_billeteras').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });
$(function() {
    $('.pickerSelectClass').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
        });
});

$('#modal_billetera').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_billetera_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Billetera);
            var $medico = $('#medico').selectize();
            $medico[0].selectize.setValue(obj.Medicos_id);
            var $cripto = $('#cripto').selectize();
            $cripto[0].selectize.setValue(obj.Cripto_id);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_id);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_billetera').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
    $('#medico')[0].selectize.clear();
    $('#cripto')[0].selectize.clear();
    $('#status')[0].selectize.clear();
});
$('#confirm-delete20').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_billetera_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete20').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_billetera_eliminar",  this).attr('action', data.action);
    $('#modal_registo_billetera_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
