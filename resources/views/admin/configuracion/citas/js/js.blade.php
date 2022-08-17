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
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
  var array_dias = [];
   $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
            });
    });

var xhr;
var select_paciente, $select_paciente;
var select_pacienteE, $select_pacienteE;

$select_paciente = $('#paciente').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
    var tituloP = $('select[name="Paciente_id"] option:selected').text();
    $('#titleP').val(tituloP);
    $('#modal_citas').addClass('loading');
        if (!value.length) return;
        /*listar paciente especial*/
        select_pacienteE.disable();
        select_pacienteE.clearOptions();
        select_pacienteE.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('paciente_dependiente') }}?paciente='+value,
                success: function(results) {
                    select_pacienteE.enable();
                    callback(results);
                    if (results[0]) {
                        select_pacienteE.setValue(results[0].id);
                    }
                },
                error: function() {
                    callback();
                }
            })
        });
        $('#modal_citas').removeClass('loading');
    }
});


$select_pacienteE = $('#pacienteE').selectize({
                    labelField: 'name',
                    valueField: 'id',
                    searchField: ['name'],
                    loadingClass: 'loading'
                });

                select_pacienteE  = $select_pacienteE[0].selectize;
                select_paciente = $select_paciente[0].selectize;

                select_pacienteE.disable();

function disponibilidad(agenda, start) {
  $.getJSON('{{ route('disponibilidad') }}?agenda='+agenda+'&start='+start, function(objDis){
      var total = parseInt(objDis['Max_paciente']) - parseInt(objDis['count']);
      $('#disponibilidad').val(total); 
      
      if (total == '0') {
        $('#texto').attr('hidden', false);
        $('#btnGuardar').attr('hidden', true);
      }else{
        $('#texto').attr('hidden', true);
      }
  });
}

function horario() {
  var formulario = document.getElementById("Myform");
  var agenda = $('#agenda').val();
  var array_businessHours = [];
  var hora_minima='00:00:00';
  var hora_maxima='11:59:59';
  var array_dias= [];
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl);

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
        var xhr;
var select_servicio, $select_servicio;

$select_servicio = $('#id_servicio').selectize({
    loadingClass: 'loading',
    preload: true,
    valueField: 'id_Servicio',
    labelField: 'Servicio',
    searchField: 'text',
    load: function(query, callback) {
      $.ajax({
        url: '{{ route('servicios_lista') }}?medico='+objch['Medico_id']+ encodeURIComponent(query),
        type: 'GET',
        error: function() {
          callback();
        },
        success: function(res) {
          callback(res);
        }
      });
    },
    onChange: function(value) {
    $('#modal_citas').addClass('loading');
        if (!value.length) return;
          var start = $('#start').val();
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('duracion_servicio') }}?servicio='+value+'&start='+start,
                success: function(results) {
                    $('#costo').val(results[1].Costos);
                    $('#end').val(results[0][0].end);             
                },
                error: function() {
                    callback();
                }
            });

        $('#modal_citas').removeClass('loading');
    }
});
        select_servicio = $select_servicio[0].selectize;

