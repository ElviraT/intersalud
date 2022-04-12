<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script src='https://meet.jit.si/external_api.js'></script>

<script type="text/javascript">
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
$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
         });
    });
$('#paciente').on('select2:select', function (e) {
   var paciente = $('#paciente').val();
    $.getJSON('{{ route('paciente_dependiente') }}?paciente='+paciente, function(objPE){
        var opcion = $('#pacienteE').val();
        $('#pacienteE').empty();
        $('#pacienteE').prop('disabled', true);
        $('#pacienteE').change();

        if(objPE.length >= 0){
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
});
var url_factura = "{{ route('ver_pdf', ':id') }}";
   url_factura = url_factura.replace(':id', '4'); //objBP[0]['id_Control_Historia_Medica']);

var factura = document.getElementById("factura");
   factura.href = url_factura;
function buscar() {
    var paciente = $('#paciente').val();
    var pacienteE =$('#pacienteE').val();
    var medico =$('#id_medico').val();

    if (pacienteE.length == 0) {
       $.getJSON('{{ route('buscar_paciente') }}?paciente='+paciente+'&medico='+medico, function(objBP){
        //switch(objBP[0]){
                if(objBP[0].length == 0){
                    $("form textarea").each(function() { this.value = '' });
                    $('#nombre').html('');
                    $('#sexo').html('');
                    $('#edad').html('');
                        $('#pop2-tab').attr('hidden', true);
                        $('#pop3-tab').attr('hidden', true);
                        $('#pop4-tab').attr('hidden', false);

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
                    $('#sexo').html(objBP[0]['Sexo']);
                    $('#control1').val(objBP[0]['id_Control_Historia_Medica']);
                    $('#control').val(objBP[0]['id_Control_Historia_Medica']);
                    $('#edad').html(calcularEdad(objBP[0]['Fecha_Nacimiento_Paciente']));
                    $('#Servicio').html(objBP[0]['Servicio']);
                        var ini1= objBP[2]['start'].split(" ");
                        var fin0= objBP[2]['end'].split(" ");
                        
                        restarHoras(ini1[1], fin0[1]);
                         var elemento = document.getElementById("enlace");
                           elemento.href = "http://wa.me/"+objBP[0]['Celular'];

                      /* var url_factura = "{{ route('ver_pdf', ':id') }}";
                           url_factura = url_factura.replace(':id', '17'); //objBP[0]['id_Control_Historia_Medica']);

                        var factura = document.getElementById("factura");
                           factura.href = url_factura;*/

                    if (objBP[1] != null) {
                    $('#id_antecedente').val(objBP[1]['id_antecedente']);
                    $('#personales').val(objBP[1]['Personal']);
                    $('#familiares').val(objBP[1]['Familiar']);
                    $('#farmacologicos').val(objBP[1]['Farmacologico']);
                    $('#fisico').val(objBP[1]['Examen_Fisico']);
                    $('#impresion').val(objBP[1]['Imprecion_Diagnostica']);

                        $('#pop2-tab').attr('hidden', false);
                        $('#pop3-tab').attr('hidden', false);
                        $('#pop4-tab').attr('hidden', false);
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

                $('#tiempo').html(objBP[2]['end']);

                if (objBP[1] != null) {
                $('#id_antecedente').val(objBP[1]['id_antecedente']);
                $('#personales').val(objBP[1]['Personal']);
                $('#familiares').val(objBP[1]['Familiar']);
                $('#farmacologicos').val(objBP[1]['Farmacologico']);
                $('#fisico').val(objBP[1]['Examen_Fisico']);
                $('#impresion').val(objBP[1]['Imprecion_Diagnostica']);

                        $('#pop2-tab').attr('hidden', false);
                        $('#pop3-tab').attr('hidden', false);
                        $('#pop4-tab').attr('hidden', false);
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
</script>
