<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_criptos = $('#table_criptos').DataTable({
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
        dropdownParent: $('#modal_cripto'),
         });
    });

$('#modal_cripto').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_cripto_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#nombre', modal).val(obj.Criptop);
            $('#siglas', modal).val(obj.Siglas);
            $('#status').val(obj.Status_id);
            $('#status').change();
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_cripto').on('hidden.bs.modal', function (e) {
    $('#nombre').val('');
    $('#siglas').val('');
    $('#status').val('').change();
});
$('#confirm-delete19').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_cripto_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete19').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_cripto_eliminar",  this).attr('action', data.action);
    $('#modal_registo_cripto_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
