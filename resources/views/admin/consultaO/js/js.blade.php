<!-- Fullcalendar -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/es.js') }}" type="text/javascript"></script>

<!--datepicker-->
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
<script src='https://meet.jit.si/external_api.js'></script>

<script type="text/javascript">
    var array_dias = [];
localStorage.removeItem('selectedTab');
function iniciar_reunion() {
    $('#meet').attr('hidden',false);
    const domain = 'meet.jit.si';
    const options = {
        roomName: 'ConsultaOnline',
        width: 500,
        height: 600,
        parentNode: document.querySelector('#meet'),
        lang: 'es',
        userInfo: {
            email: '{{auth()->user()->email}}',
            displayName: '{{auth()->user()->name}}'
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);
}
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

function add_servicio(){
    "use strict";
    var id_servicio = $('#addServicio').val();
    var Cita_Consulta_id = $('#Cita_Consulta_id').val();

    $.ajax({
    url: "{{ route('add_servicio') }}",
    method: 'POST',
    data:{_token: "{{ csrf_token() }}", id_servicio: id_servicio, Cita_Consulta_id: Cita_Consulta_id},
    }).done(function(res) {
        console.log(res);
        if(res.status == 'success') {
            $('#addServicio').val('').change();
            $('#status_servicio').html("<span class='badge mt-2 bg-green'>{{ 'Registro Agregado' }}</span>");
        }else{
            $('#status_servicio').html("<span class='badge mt-2 bg-red'>{{ 'Error al Agregar' }}</span>");
        }
            window.setTimeout(function() { $("#status_servicio").html(''); }, 3000);
    });
}

var xhr;
var select_paciente, $select_paciente;
var select_pacienteE, $select_pacienteE;

$select_paciente = $('#paciente').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar pacientes especiales*/
        select_pacienteE.disable();
        select_pacienteE.clearOptions();
        select_pacienteE.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('paciente_dependiente') }}?paciente='+value,
                success: function(results) {
                    select_pacienteE.enable();
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
       
    }
});

$select_pacienteE = $('#pacienteE').selectize({
                    labelField: 'name',
                    valueField: 'id',
                    searchField: ['name'],
                    loadingClass: 'loading',
                });

                select_pacienteE  = $select_pacienteE[0].selectize;
                select_paciente = $select_paciente[0].selectize;

                select_pacienteE.disable();



