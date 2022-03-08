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

//console.log(pacienteE);
    if (pacienteE.length == 0) {
       $.getJSON('{{ route('buscar_paciente') }}?paciente='+paciente, function(objBP){
            $('#id_paciente').val(paciente);
            $('#id_pacienteE').val();
            $('#nombre').html(objBP['Nombres_Paciente']+' '+objBP['Apellidos_Paciente']);
            $('#sexo').html(objBP['Sexo']);
            $('#edad').html(calcularEdad(objBP['Fecha_Nacimiento_Paciente']));
        }); 

    }else{
        $.getJSON('{{ route('buscar_paciente') }}?pacienteE='+pacienteE, function(objBP){
            $('#id_paciente').val(paciente);
            $('#id_pacienteE').val(pacienteE);
            $('#nombre').html(objBP['Nombre_Paciente_Especial']+' '+objBP['Apellido_Paciente_Especial']);
            $('#sexo').html(objBP['Sexo']);
            $('#edad').html(calcularEdad(objBP['Fecha_Nacimiento_Paciente_Especial']));
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
            Swal.fire(info);
        }
    });
});
</script>
