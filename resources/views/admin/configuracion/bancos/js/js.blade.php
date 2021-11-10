<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_bancos = $('#table_bancos').DataTable({
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
        dropdownParent: $('#modal_banco'),
         });
    });

$('#modal_banco').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_banco_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Bancos);
            $('#codigo', modal).val(obj.Codigo_Bancario);
            $('#status').val(obj.Status_Id);
            $('#status').change();
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_banco').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
    $('#codigo').val('');
    $('#status').val('').change();
});
$('#confirm-delete18').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_banco_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete18').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_banco_eliminar",  this).attr('action', data.action);
    $('#modal_registo_banco_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
