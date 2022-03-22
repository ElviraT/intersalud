<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

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
function buscar() {
    var paciente = $('#paciente').val();
    var pacienteE =$('#pacienteE').val();
    var medico =$('#id_medico').val();

    if (pacienteE.length == 0) {
       $.getJSON('{{ route('buscarP') }}?paciente='+paciente+'&medico='+medico, function(objBP){
        console.log(objBP);
            switch(objBP[0]){
                case null:
                    $("form textarea").each(function() { this.value = '' });
                    $('#nombre').html('');
                    $('#sexo').html('');
                    $('#edad').html('');
                        $('#pop2-tab').attr('hidden', true);
                        $('#pop3-tab').attr('hidden', true);
                        $('#pop4-tab').attr('hidden', true);
                    Swal.fire('Este paciente no tiene Cita');
                break;
                default:
                    $('#id_paciente').val(paciente);
                    $('#id_pacienteE').val();
                    $('#id_pacienteA').val(paciente);
                    $('#id_pacienteEA').val();
                    $('#nombre').html(objBP[0]['Nombres_Paciente']+' '+objBP[0]['Apellidos_Paciente']);
                    $('#sexo').html(objBP[0]['Sexo']);
                    $('#control1').val(objBP[0]['id_Control_Historia_Medica']);
                    $('#control').val(objBP[0]['id_Control_Historia_Medica']);
                    $('#edad').html(calcularEdad(objBP[0]['Fecha_Nacimiento_Paciente']));

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
                      info: false,
                      data: objBP[2],
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
        $.getJSON('{{ route('buscarP') }}?pacienteE='+pacienteE+'&medico='+medico, function(objBP){
            switch(objBP[0]){
                case null:
                    $("form textarea").each(function() { this.value = '' });
                    $('#nombre').html('');
                    $('#sexo').html('');
                    $('#edad').html('');
                    Swal.fire('Este paciente no tiene Cita');
                break;
                default:
                $('#id_paciente').val(paciente);
                $('#id_pacienteE').val(pacienteE);
                $('#id_pacienteA').val(paciente);
                $('#id_pacienteEA').val(pacienteE);
                $('#nombre').html(objBP['Nombre_Paciente_Especial']+' '+objBP['Apellido_Paciente_Especial']);
                $('#sexo').html(objBP['Sexo']);
                $('#control1').val(objBP[0]['id_Control_Historia_Medica']);
                $('#control').val(objBP[0]['id_Control_Historia_Medica']);
                $('#edad').html(calcularEdad(objBP['Fecha_Nacimiento_Paciente_Especial']));

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
                      info: false,
                      data: objBP[2],
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
        url: "{{ route('consulta.add') }}",
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
        url: "{{ route('consulta.add2') }}",
        data: datos,
        success: function(info)
        {
            Swal.fire(info);
        }
    });
});
</script>
