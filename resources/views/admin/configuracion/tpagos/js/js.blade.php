<script type="text/javascript">
    $(document).ready(function() {
       var table_tpagos = $('#table_tpagos').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });
$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        dropdownParent: $('#modal_tpago'),
         });
    });

$('#modal_tpago').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_tpago_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Tipo_Pago);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_tpago').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
});
$('#confirm-delete29').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_tpago_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete29').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_tpago_eliminar",  this).attr('action', data.action);
    $('#modal_registo_tpago_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