function buscar() {
    var paciente = $('#paciente').val();
    var pacienteE =$('#pacienteE').val();
    var medico =$('#id_medico').val();

    if (pacienteE.length == 0) {
       $.getJSON('{{ route('buscar_paciente') }}?paciente='+paciente+'&medico='+medico, function(objBP){
                if(objBP[0] == null || objBP[0].length == 0){
                    $("form textarea").each(function() { this.value = '' });
                    $('#nombre').html('');
                    $('#sexo').html('');
                    $('#edad').html('');
                        $('#pop2-tab').attr('hidden', true);
                        $('#pop3-tab').attr('hidden', true);
                        $('#pop4-tab').attr('hidden', false);
                        $('#pop5-tab').attr('hidden', false);

                        $('#myTable').DataTable({
                          destroy: true,
                          info: false,
                          data: objBP[3],
                          responsive: true,
                                language: {
                                    url: "{{ asset('js/Spanish.json') }}",
                                },
                          columns: [
                            { title: "Fecha", data: "Fecha" },
                            { title: "Enfermedad Actual", data: "Enfermedad_Actual" },
                            { title: "Origen", data: "Origen" },
                            { title: "Diagnostico Definitivo", data: "Diagnostico_Definitivo" },
                            { title: "Pronostico", data: "Pronostico" }
                          ]
                        });
                    Swal.fire('No tiene cita');
               }else{
                    $('#id_paciente').val(paciente);
                    $('#id_pacienteE').val();
                    $('#id_pacienteA').val(paciente);
                    $('#id_pacienteEA').val();
                    $('#nombre').html(objBP[0]['Nombres_Paciente']+' '+objBP[0]['Apellidos_Paciente']);
                    $('#titleP').val(objBP[0]['Nombres_Paciente']+' '+objBP[0]['Apellidos_Paciente']);
                    $('#sexo').html(objBP[0]['Sexo']);
                    $('#control1').val(objBP[0]['id_Control_Historia_Medica']);
                    $('#control').val(objBP[0]['id_Control_Historia_Medica']);
                    $('#edad').html(calcularEdad(objBP[0]['Fecha_Nacimiento_Paciente']));
                    $('#Servicio').html(objBP[0]['Servicio']);
                    //console.log(objBP[2]);
                            if (objBP[2] != null) {
                                $('#Cita_Consulta_id').val(objBP[2]['id_Cita_Consulta']);
                                    var ini1= objBP[2]['start'].split(" ");
                                    var fin0= objBP[2]['end'].split(" ");
                                    restarHoras(ini1[1], fin0[1]);
                                    
                                    $('#pop2-tab').attr('hidden', false);
                                    $('#consulta').attr('hidden', false);
                                }else{
                                    $('#pop2-tab').attr('hidden', true);
                                    $('#consulta').attr('hidden', true);
                                }
                     var elemento = document.getElementById("enlace");
                       elemento.href = "http://wa.me/"+objBP[0]['Celular'];

                    if (objBP[1] != null) {
                        $('#id_antecedente').val(objBP[1]['id_antecedente']);
                        $('#personales').val(objBP[1]['Personal']);
                        $('#familiares').val(objBP[1]['Familiar']);
                        $('#farmacologicos').val(objBP[1]['Farmacologico']);
                        $('#fisico').val(objBP[1]['Examen_Fisico']);
                        $('#impresion').val(objBP[1]['Imprecion_Diagnostica']);

                            $('#pop3-tab').attr('hidden', false);
                            $('#pop4-tab').attr('hidden', false);
                            $('#pop5-tab').attr('hidden', false);
                    }else{
                        $('#id_antecedente').val('');
                        $('#personales').val('');
                        $('#familiares').val('');
                        $('#farmacologicos').val('');
                        $('#fisico').val('');
                        $('#impresion').val('');

                        $('#pop2-tab').attr('hidden', true);
                        $('#pop3-tab').attr('hidden', true);
                        $('#pop4-tab').attr('hidden', true);
                        $('#pop5-tab').attr('hidden', true);
                    }

                    $('#myTable').DataTable({
                      destroy: true,
                      info: false,
                      data: objBP[3],
                      responsive: true,
                        language: {
                            url: "{{ asset('js/Spanish.json') }}",
                        },
                      columns: [
                        { title: "Fecha", data: "Fecha" },
                        { title: "Enfermedad Actual", data: "Enfermedad_Actual" },
                        { title: "Origen", data: "Origen" },
                        { title: "Diagnostico Definitivo", data: "Diagnostico_Definitivo" },
                        { title: "Pronostico", data: "Pronostico" }
                      ]
                    });
            }
        }); 

    }else{
        $.getJSON('{{ route('buscar_paciente') }}?pacienteE='+pacienteE+'&medico='+medico, function(objBP){
            switch(objBP[0]){
                case null:
                    $("form textarea").each(function() { this.value = '' });
                    $('#nombre').html('');
                    $('#sexo').html('');
                    $('#edad').html('');
                        $('#pop2-tab').attr('hidden', true);
                        $('#pop3-tab').attr('hidden', true);
                        $('#pop4-tab').attr('hidden', false);
                        $('#pop5-tab').attr('hidden', false);

                        $('#myTable').DataTable({
                          destroy: true,
                          info: false,
                          data: objBP[3],
                          responsive: true,
                            language: {
                                url: "{{ asset('js/Spanish.json') }}",
                            },
                          columns: [
                            { title: "Fecha", data: "Fecha" },
                            { title: "Enfermedad Actual", data: "Enfermedad_Actual" },
                            { title: "Origen", data: "Origen" },
                            { title: "Diagnostico Definitivo", data: "Diagnostico_Definitivo" },
                            { title: "Pronostico", data: "Pronostico" }
                          ]
                        });
                    Swal.fire('No tiene cita');
                break;
                default:
                $('#id_paciente').val(paciente);
                $('#id_pacienteE').val(pacienteE);
                $('#id_pacienteA').val(paciente);
                $('#id_pacienteEA').val(pacienteE);
                $('#nombre').html(objBP[0]['Nombre_Paciente_Especial']+' '+objBP[0]['Apellido_Paciente_Especial']);
                $('#sexo').html(objBP[0]['Sexo']);
                $('#control1').val(objBP[0]['id_Control_Historia_Medica']);
                $('#control').val(objBP[0]['id_Control_Historia_Medica']);
                $('#edad').html(calcularEdad(objBP[0]['Fecha_Nacimiento_Paciente_Especial']));
                $('#Servicio').html(objBP[0]['Servicio']);
                 if (objBP[2] != null) {
                                $('#Cita_Consulta_id').val(objBP[2]['id_Cita_Consulta']);
                                    var ini1= objBP[2]['start'].split(" ");
                                    var fin0= objBP[2]['end'].split(" ");
                                    
                                    restarHoras(ini1[1], fin0[1]);
                                $('#pop2-tab').attr('hidden', false);
                                $('#consulta').attr('hidden', false);
                            }else{
                                $('#pop2-tab').attr('hidden', true);
                                $('#consulta').attr('hidden', true);
                            }
                     var elemento = document.getElementById("enlace");
                       elemento.href = "http://wa.me/"+objBP[0]['Celular'];

                if (objBP[1] != null) {
                $('#id_antecedente').val(objBP[1]['id_antecedente']);
                $('#personales').val(objBP[1]['Personal']);
                $('#familiares').val(objBP[1]['Familiar']);
                $('#farmacologicos').val(objBP[1]['Farmacologico']);
                $('#fisico').val(objBP[1]['Examen_Fisico']);
                $('#impresion').val(objBP[1]['Imprecion_Diagnostica']);
                        $('#pop3-tab').attr('hidden', false);
                        $('#pop4-tab').attr('hidden', false);
                        $('#pop5-tab').attr('hidden', false);
                    }else{
                        $('#id_antecedente').val('');
                        $('#personales').val('');
                        $('#familiares').val('');
                        $('#farmacologicos').val('');
                        $('#fisico').val('');
                        $('#impresion').val('');

                        $('#pop2-tab').attr('hidden', true);
                        $('#pop3-tab').attr('hidden', true);
                        $('#pop4-tab').attr('hidden', true);
                        $('#pop5-tab').attr('hidden', true);
                    }
                    $('#myTable').DataTable({
                      destroy: true,
                      info: false,
                      data: objBP[3],
                      columns: [
                        { title: "Fecha", data: "Fecha" },
                        { title: "Enfermedad Actual", data: "Enfermedad_Actual" },
                        { title: "Origen", data: "Origen" },
                        { title: "Diagnostico Definitivo", data: "Diagnostico_Definitivo" },
                        { title: "Pronostico", data: "Pronostico" }
                      ]
                    });
            }
        });
    }
    
}

