<!-- selectize -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

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
$(function() {
    $('.pickerSelectClass').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
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
            var $especialidad = $('#especialidad').selectize();
            $especialidad[0].selectize.setValue(obj.Especialidades_Medicas_id);
            var $medico = $('#medico').selectize();
            $medico[0].selectize.setValue(obj.Medico_id);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_Medico_id);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_controlE').on('hidden.bs.modal', function (e) {
    $('#especialidad')[0].selectize.clear();
    $('#medico')[0].selectize.clear();
    $('#status')[0].selectize.clear();
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
