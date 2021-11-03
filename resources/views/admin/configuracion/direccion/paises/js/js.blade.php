<script type="text/javascript">
    $(document).ready(function() {
       var table_paises = $('#table_paises').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });

$('#modal_pais').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#codigo').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_pais_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#codigo', modal).val(obj.Codigo);
            $('#nombre', modal).val(obj.iso3166a1);
            $('#nombre2', modal).val(obj.iso3166a2);
            $('#pais', modal).val(obj.Pais);
            modal.removeClass('loading');
            loading_hide(); 
        });
    }
});
$('#modal_pais').on('hidden.bs.modal', function (e) {
    $('#codigo').val('');
    $('#nombre').val('');
    $('#nombre2').val('');
    $('#pais').val('');
});
$('#confirm-delete1').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_pais_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete1').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_pais_eliminar",  this).attr('action', data.action);
    $('#modal_registo_pais_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
