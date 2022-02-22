<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

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

$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    });

$('#medico').on('change', function (e) {
   var medico = $('#medico').val();
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


$(function () {
       $('#fecha_lunes1').datetimepicker({
       	format: 'HH:mm:ss',
       });
       $('#fecha_lunes2').datetimepicker({
		   useCurrent: false, //Important! See issue #1075
		   format: 'HH:mm:ss',
		   });
       $("#fecha_lunes1").on("dp.change", function (e) {
           $('#fecha_lunes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_lunes2").on("dp.change", function (e) {
           $('#fecha_lunes1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_martes1').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_martes2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
       $("#fecha_martes1").on("dp.change", function (e) {
           $('#fecha_martes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_martes2").on("dp.change", function (e) {
           $('#fecha_martes1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_miercoles1').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_miercoles2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
       $("#fecha_miercoles1").on("dp.change", function (e) {
           $('#fecha_miercoles2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_miercoles2").on("dp.change", function (e) {
           $('#fecha_miercoles1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_jueves1').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_jueves2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
       $("#fecha_jueves1").on("dp.change", function (e) {
           $('#fecha_jueves2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_jueves2").on("dp.change", function (e) {
           $('#fecha_jueves1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_viernes1').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_viernes2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
       $("#fecha_viernes1").on("dp.change", function (e) {
           $('#fecha_viernes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_viernes2").on("dp.change", function (e) {
           $('#fecha_viernes1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_sabado1').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_sabado2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
       $("#fecha_sabado1").on("dp.change", function (e) {
           $('#fecha_sabado2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_sabado2").on("dp.change", function (e) {
           $('#fecha_sabado1').data("DateTimePicker").maxDate(e.date);
       });

       $('#fecha_domingo1').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_domingo2').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
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
    $('#lunes').change(function() {      
        var lu = $(this).prop('checked');
    if(lu == true) {
       document.getElementById('div_lunes').style.display = 'block';
    }else{
       document.getElementById('div_lunes').style.display = 'none';
    }
    });

    $('#martes').change(function() {      
        var ma = $(this).prop('checked');
    if(ma == true) {
       document.getElementById('div_martes').style.display = 'block';
    }else{
       document.getElementById('div_martes').style.display = 'none';
    }
    });
    $('#miercoles').change(function() {      
        var mi = $(this).prop('checked');
    if(mi == true) {
       document.getElementById('div_miercoles').style.display = 'block';
    }else{
       document.getElementById('div_miercoles').style.display = 'none';
    }
    });
    $('#jueves').change(function() {      
        var ju = $(this).prop('checked');
    if(ju == true) {
       document.getElementById('div_jueves').style.display = 'block';
    }else{
       document.getElementById('div_jueves').style.display = 'none';
    }
    });
    $('#viernes').change(function() {      
        var vi = $(this).prop('checked');
    if(vi == true) {
       document.getElementById('div_viernes').style.display = 'block';
    }else{
       document.getElementById('div_viernes').style.display = 'none';
    }
    });
    $('#sabado').change(function() {      
        var sa = $(this).prop('checked');
    if(sa == true) {
       document.getElementById('div_sabado').style.display = 'block';
    }else{
       document.getElementById('div_sabado').style.display = 'none';
    }
    });
    $('#domingo').change(function() {      
        var dom = $(this).prop('checked');
    if(dom == true) {
       document.getElementById('div_domingo').style.display = 'block';
    }else{
       document.getElementById('div_domingo').style.display = 'none';
    }
    });
});
</script>