function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}
// tab
$('#nav-tab a:first').tab('show');

//for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//save the latest tab; use cookies if you like 'em better:
localStorage.setItem('selectedTab', $(e.target).attr('id'));
});

//go to the latest tab, if it exists:
var selectedTab = localStorage.getItem('selectedTab');
if (selectedTab) {
  $('#'+selectedTab).tab('show');
}
$("#formulario1").submit(function(event) {
    event.preventDefault();

    var datos = jQuery(this).serialize();
    jQuery.ajax({
        type: "POST",
        url: "{{ route('consultao.add') }}",
        data: datos,
        success: function(info)
        {
            $('#pop2-tab').attr('hidden', false);
            $('#pop3-tab').attr('hidden', false);
            $('#pop4-tab').attr('hidden', false);
            $('#pop5-tab').attr('hidden', false);
            Swal.fire(info);
        }
    });
});
$("#formulario2").submit(function(event) {
    event.preventDefault();

    var datos = jQuery(this).serialize();
    jQuery.ajax({
        type: "POST",
        url: "{{ route('consultao.add2') }}",
        data: datos,
        success: function(info)
        {
            Swal.fire(info);
            location.reload();
        }
    });
});

//CONTEO ATRAS
function countDown() {

        var toHour = document.getElementById("hour").value;
        var toMinute = document.getElementById("minute").value;
        var toSecond = document.getElementById("second").value;

        toSecond = toSecond - 1;

        if (toSecond < 0) {
            toSecond = 59;
            toMinute = toMinute - 1;
        }

        form.second.value = toSecond;
        if (toMinute < 0) {

            toMinute = 59;
            toHour = toHour - 1;
        }

        form.minute.value = toMinute;
        form.hour.value = toHour;

        if (toHour < 0) {
            //final
            form.second.value = 0;
            form.minute.value = 0;
            form.hour.value = 0;
            $("#inicio").attr('hidden', true);
        } else {
            setTimeout(countDown, 1000);
        }
    }


