{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_usuariosP = $('#table_usuariosP').DataTable({
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
    
    $(function () {
        var dtn = new Date();
        dtn.setFullYear(new Date().getFullYear()-18);
        //Date picker
        $('#fechNacP').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            viewMode: "years",
            endDate : dtn,
            todayHighlight: true,
            language: 'es'
        });

    });

    $(document).ready(function() {
            //variables
            var pass1 = $('#contrasena');
            var pass2 = $('#contrasena2');
            var boton = $('#btnusuario');
            var confirmacion = "Las contraseñas si coinciden";
            var negacion = "No coinciden las contraseñas";
            var vacio = "La contraseña no puede estar vacía";
            //oculto por defecto el elemento span
            var span = $('<span></span>').insertAfter(pass2);
            span.hide();
            //función que comprueba las dos contraseñas
            function coincidePassword(){
            var valor1 = pass1.val();
            var valor2 = pass2.val();
            //muestro el span
            span.show().removeClass();
            //condiciones dentro de la función
            if(valor1 != valor2){
                span.text(negacion).addClass('negacion');
                $('#btnusuario').attr("disabled", true);
            }
            if(valor1.length==0 || valor1==""){
                span.text(vacio).addClass('negacion');
                $('#btnusuario').attr("disabled", true);
            }
            if(valor1.length!=0 && valor1==valor2){
                span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
                $('#btnusuario').attr("disabled", false);
            }
            }
            //ejecuto la función al soltar la tecla
            pass2.keyup(function(){
            coincidePassword();
            });
        });
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

$('#confirm-delete17').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_usuariosP_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete17').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_usuariosP_eliminar",  this).attr('action', data.action);
    $('#modal_registo_usuariosP_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

$('#estado').on('change', function (e) {
   var estado = $('#estado').val();
    $.getJSON('{{ route('ciudad_dependiente') }}?estado='+estado, function(objC){
        var opcion = $('#ciudad').val();
        $('#ciudad').empty();
        $('#ciudad').prop('disabled', true);
        $('#ciudad').change();

        if(objC.length > 0){
            $.each(objC, function (i, ciudad) {
            $('#ciudad').append(
                    $('<option>', {
                        value: ciudad.id_Ciudad,
                        text : ciudad.Ciudad
                    })
                );
            });
            $('#ciudad').prop('disabled', false);
            $("#ciudad option:first").attr("selected", "selected");
        }        
    });

    $.getJSON('{{ route('municipio_dependiente') }}?estado='+estado, function(objM){
        var opcion = $('#municipio').val();
        $('#municipio').empty();
        $('#municipio').prop('disabled', true);
        $('#municipio').change();

        if(objM.length > 0){
            $.each(objM, function (i, municipio) {
            $('#municipio').append(
                    $('<option>', {
                        value: municipio.id_Municipio,
                        text : municipio.Municipio
                    })
                );
            });
            $('#municipio').change();
            $('#parroquia').prop('disabled', false);
            $('#municipio').prop('disabled', false);
        }        
    });
    
});

$('#municipio').on('change', function (e) {
    var municipio = $('#municipio').val();
    $.getJSON('{{ route('parroquia_dependiente') }}?municipio='+municipio, function(objP){
        var opcion = $('#parroquia').val();
        $('#parroquia').empty();
        $('#parroquia').prop('disabled', true);
        $('#parroquia').change();

        if(objP.length > 0){
            $.each(objP, function (i, parroquia) {
            $('#parroquia').append(
                    $('<option>', {
                        value: parroquia.id_Parroquia,
                        text : parroquia.Parroquia
                    })
                );
            });
            $('#parroquia').prop('disabled', false);
        }        
    });
});
</script>
