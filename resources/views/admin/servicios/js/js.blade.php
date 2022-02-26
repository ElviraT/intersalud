<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_servicios = $('#table_servicios').DataTable({
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
        dropdownParent: $('#modal_servicio'),
         });
    });
$('#medico_id').on('change', function (e) {
   var medico = $('#medico_id').val();
    $.getJSON('{{ route('especialidad_dependiente') }}?medico='+medico, function(objC){
        var opcion = $('#especialidad').val();
        $('#especialidad').empty();
        $('#especialidad').attr('readonly', true);
        $('#especialidad').change();

        if(objC.length > 0){
            $.each(objC, function (i, especialidad) {
            $('#especialidad').append(
                    $('<option>', {
                        value: especialidad.id,
                        text : especialidad.name
                    })
                );
            });
            $('#especialidad').attr('readonly', false);
            $("#especialidad option:first").attr("selected", "selected");
        }        
    });
});
$('#modal_servicio').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_servicio_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#servicio', modal).val(obj.Servicio);
            $('#costo', modal).val(obj.Costos);
            $('#especialidad', modal).val(obj.Especialidad_Medica_id).change();
            $('#medico_id', modal).val(obj.Medico_id).change();
            $('#status', modal).val(obj.Status_id).change();
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_servicio').on('hidden.bs.modal', function (e) {
    $('#servicio').val('');
    $('#costo').val('');
    $('#especialidad').val(0).change();
    $('#medico_id').val(0).change();
    $('#status').val(0).change();
});
$('#confirm-delete31').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_servicio_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete31').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_servicio_eliminar",  this).attr('action', data.action);
    $('#modal_registo_servicio_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
