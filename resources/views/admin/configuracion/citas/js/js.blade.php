<!-- Fullcalendar -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/es.js') }}" type="text/javascript"></script>

<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">
  var array_dias = [];

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

$('#paciente').on('select2:select', function (e) {
  $('#modal_citas').addClass('loading');
   var paciente = $('#paciente').val();
    $.getJSON('{{ route('paciente_dependiente') }}?paciente='+paciente, function(objPE){
        var opcion = $('#pacienteE').val();
        $('#pacienteE').empty();
        $('#pacienteE').prop('disabled', true);
        $('#pacienteE').change();

        if(objPE.length > 0){
            $('#pacienteE').append(
                $('<option>', {
                    value: '',
                    text : 'Seleccione'
                }),
             );
            $.each(objPE, function (i, pacienteE) {
            $('#pacienteE').append(
                    $('<option>', {
                        value: pacienteE.id,
                        text : pacienteE.name
                    })
                );
            });
            $('#pacienteE').prop('disabled', false);
        }        
    });
  $('#modal_citas').removeClass('loading');
});

function horario() {
  var formulario = document.getElementById("Myform");
  var agenda = $('#agenda').val();
  var array_businessHours = [];
  var hora_minima='00:00:00';
  var hora_maxima='11:59:59';

   $.getJSON('{{ route('consultar_horario') }}?agenda='+agenda, function(objch){     
  loading_show();
        if (objch['Lunes'] == 0) {
            array_dias.push(1);
        }else{
          array_businessHours.push({
            daysOfWeek: [1],
            startTime: objch['Hora_Inicio_Lunes'],
            endTime: objch['Hora_Fin_Lunes']
          });
          hora_minima = objch['Hora_Inicio_Lunes'];
          hora_maxima = objch['Hora_Fin_Lunes'];
        }
        if (objch['Martes'] == 0) {
            array_dias.push(2); 
        }else{
          array_businessHours.push({
            daysOfWeek: [2],
            startTime: objch['Hora_Inicio_Martes'],
            endTime: objch['Hora_Fin_Martes']
          });
          hora_minima = objch['Hora_Inicio_Martes'];
          hora_maxima = objch['Hora_Fin_Martes'];
        }
        if (objch['Miercoles'] == 0) {
            array_dias.push(3);  
        }else{
          array_businessHours.push({
            daysOfWeek: [3],
            startTime: objch['Horario_Inicio_Miercoles'],
            endTime: objch['Horario_Fin_Miercoles']
          });
          hora_minima = objch['Horario_Inicio_Miercoles'];
          hora_maxima = objch['Horario_Fin_Miercoles'];
        }
        if (objch['Jueves'] == 0) {
            array_dias.push(4);  
        }else{
          array_businessHours.push({
            daysOfWeek: [4],
            startTime: objch['Horario_Inicio_Jueves'],
            endTime: objch['Horario_Fin_Jueves']
          });
          hora_minima = objch['Horario_Inicio_Jueves'];
          hora_maxima = objch['Horario_Fin_Jueves'];
        }
        if (objch['Viernes'] == 0) {
            array_dias.push(5); 
        }else{
          array_businessHours.push({
            daysOfWeek: [5],
            startTime: objch['Horario_Inicio_Viernes'],
            endTime: objch['Horario_Fin_Viernes']
          });
          hora_minima = objch['Horario_Inicio_Viernes'];
          hora_maxima = objch['Horario_Fin_Viernes'];
        }
        if (objch['Sabado'] == 0) {
            array_dias.push(6);  
        }else{
          array_businessHours.push({
            daysOfWeek: [6],
            startTime: objch['Horario_Inicio_Sabado'],
            endTime: objch['Horario_Fin_Sabado']
          });
          hora_minima = objch['Horario_Inicio_Sabado'];
          hora_maxima = objch['Horario_Fin_Sabado'];
        }
        if (objch['Domingo'] == 0) {
            array_dias.push(0);
        }else{
          array_businessHours.push({
            daysOfWeek: [0],
            startTime: objch['Horario_inicio_Domingo'],
            endTime: objch['Horario_Fin_Domingo']
          });
          hora_minima = objch['Horario_inicio_Domingo'];
          hora_maxima = objch['Horario_Fin_Domingo'];
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
              @can('citas.add')
              dateClick:function(info) {
                loading_show();
                formulario.reset();
                $('#btnGuardar').attr('hidden', false);
                $('#btnModificar').attr('hidden', true);
                $('#btnEliminar').attr('hidden', true);
                $('#confirmado').attr('checked',false).change();
                $('#paciente').val('').change();
                $('#pacienteE').val('').change();
                if(info.allDay){
                  $('#start').val(info.dateStr);
                  $('#end').val(info.dateStr);
                }else{
                  let fechaHora = info.dateStr.split("T");
                  var fechaInicio= fechaHora[0]+' '+fechaHora[1].substring(0, 8);
                  var fecha_minima = fechaHora[0]+' '+hora_minima;
                  var fecha_maxima = fechaHora[0]+' '+hora_maxima;
                  if(fechaHora[1].substring(0, 8) >= hora_minima){
                      $('#start').val(fechaInicio);
                  }else{
                      $('#start').val(fecha_minima);
                  }
                  $('#end').val(fechaInicio);
                  $('#end').attr('min',fechaInicio);
                  $('#end').attr('max',fecha_maxima);
                }
                $('#modal_citas').on('show.bs.modal', function (e) {
                  var agenda2 = $('#agenda').val();
                   $.getJSON('{{ route('datos_agenda') }}?agenda2='+agenda2, function(objA){
                     $('#Agenda_id').val(objA['id_Agenda']);
                     $('#mpaciente').val(objA['Max_pacientes']);
                     $('#costo').val(objA['Costo_consulta']);
                  });
                });
                $('#modal_citas').modal('show');
                loading_hide();
              },
              @endcan
              @can('citas.edit')
              eventClick:function(info) {
                $('#btnGuardar').attr('hidden', true);
                $('#btnModificar').attr('hidden', false);
                $('#btnEliminar').attr('hidden', false);
                var cita=info.event;
                 var url_edit = "{{ route('citas.editar', ':id') }}";
                  url_edit = url_edit.replace(':id', cita.extendedProps.id_Cita_Consulta);
                axios.post(url_edit).
                then(
                  (respuesta) =>{
                   $('#id').val(cita.extendedProps.id_Cita_Consulta);
                   $('#Agenda_id').val(cita.extendedProps.Agenda_id);
                   $('#paciente').val(cita.extendedProps.Paciente_id).change();
                   $('#pacienteE').val(cita.extendedProps.Paciente_Especial_id).change();
                   $('#mpaciente').val(cita.extendedProps.Max_paciente);
                   $('#costo').val(cita.extendedProps.Costo);
                   if (respuesta.data[0].confirmado == '1'){
                      $('#confirmado').attr('checked', true);
                   }
                   $('#nota').val(cita.extendedProps.Nota);
                   $('#title').val(cita.title);
                   $('#start').val(respuesta.data[0].start);
                   $('#end').val(respuesta.data[0].end);
                   $('#modal_citas').modal('show');
                  }
                  ).catch(
                    error => {
                      if (error.response) {
                        console.log(error.response.data);
                      }
                    });
              },
              @endcan
              views: {
                  timeGrid: {
                    eventLimit: 3 // adjust to 3 only for timeGridWeek/timeGridDay
                  }
                },
            });
            calendar.render();
            loading_hide();
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
$(function () {
   $('#date-start').datetimepicker({
    format: 'Y-MM-DD HH:mm',
    locale: 'es',
   });
   $('#date-end').datetimepicker({
   format: 'Y-MM-DD HH:mm',
   locale: 'es',
   daysOfWeekDisabled: array_dias,
   });
   $("#date-start").on("dp.change", function (e) {
       $('#date-end').data("DateTimePicker").minDate(e.date);
   });
   $("#date-end").on("dp.change", function (e) {
       $('#date-start').data("DateTimePicker").maxDate(e.date);
   });
});
</script>