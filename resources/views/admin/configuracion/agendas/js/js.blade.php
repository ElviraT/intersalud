<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
 $(document).ready(function() {
       var table_agendas = $('#table_agendas').DataTable({
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
        dropdownParent: $('#modal_agenda'),
         });
    });


$('#medico').on('change', function (e) {
   var medico = $('#medico').val();
    $.getJSON('{{ route('especialidad_dependiente') }}?medico='+medico, function(objC){
        var opcion = $('#especialidad').val();
        $('#especialidad').empty();
        $('#especialidad').prop('disabled', true);

        if(objC.length > 0){
            $.each(objC, function (i, especialidad) {
            $('#especialidad').append(
                    $('<option>', {
                        value: especialidad.id,
                        text : especialidad.name
                    })
                );
            });
            $("#especialidad option:first").attr("selected", "selected");
            $('#especialidad').change();
            $('#especialidad').prop('disabled', false);
        }        
    });
  });
  $('#especialidad').on('change', function (e) {
   var especialidad = $('#especialidad').val();
    $.getJSON('{{ route('consultorio_dependiente') }}?especialidad='+especialidad, function(objE){
        var opcion = $('#consultorio').val();
        $('#consultorio').empty();
        $('#consultorio').prop('disabled', true);
        $('#consultorio').change();

        if(objE.length > 0){
            $.each(objE, function (i, consultorio) {
            $('#consultorio').append(
                    $('<option>', {
                        value: consultorio.id_Consultorio,
                        text : consultorio.Local
                    })
                );
            });
            $("#consultorio option:first").attr("selected", "selected");
            $('#consultorio').change();
            $('#consultorio').prop('disabled', false);
        }else{
            Swal.fire(
              '¡Error!',
              'Esta especialidad no tiene consultorio',
              'error'
            );
        }        
    });
    
});
$('#modal_agenda').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_agenda_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#medico', modal).val(obj.Medico_id);
            $('#medico').change();
            $('#especialidad', modal).val(obj.Especialidad_Medica);
            $('#especialidad').change();
            $('#horario', modal).val(obj.Horario_Cita_id);
            $('#horario').change();
            $('#consultorio', modal).val(obj.Consultorio_id);
            $('#consultorio').change();
            $('#costo', modal).val(obj.Costo_consulta);
            $('#mpaciente', modal).val(obj.Max_pacientes);
            $('#status', modal).val(obj.Status_id);
            $('#status').change();
            $('#nota').val(obj.Nota);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_agenda').on('hidden.bs.modal', function (e) {
    $('#medico').val('').change();
    $('#especialidad').val('').change();
    $('#consultorio').val('').change();
    $('#costo').val('');
    $('#mpaciente').val('');
    $('#status').val('').change();
    $('#nota').val('');
});
</script>