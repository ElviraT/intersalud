<!-- DATATABLE -->
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('js/responsive.bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_estados = $('#table_estados').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });
$('#modal_estado').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_estado_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Estado);
            modal.removeClass('loading');
            loading_hide();
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
    loading_hide();
});

</script>
