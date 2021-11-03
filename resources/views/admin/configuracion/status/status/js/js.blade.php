<script type="text/javascript">
    $(document).ready(function() {
       var table_status = $('#table_status').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });

$('#modal_status').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_status_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Status);
            $('#color', modal).val(obj.color);
            $('#nota', modal).val(obj.Nota);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_status').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
    $('#color').val('');
});
$('#confirm-delete14').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_status_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete14').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_status_eliminar",  this).attr('action', data.action);
    $('#modal_registo_status_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
