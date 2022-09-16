{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

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

$(function() {
    $('.otro').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
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

$('#confirm-delete17').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_usuariosP_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete17').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_usuariosP_eliminar",  this).attr('action', data.action);
    $('#modal_registo_usuariosP_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

function show_paciente(id) {
    loading_show();
    $.getJSON('{{ route('usuario_p.show') }}?id='+id, function(obj_Paciente){ 
        var data_familia = obj_Paciente[1];
        $("#ver-paciente").modal("show");
        $("#titulo_h4").text(obj_Paciente[0]['nombre']);
        $("#cedula").text(obj_Paciente[0]['cedula']);
        $("#telefono").text(obj_Paciente[0]['Telefono']);

        var table = $("#familiares").DataTable({
            lengthChange: false,
            responsive: true,
            destroy: true,
            info: false,
            data: data_familia,
            columns: [
                { title: "Parentesco", data: "Parentesco_Familiar" },
                { title: "Nombre", data: "nombre" }
              ],

            language: {
                url: "{{ asset('js/Spanish.json') }}",
            },
        });
    });
    loading_hide();
}
$('#ver-paciente').on('hidden.bs.modal', function (e) {
    loading_show();
    $('#titulo_h4').val('');
    $('#cedula').val('');
    $('#telefono').val('');
    loading_hide();
});

</script>
