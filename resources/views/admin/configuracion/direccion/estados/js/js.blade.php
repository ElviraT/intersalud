<script type="text/javascript">
    $(document).ready(function() {
       var table_estados = $('#table_estados').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
       new $.fn.dataTable.FixedHeader( table_estados );
    });
$('#modal_estado').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#codigo').focus();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_estado_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Estado);
            modal.removeClass('loading');
        });
    }
});
$('#modal_estado').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
});
$('#confirm-delete2').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_estado_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete2').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_estado_eliminar",  this).attr('action', data.action);
    $('#modal_registo_estado_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
});

</script>
