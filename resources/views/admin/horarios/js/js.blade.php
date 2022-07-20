<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<!-- selectize -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
   var table_horarios = $('#table_horarios').DataTable({
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

$select_medico = $('#medico').selectize({
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

                //select_especialidad.disable();

$('#turno_id').on('change', function (e) {
  var turno = $('select[name="turno_id"] option:selected').text();
  if(turno === 'Mañana') {
    var minDate ='00:00';
    var maxDate = '12:00';
  }
  if(turno === 'Tarde'){
    var minDate ='12:01';
    var maxDate = '23:59';
  }

       $('#fecha_lunes1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
       	format: 'HH:mm',
       });
       $('#fecha_lunes2').datetimepicker({        
        useCurrent: false, //Important! See issue #1075
		    format: 'HH:mm',
		   });
       $('#fecha_lunes1').data("DateTimePicker").minDate(minDate);
       $('#fecha_lunes1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_lunes2').data("DateTimePicker").minDate(minDate);
       $('#fecha_lunes2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_lunes1").on("dp.change", function (e) {
           $('#fecha_lunes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_lunes2").on("dp.change", function (e) {
           $('#fecha_lunes1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_martes1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'HH:mm',
       });
       $('#fecha_martes2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm',
       });
       $('#fecha_martes1').data("DateTimePicker").minDate(minDate);
       $('#fecha_martes1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_martes2').data("DateTimePicker").minDate(minDate);
       $('#fecha_martes2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_martes1").on("dp.change", function (e) {
           $('#fecha_martes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_martes2").on("dp.change", function (e) {
           $('#fecha_martes1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_miercoles1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'HH:mm',
       });
       $('#fecha_miercoles2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm',
       });
       $('#fecha_miercoles1').data("DateTimePicker").minDate(minDate);
       $('#fecha_miercoles1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_miercoles2').data("DateTimePicker").minDate(minDate);
       $('#fecha_miercoles2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_miercoles1").on("dp.change", function (e) {
           $('#fecha_miercoles2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_miercoles2").on("dp.change", function (e) {
           $('#fecha_miercoles1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_jueves1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'HH:mm',
       });
       $('#fecha_jueves2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm',
       });
       $('#fecha_jueves1').data("DateTimePicker").minDate(minDate);
       $('#fecha_jueves1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_jueves2').data("DateTimePicker").minDate(minDate);
       $('#fecha_jueves2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_jueves1").on("dp.change", function (e) {
           $('#fecha_jueves2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_jueves2").on("dp.change", function (e) {
           $('#fecha_jueves1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_viernes1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'HH:mm',
       });
       $('#fecha_viernes2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm',
       });
       $('#fecha_viernes1').data("DateTimePicker").minDate(minDate);
       $('#fecha_viernes1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_viernes2').data("DateTimePicker").minDate(minDate);
       $('#fecha_viernes2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_viernes1").on("dp.change", function (e) {
           $('#fecha_viernes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_viernes2").on("dp.change", function (e) {
           $('#fecha_viernes1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_sabado1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'HH:mm',
       });
       $('#fecha_sabado2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm',
       });
       $('#fecha_sabado1').data("DateTimePicker").minDate(minDate);
       $('#fecha_sabado1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_sabado2').data("DateTimePicker").minDate(minDate);
       $('#fecha_sabado2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_sabado1").on("dp.change", function (e) {
           $('#fecha_sabado2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_sabado2").on("dp.change", function (e) {
           $('#fecha_sabado1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_domingo1').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'HH:mm',
       });
       $('#fecha_domingo2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm',
       });
       $('#fecha_domingo1').data("DateTimePicker").minDate(minDate);
       $('#fecha_domingo1').data("DateTimePicker").maxDate(maxDate);

       $('#fecha_domingo2').data("DateTimePicker").minDate(minDate);
       $('#fecha_domingo2').data("DateTimePicker").maxDate(maxDate);

       $("#fecha_domingo1").on("dp.change", function (e) {
           $('#fecha_domingo2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_domingo2").on("dp.change", function (e) {
           $('#fecha_domingo1').data("DateTimePicker").maxDate(e.date);
       });
   });
$('#confirm-delete32').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_horario_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete32').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_horario_eliminar",  this).attr('action', data.action);
    $('#modal_registo_horario_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

$(function() {
  $('#turno_id').change();
    $('#lunes').change(function() {      
        var lu = $(this).prop('checked');
    if(lu == true) {
       document.getElementById('div_lunes').style.display = 'block';
       $('#hlui').attr('required', true);
       $('#hluf').attr('required', true);
    }else{
       document.getElementById('div_lunes').style.display = 'none';
       $('#hlui').attr('required', false);
       $('#hluf').attr('required', false);
    }
    });

    $('#martes').change(function() {      
        var ma = $(this).prop('checked');
    if(ma == true) {
       document.getElementById('div_martes').style.display = 'block';
       $('#hmai').attr('required', true);
       $('#hmaf').attr('required', true);
    }else{
       document.getElementById('div_martes').style.display = 'none';
       $('#hmai').attr('required', false);
       $('#hmaf').attr('required', false);
    }
    });
    $('#miercoles').change(function() {      
        var mi = $(this).prop('checked');
    if(mi == true) {
       document.getElementById('div_miercoles').style.display = 'block';
       $('#hmii').attr('required', true);
       $('#hmif').attr('required', true);
    }else{
       document.getElementById('div_miercoles').style.display = 'none';
       $('#hmii').attr('required', false);
       $('#hmif').attr('required', false);
    }
    });
    $('#jueves').change(function() {      
        var ju = $(this).prop('checked');
    if(ju == true) {
       document.getElementById('div_jueves').style.display = 'block';
       $('#hjui').attr('required', true);
       $('#hjuf').attr('required', true);
    }else{
       document.getElementById('div_jueves').style.display = 'none';
       $('#hjui').attr('required', false);
       $('#hjuf').attr('required', false);
    }
    });
    $('#viernes').change(function() {      
        var vi = $(this).prop('checked');
    if(vi == true) {
       document.getElementById('div_viernes').style.display = 'block';
       $('#hvii').attr('required', true);
       $('#hvif').attr('required', true);
    }else{
       document.getElementById('div_viernes').style.display = 'none';
       $('#hvii').attr('required', false);
       $('#hvif').attr('required', false);
    }
    });
    $('#sabado').change(function() {      
        var sa = $(this).prop('checked');
    if(sa == true) {
       document.getElementById('div_sabado').style.display = 'block';
       $('#hsai').attr('required', true);
       $('#hsaf').attr('required', true);
    }else{
       document.getElementById('div_sabado').style.display = 'none';
       $('#hsai').attr('required', false);
       $('#hsaf').attr('required', false);
    }
    });
    $('#domingo').change(function() {      
        var dom = $(this).prop('checked');
    if(dom == true) {
       document.getElementById('div_domingo').style.display = 'block';
       $('#hdoi').attr('required', true);
       $('#hdof').attr('required', true);
    }else{
       document.getElementById('div_domingo').style.display = 'none';
       $('#hdoi').attr('required', false);
       $('#hdof').attr('required', false);
    }
    });
});
</script>