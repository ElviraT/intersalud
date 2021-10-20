<!-- DATATABLE -->

    <script src= 'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js'></script>
    <script src= 'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js'></script>
   
    <script src= 'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js'></script>
    <script src= 'https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js'></script>
    <!--Toggle -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#table_municipios').DataTable({
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
    });

$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        dropdownParent: $('#modal_municipio'),
         });
    });
$('#modal_municipio').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_municipio_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#estado').val(obj.Estado_id);
            $('#estado').change();
            $('#nombre', modal).val(obj.Municipio);
            modal.removeClass('loading');
        });
    }
});
$('#modal_municipio').on('hidden.bs.modal', function (e) {
    $('#estado').val('').change();
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
});

</script>
