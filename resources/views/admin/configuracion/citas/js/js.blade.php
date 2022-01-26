<!-- Fullcalendar -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/es.js') }}" type="text/javascript"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });

    $('#paciente').select2({ 
    theme : "classic",
    dropdownParent: $('#modal_citas'),
     });

    $('#pacienteE').select2({ 
    theme : "classic",
    dropdownParent: $('#modal_citas'),
     });
    });
$(function () {
       $('#fecha_inicio').datetimepicker({
        format: 'HH:mm:ss',
       });
       $('#fecha_fin').datetimepicker({
       useCurrent: false, //Important! See issue #1075
       format: 'HH:mm:ss',
       });
       $("#fecha_inicio").on("dp.change", function (e) {
           $('#fecha_fin').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_fin").on("dp.change", function (e) {
           $('#fecha_inicio').data("DateTimePicker").maxDate(e.date);
       });
});
$('#paciente').on('change', function (e) {
   var paciente = $('#paciente').val();
    $.getJSON('{{ route('paciente_dependiente') }}?paciente='+paciente, function(objPE){
        var opcion = $('#pacienteE').val();
        $('#pacienteE').empty();
        $('#pacienteE').prop('disabled', true);
        $('#pacienteE').change();

        if(objPE.length > 0){
            $.each(objPE, function (i, pacienteE) {
            $('#pacienteE').append(
                    $('<option>', {
                        value: pacienteE.id,
                        text : pacienteE.name
                    })
                );
            });
            $('#pacienteE').prop('disabled', false);
            $("#pacienteE option:first").attr("selected", "selected");
        }        
    });
});

$('#medico').on('change', function (e) {
   var medico = $('#medico').val();
    $.getJSON('{{ route('especialidad_dependiente') }}?medico='+medico, function(objC){
        var opcion = $('#especialidad').val();
        $('#especialidad').empty();
        $('#especialidad').prop('disabled', true);
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
            $('#especialidad').prop('disabled', false);
            $("#especialidad option:first").attr("selected", "selected");
        }        
    });
});

function horario() {
  var medico = $('#medico').val();
  var espec  = $('#especialidad').val();
  var array_dias = [];

   $.getJSON('{{ route('consultar_horario') }}?medico='+medico+'&espec='+espec, function(objch){     
if (objch['Lunes'] == 0) {
    array_dias.push(1);
}
if (objch['Martes'] == 0) {
    array_dias.push(2); 
}
if (objch['Miercoles'] == 0) {
    array_dias.push(3);  
}
if (objch['Jueves'] == 0) {
    array_dias.push(4);  
}
if (objch['Viernes'] == 0) {
    array_dias.push(5); 
}
if (objch['Sabado'] == 0) {
    array_dias.push(6);  
}
if (objch['Domingo'] == 0) {
    array_dias.push(0);
}
      $(function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
              locale:'es',
              initialDate: new Date(),
              initialView: 'timeGridWeek',
              slotLabelFormat:{
               hour: '2-digit',
               minute: '2-digit',
               hour12: true
               },//se visualizara de esta manera 01:00 AM en la columna de horas
              eventTimeFormat: {
               hour: '2-digit',
               minute: '2-digit',
               hour12: true
              },
              nowIndicator: true,
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
              },
              navLinks: true, // can click day/week names to navigate views
              editable: true,
              selectable: true,
              selectMirror: true,      
              hiddenDays: array_dias,
              dayMaxEvents: true, // allow "more" link when too many events
              select: function(arg) {
                console.log(arg);
                $('#modal_citas').modal();
                calendar.unselect()
              },
               views: {
                  timeGrid: {
                    eventLimit: 3 // adjust to 3 only for timeGridWeek/timeGridDay
                  }
                },
            });
             /* defaultView: 'resourceTimeGridDay',
             // allDaySlot: false,
              headerToolbar: {
                left: 'prev,next,today',
                center: 'title'
              },
              initialDate: new Date(),
              eventLimit: true,
              displayEventTime: true,
              navLinks: true, // can click day/week names to navigate views
              selectable: true,
              showNonCurrentDates:false,
             // selectMirror: true,
              select: function(arg) {
                $('#modal_citas').modal();
                calendar.unselect()
              },
              editable: true,
              hiddenDays: array_dias,
              views: {
                  timeGrid: {
                    eventLimit: 3 // adjust to 3 only for timeGridWeek/timeGridDay
                  }
                },
            });*/
            calendar.render();
        });


   });
}

</script>