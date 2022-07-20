<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

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
$(function() {
    $('.otro').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
        });
});

var xhr;
var select_medico, $select_medico;
var select_especialidad, $select_especialidad;

$select_medico = $('#medico_id').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar especialidades*/
        select_especialidad.disable();
        select_especialidad.clearOptions();
        select_especialidad.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('especialidad_dependiente') }}?medico='+value,
                success: function(results) {
                    select_especialidad.enable();
                    if (!results[0]) {
                        $('#negacion').attr('hidden', false);
                    }else{
                        callback(results);
                        select_especialidad.setValue(results[0].id);
                        $('#negacion').attr('hidden', true);
                    }
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

$select_especialidad = $('#especialidad').selectize({
                    labelField: 'name',
                    valueField: 'id',
                    searchField: ['name'],
                    loadingClass: 'loading',
                });


                select_especialidad  = $select_especialidad[0].selectize;
                select_medico = $select_medico[0].selectize;

                select_especialidad.disable();

$('#duracion').datetimepicker({        
    useCurrent: false, //Important! See issue #1075
    format: 'HH:mm',
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
            var $simbolo = $('#simbolo').selectize();
            $simbolo[0].selectize.setValue(obj.simbolo);
            var $medico_id = $('#medico_id').selectize();
            $medico_id[0].selectize.setValue(obj.Medico_id, true);
            var $especialidad = $('#especialidad').selectize();
            $especialidad[0].selectize.setValue(obj.Especialidad_Medica_id);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_id);
            $('#duracion_input').val(obj.duracion);
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_servicio').on('hidden.bs.modal', function (e) {
    $('#servicio').val('');
    $('#costo').val('');
    $('#especialidad')[0].selectize.clear();
    $('#medico_id')[0].selectize.clear();
    $('#status')[0].selectize.clear();
    $('#simbolo')[0].selectize.clear();
    $('#duracion').data('DateTimePicker').date(null);
    $('#duracion').datetimepicker('update');
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
