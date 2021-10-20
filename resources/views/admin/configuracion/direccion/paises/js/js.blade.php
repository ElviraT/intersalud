<!-- DATATABLE -->
    <script src= 'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js'></script>
    <script src= 'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js'></script>
   
    <script src= 'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js'></script>
    <script src= 'https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js'></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_paises = $('#table_paises').DataTable({
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

$('#modal_pais').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#codigo').focus();
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
    console.log(data);
    $("#form_pais_eliminar",  this).attr('action', data.action);
    $('#modal_registo_pais_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
});
function limpiar() {
    loading_show();
    $('#nombref').attr('value', '');
}
</script>
