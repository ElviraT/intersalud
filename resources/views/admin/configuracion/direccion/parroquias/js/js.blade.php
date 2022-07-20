<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#table_parroquias').DataTable({
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
$('#modal_parroquia').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_parroquia_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            var $municipio = $('#municipio').selectize();
            $municipio[0].selectize.setValue(obj.Municipio_id);
            $('#nombre', modal).val(obj.Parroquia);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_parroquia').on('hidden.bs.modal', function (e) {
    $('#municipio')[0].selectize.clear();
    $('#nombre').val('');
});
$('#confirm-delete5').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_parroquia_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete5').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_parroquia_eliminar",  this).attr('action', data.action);
    $('#modal_registo_parroquia_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

</script>
