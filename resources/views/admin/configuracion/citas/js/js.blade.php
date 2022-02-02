<!-- Fullcalendar -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/es.js') }}" type="text/javascript"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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

function horario() {
  var formulario = document.getElementById("Myform");
  var agenda = $('#agenda').val();
  var array_dias = [];
  var array_businessHours = [];

   $.getJSON('{{ route('consultar_horario') }}?agenda='+agenda, function(objch){     
        if (objch['Lunes'] == 0) {
            array_dias.push(1);
        }else{
          array_businessHours.push({
            daysOfWeek: [1],
            startTime: objch['Hora_Inicio_Lunes'],
            endTime: objch['Hora_Fin_Lunes']
          });
        }
        if (objch['Martes'] == 0) {
            array_dias.push(2); 
        }else{
          array_businessHours.push({
            daysOfWeek: [2],
            startTime: objch['Hora_Inicio_Martes'],
            endTime: objch['Hora_Fin_Martes']
          });
        }
        if (objch['Miercoles'] == 0) {
            array_dias.push(3);  
        }else{
          array_businessHours.push({
            daysOfWeek: [3],
            startTime: objch['Horario_Inicio_Miercoles'],
            endTime: objch['Horario_Fin_Miercoles']
          });
        }
        if (objch['Jueves'] == 0) {
            array_dias.push(4);  
        }else{
          array_businessHours.push({
            daysOfWeek: [4],
            startTime: objch['Horario_Inicio_Jueves'],
            endTime: objch['Horario_Fin_Jueves']
          });
        }
        if (objch['Viernes'] == 0) {
            array_dias.push(5); 
        }else{
          array_businessHours.push({
            daysOfWeek: [5],
            startTime: objch['Horario_Inicio_Viernes'],
            endTime: objch['Horario_Fin_Viernes']
          });
        }
        if (objch['Sabado'] == 0) {
            array_dias.push(6);  
        }else{
          array_businessHours.push({
            daysOfWeek: [6],
            startTime: objch['Horario_Inicio_Sabado'],
            endTime: objch['Horario_Fin_Sabado']
          });
        }
        if (objch['Domingo'] == 0) {
            array_dias.push(0);
        }else{
          array_businessHours.push({
            daysOfWeek: [0],
            startTime: objch['Horario_inicio_Domingo'],
            endTime: objch['Horario_Fin_Domingo']
          });
        };
var id_Agenda= objch['id_Agenda'];
   $(function() {
            var url = "{{ route('citas.mostrar', ':id') }}";
            url = url.replace(':id', id_Agenda);

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
              locale:'es',
              timeZoneName:'short',
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
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
              },
             businessHours: array_businessHours,
             forceEventDuration: true,
              navLinks: true,     
              hiddenDays: array_dias,
              dayMaxEvents: true, // allow "more" link when too many eventse
              events: url,

              dateClick:function(info) {
                formulario.reset();
                formulario.start.value= moment(info.dateStr).format('YYYY-MM-DD');
                formulario.end.value= moment(info.dateStr).format('YYYY-MM-DD');
                $('#modal_citas').modal('show');

                $('#modal_citas').on('show.bs.modal', function (e) {
                  var agenda2 = $('#agenda').val();
                   $.getJSON('{{ route('datos_agenda') }}?agenda2='+agenda2, function(objA){
                    //var objA = objA[0];
                     $('#Agenda_id').val(objA['id_Agenda']);
                     $('#mpaciente').val(objA['Max_pacientes']);
                     $('#costo').val(objA['Costo_consulta']);
                  });
                });
              },
              eventClick:function(info) {
                var cita=info.event;
                 var url_edit = "{{ route('citas.editar', ':id') }}";
                  url_edit = url_edit.replace(':id', cita.id_Cita_Consulta);
                axios.post(url_edit).
                then(
                  (respuesta) =>{
                   $('#id').val(cita.extendedProps.id_Cita_Consulta);
                   $('#Agenda_id').val(cita.extendedProps.Agenda_id);
                   $('#paciente').val(cita.extendedProps.Paciente_id).change();
                   $('#pacienteE').val(cita.extendedProps.Paciente_Especial_id).change();
                   $('#mpaciente').val(cita.extendedProps.Max_paciente);
                   $('#costo').val(cita.extendedProps.Costo);
                   $('#nota').val(cita.extendedProps.Nota);
                   $('#title').val(cita.title);
                   $('#start').val(moment(cita.extendedProps.start).format('YYYY-MM-DD'));
                   $('#end').val(moment(cita.extendedProps.end).format('YYYY-MM-DD'));
                    $('#modal_citas').modal('show');
                  }
                  ).catch(
                    error => {
                      if (error.response) {
                        console.log(error.response.data);
                      }
                    });
              },
               views: {
                  timeGrid: {
                    eventLimit: 3 // adjust to 3 only for timeGridWeek/timeGridDay
                  }
                },
            });
            calendar.render();
            document.getElementById('btnGuardar').addEventListener('click',function() {

              enviar_datos('{{ route('citas.add') }}');
              
            });
            document.getElementById('btnEliminar').addEventListener('click',function() {
              var id_cita= $('#id').val();
              var url_borrar = "{{ route('citas.borrar', ':id') }}";
                  url_borrar = url_borrar.replace(':id', id_cita);
               enviar_datos(url_borrar);
            });

            document.getElementById('btnModificar').addEventListener('click',function() {
              var id_cita= $('#id').val();
              var url_actualizar = "{{ route('citas.actualizar', ':id') }}";
                  url_actualizar = url_actualizar.replace(':id', id_cita);
               enviar_datos(url_actualizar);
            });
             function enviar_datos(url) {
               const datos= new FormData(formulario);

              axios.post(url,datos).
              then(
                (respuesta) =>{
                  calendar.refetchEvents();
                  $('#modal_citas').modal('hide');
                }
                ).catch(
                  error => {
                    if (error.response) {
                      console.log(error.response.data);
                    }
                  });
             }
        });
   });
}
</script>