<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    localStorage.removeItem('selectedTab');
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
       $.getJSON('{{ route('buscarP') }}?paciente='+paciente+'&medico='+medico, function(objBP){
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

                    if (objBP[1] != null) {
                        $('#id_antecedente').val(objBP[1]['id_antecedente']);
                        $('#personales').val(objBP[1]['Personal']);
                        $('#familiares').val(objBP[1]['Familiar']);
                        $('#farmacologicos').val(objBP[1]['Farmacologico']);
                        $('#fisico').val(objBP[1]['Examen_Fisico']);
                        $('#impresion').val(objBP[1]['Imprecion_Diagnostica']);

                        if (objBP[2] != null) {
                            $('#pop2-tab').attr('hidden', false);
                        }else{
                            $('#pop2-tab').attr('hidden', true);
                        }
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
        $.getJSON('{{ route('buscarP') }}?pacienteE='+pacienteE+'&medico='+medico, function(objBPE){
            //console.log(objBPE[0]);
            if(objBPE[0] == null){
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
                          data: objBPE[3],
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
                    $('#id_pacienteE').val(pacienteE);
                    $('#id_pacienteA').val(paciente);
                    $('#id_pacienteEA').val(pacienteE);
                    $('#nombre').html(objBPE['Nombre_Paciente_Especial']+' '+objBPE['Apellido_Paciente_Especial']);
                    $('#sexo').html(objBPE['Sexo']);
                    $('#control1').val(objBPE[0]['id_Control_Historia_Medica']);
                    $('#control').val(objBPE[0]['id_Control_Historia_Medica']);
                    $('#edad').html(calcularEdad(objBPE['Fecha_Nacimiento_Paciente_Especial']));

                    if (objBPE[1] != null) {
                        $('#id_antecedente').val(objBPE[1]['id_antecedente']);
                        $('#personales').val(objBPE[1]['Personal']);
                        $('#familiares').val(objBPE[1]['Familiar']);
                        $('#farmacologicos').val(objBPE[1]['Farmacologico']);
                        $('#fisico').val(objBPE[1]['Examen_Fisico']);
                        $('#impresion').val(objBPE[1]['Imprecion_Diagnostica']);
                            
                            if (objBPE[2] != null) {
                                $('#pop2-tab').attr('hidden', false);
                            }else{
                                $('#pop2-tab').attr('hidden', true);
                            }
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
                          data: objBPE[3],
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
