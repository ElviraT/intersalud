<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_roles = $('#table_roles').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });

$('#confirm-delete15').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_rol_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete15').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_rol_eliminar",  this).attr('action', data.action);
    $('#modal_registo_rol_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
