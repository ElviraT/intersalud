<script type="text/javascript">
    $(document).ready(function() {
       var table_statusts = $('#table_statusts').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });

$('#modal_statust').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_statust_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Tasa);
            $('#color', modal).val(obj.color);
            $('#nota', modal).val(obj.Nota);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_statust').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
    $('#color').val('');
});
$('#confirm-delete13').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_statust_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete13').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_statust_eliminar",  this).attr('action', data.action);
    $('#modal_registo_statust_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
