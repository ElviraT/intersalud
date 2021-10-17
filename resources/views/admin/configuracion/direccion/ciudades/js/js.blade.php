<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#table_ciudades').DataTable({
            lengthChange: false,
            responsive: true,
            fixedHeader: true,
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
    });
$(document).ready(function() {
    var table = $('#example').DataTable( {
        fixedHeader: true
    } );
} );
    $(document).ready(function() {
        $('.select2').select2({ 
            theme : "classic",
            dropdownParent: $('#modal_ciudad'),
             });
        });
$('#modal_ciudad').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_ciudad_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#estado').val(obj.Estado_id);
            $('#estado').change();
            $('#nombre', modal).val(obj.Ciudad);
            modal.removeClass('loading');
        });
    }
});
$('#modal_ciudad').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
});
$('#confirm-delete2').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_ciudad_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete2').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_ciudad_eliminar",  this).attr('action', data.action);
    $('#modal_registo_ciudad_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
});

</script>