var id_Agenda= objch['id_Agenda'];
   $(function() {
            var url = "{{ route('citas.mostrar', ':id') }}";
            url = url.replace(':id', id_Agenda);
            $('#btnGuardar').attr('disabled', false);

            calendar = new FullCalendar.Calendar(calendarEl, {
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
                var check = moment(info.dateStr).format('Y-M-D');
                var today = moment(new Date()).format('Y-M-D');
                //alert(Date.parse(check)+' '+Date.parse(today));
                if (Date.parse(check) >= Date.parse(today)) {
                    let fechaHora = info.dateStr.split("T");
                    loading_show();
                    formulario.reset();
                    $('#btnGuardar').attr('hidden', false);
                    $('#btnModificar').attr('hidden', true);
                    $('#btnEliminar').attr('hidden', true);
                    $('#confirmado').attr('checked',false).change();
                    $('#online').attr('checked',false).change();
                    $('#paciente').val('').change();
                    $('#pacienteE').val('').change();
                    if(info.allDay){
                      $('#start').val(info.dateStr);
                    }else{
                      var fechaInicio= fechaHora[0]+' '+fechaHora[1].substring(0, 8);
                      var fecha_minima = fechaHora[0]+' '+hora_minima;
                      if(fechaHora[1].substring(0, 8) >= hora_minima){
                          $('#start').val(fechaInicio);
                      }else{
                          $('#start').val(fecha_minima);
                      }
                    }
                    $('#modal_citas').on('show.bs.modal', function (e) {
                      var agenda2 = $('#agenda').val();
                       $.getJSON('{{ route('datos_agenda') }}?agenda2='+agenda2, function(objA){
                      
                         $('#Agenda_id').val(objA['id_Agenda']);
                         $('#mpaciente').val(objA['Max_pacientes']);
                         $('#notaM').val(objA['Nota']);
                         
                      });
                    });
                    $('#modal_citas').modal('show');
                    loading_hide();
                    disponibilidad(id_Agenda,fechaHora[0]);
                      $('#modal_citas').removeClass('loading');
                    }
                // si no, mostramos una alerta de error
                else {
                  Swal.fire(
                    '¡Error!',
                    'No se pueden crear eventos en el pasado!',
                    'error'
                  );
                }
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
                  let fechaHora = respuesta.data[0].start.split(" ");
                    disponibilidad(cita.extendedProps.Agenda_id,fechaHora[0]);
                   $('#id').val(cita.extendedProps.id_Cita_Consulta);
                   $('#Agenda_id').val(cita.extendedProps.Agenda_id);
                   $select_paciente[0].selectize.setValue(cita.extendedProps.Paciente_id, true);
                   $select_pacienteE[0].selectize.setValue(cita.extendedProps.Paciente_Especial_id);
                   $('#mpaciente').val(cita.extendedProps.Max_paciente);
                   $('#costo').val(cita.extendedProps.Costo.toFixed(2));
                   if(respuesta.data[0].confirmado == '1'){
                      $('#confirmado').prop("checked",true);
                   }else{
                      $('#confirmado').prop("checked",false);                    
                   }
                   if(respuesta.data[0].online == '1'){
                      $('#online').prop("checked",true);
                   }else{
                      $('#online').prop("checked",false);
                   }
                   $('#nota').val(cita.extendedProps.Nota);
                   $('#title').val(cita.title);
                   $('#start').val(respuesta.data[0].start);
                   $('#end').val(respuesta.data[0].end);
                   $select_servicio[0].selectize.setValue(respuesta.data[0].id_servicio, true);
                   $('#modal_citas').modal('show');
                   $('#modal_citas').removeClass('loading');
                  }
                  ).catch(
                    error => {
                      if (error.response) {
                        console.log(error.response.data);
                      }
                    });
                  $('#modal_citas').on('show.bs.modal', function (e) {
                      var agenda2 = $('#agenda').val();
                       $.getJSON('{{ route('datos_agenda') }}?agenda2='+agenda2, function(objA){
                      
                         $('#notaM').val(objA['Nota']);
                         
                      });
                    });
                    $('#modal_citas').modal('show');
                    loading_hide();
              },
              @endcan
              views: {
                  timeGrid: {
                    eventLimit: 3 // adjust to 3 only for timeGridWeek/timeGridDay
                  }
                },
            });
            loading_hide();
            calendar.render();
            document.getElementById('btnGuardar').addEventListener('click',function() {
              var id_servicio = $("#id_servicio").val();
              var nota = $("#nota").val();
              var title =$("#title").val();
                if (id_servicio.length == 0 || nota.length == 0|| title.length == 0) {
                  $('#validaciones').css('display', 'block');
                  $('#btnGuardar').attr('disabled', false);
                }else{
                  $('#btnGuardar').attr('disabled', true);           
                  enviar_datos('{{ route('citas.add') }}');
                }           
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
$(".cierra").click(function(){
  $("#modal_citas").modal('hide');
});
$('#modal_citas').on('hidden.bs.modal', function (event) {
  $('#btnGuardar').attr('disabled', false);
  $('#id_servicio')[0].selectize.clear();
  $('#pacienteE')[0].selectize.clear();
  $('#paciente')[0].selectize.clear();
  $('#validaciones').css('display', 'none');
})
$(function () {
   $('#date-start').datetimepicker({
    format: 'Y-MM-DD HH:mm',
    locale: 'es',
   });
   $('#date-end').datetimepicker({
   format: 'Y-MM-DD HH:mm',
   locale: 'es',
   });
});

</script>