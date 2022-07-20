<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_entidades = $('#table_entidades').DataTable({
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

$('#modal_entidad').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_entidad_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Entidad_USD);
            $('#referencia', modal).val(obj.Referencia);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_id);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_entidad').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
    $('#referencia').val('');
    $('#status')[0].selectize.clear();
});
$('#confirm-delete24').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_entidad_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete24').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_entidad_eliminar",  this).attr('action', data.action);
    $('#modal_registo_entidad_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