function restarHoras(inicio1, fin1) {

  inicio = inicio1;
  fin = fin1;
  inicioMinutos = parseInt(inicio.substr(3,2));
  inicioHoras = parseInt(inicio.substr(0,2));
  
  finMinutos = parseInt(fin.substr(3,2));
  finHoras = parseInt(fin.substr(0,2));

  transcurridoMinutos = finMinutos - inicioMinutos;
  transcurridoHoras = finHoras - inicioHoras;
  
  if (transcurridoMinutos < 0) {
    transcurridoHoras--;
    transcurridoMinutos = 60 + transcurridoMinutos;
  }
  
  horas = transcurridoHoras.toString();
  minutos = transcurridoMinutos.toString();
  
  if (horas.length < 2) {
    horas = "0"+horas;
  }
  
  if (horas.length < 2) {
    horas = "0"+horas;
  }
  //console.log(horas, minutos);
  $("#hour").val(horas);
  $("#minute").val(minutos);
  $("#second").val(0);
  $("#inicio").attr('hidden', false);


}

/*CITAS EN CONSULTA*/
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


function horario2() {
  var idpaciente = $('#paciente').val();
  var idpacienteE = $('#pacienteE').val();
  var formulario = document.getElementById("Myform");
  var agenda = $('#agenda').val();
  var array_businessHours = [];
  var hora_minima='00:00:00';
  var hora_maxima='11:59:59';
  var array_dias= [];
  var calendarEl = document.getElementById('calendar_cita');
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
        if(objch['Domingo'] == 0){
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

        var xhrc;
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
                    $select_paciente[0].selectize.setValue(idpaciente);
                    $select_pacienteE[0].selectize.setValue(idpacienteE);
                }
              });
            },
            onChange: function(value) {
            $('#modal_citas').addClass('loading');
                if (!value.length) return;
                  var start = $('#start').val();
                    xhrc && xhrc.abort();
                    xhrc = $.ajax({
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
                    let fechaHora = info.dateStr.split("T");
                    loading_show();
                    formulario.reset();
                    $('#btnGuardar').attr('hidden', false);
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
              $('#btnGuardar').attr('disabled', true);
              enviar_datos('{{ route('citas.add') }}');              
            });
                        
            function enviar_datos(url) 
            {
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
                    }
                 );
            }
        });
   });
};
$('#modal_citas').on('hidden.bs.modal', function (event) {
  $('#btnGuardar').attr('disabled', false);
  $('#id_servicio')[0].selectize.clear();
  $('#modal_citas').removeClass('loading');
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
/*FIN DE CITAS EN CONSULTAS*/
</script>
