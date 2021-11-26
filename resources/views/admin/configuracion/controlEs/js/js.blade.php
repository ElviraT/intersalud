<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_controlEs = $('#table_controlEs').DataTable({
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
        closeOnSelect: true,
        dropdownParent: $('#modal_controlE'),
         });
    });

$('#modal_controlE').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_controlE_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#especialidad').val(obj.Especialidades_Medicas_id);
            $('#especialidad').change();
            $('#medico').val(obj.Medico_id);
            $('#medico').change();
            $('#status').val(obj.Status_Medico_id);
            $('#status').change();
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_controlE').on('hidden.bs.modal', function (e) {
    $('#especialidad').val('').change();
    $('#medico').val('').change();
    $('#status').val('').change();
});
$('#confirm-delete27').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_controlE_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete27').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_controlE_eliminar",  this).attr('action', data.action);
    $('#modal_registo_controlE_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
