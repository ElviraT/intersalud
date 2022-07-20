<!-- selectize -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>


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
$(function() {
    $('.otro').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
        });
});

var xhr;
var xhr2;
var select_horario, $select_horario;
var select_consultorio, $select_consultorio;

$select_horario = $('#horario').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar consultorioes*/
        select_consultorio.disable();
        select_consultorio.clearOptions();
        select_consultorio.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('consultorio_dependiente') }}?especialidad='+value,
                success: function(results) {
                    select_consultorio.enable();                    
                    if (!results[0]) {
                         Swal.fire(
                              '¡Error!',
                              'Esta especialidad no tiene consultorio',
                              'error'
                            );
                    }else{
                        callback(results);
                        select_consultorio.setValue(results[0].id_Consultorio);
                    }
                },
                error: function() {
                    callback();
                }
            })
        });

            xhr2 && xhr2.abort();
            xhr2 = $.ajax({
                url: '{{ route('horario_datos') }}?horario='+value,
                success: function(results) {
                   $('#medico').val(results.Medico_id);
                   var $especialidad = $('#especialidad').selectize();
                   $especialidad[0].selectize.setValue(results.Especialidad_id);
                },
                error: function() {
                    callback();
                }
            })
    }
});

$select_consultorio = $('#consultorio').selectize({
                    labelField: 'Local',
                    valueField: 'id_Consultorio',
                    searchField: ['Local'],
                    loadingClass: 'loading',
                });


                select_consultorio  = $select_consultorio[0].selectize;
                select_horario = $select_horario[0].selectize;

                //select_especialidad.disable();


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
            var $especialidad = $('#especialidad').selectize();
            $especialidad[0].selectize.setValue(obj.Especialidad_Medica);            
            $select_horario[0].selectize.setValue(obj.Horario_Cita_id, true);
            $select_consultorio[0].selectize.setValue(obj.Consultorio_id);
            $('#mpaciente', modal).val(obj.Max_pacientes);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_id);
            $('#nota').val(obj.Nota);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_agenda').on('hidden.bs.modal', function (e) {
    $('#horario')[0].selectize.clear();
    $('#medico').val('');
    $('#especialidad')[0].selectize.clear();
    $('#consultorio')[0].selectize.clear();
    $('#mpaciente').val('');
    $('#status')[0].selectize.clear();
    $('#nota').val('');
});

$('#confirm-delete33').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_agenda_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete33').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_agenda_eliminar",  this).attr('action', data.action);
    $('#modal_registo_agenda_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>