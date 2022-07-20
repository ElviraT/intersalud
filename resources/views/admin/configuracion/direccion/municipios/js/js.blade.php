<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#table_municipios').DataTable({
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
$('#modal_municipio').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_municipio_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            var $estado = $('#estado').selectize();
            $estado[0].selectize.setValue(obj.Estado_id);
            $('#nombre', modal).val(obj.Municipio);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_municipio').on('hidden.bs.modal', function (e) {
    $('#estado')[0].selectize.clear();
    $('#nombre').val('');
});
$('#confirm-delete4').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_municipio_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete4').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_municipio_eliminar",  this).attr('action', data.action);
    $('#modal_registo_municipio_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

</script>
