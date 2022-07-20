{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_usuariosA = $('#table_usuariosA').dataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
            },
        });
    });
  
$(function() {
    $('.pickerSelectClass').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
    });
});

$(function () {
    var dtn = new Date();
    dtn.setFullYear(new Date().getFullYear()-18);
    //Date picker
    $('#fechNacA').datepicker({
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

$('#confirm-delete16').on('click', '.btn-ok', function(e) {
    var $modalDiv = $(e.delegateTarget);
    $modalDiv.addClass('loading');
    setTimeout(function(){
        $('#form_usuariosA_eliminar').submit();
    }, 2000);
});

$('#confirm-delete16').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_usuariosA_eliminar",  this).attr('action', data.action);
    $('#modal_registo_usuariosA_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

$('#confirm-delete35').on('click', '.btn-ok', function(e) {
    var $modalDiv = $(e.delegateTarget);
    $modalDiv.addClass('loading');
    setTimeout(function(){
        $('#form_asignacion_eliminar').submit();
    }, 2000);
});

$('#confirm-delete35').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_asignacion_eliminar",  this).attr('action', data.action);
    $('#modal_registo_asignacion_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
 /*  $(document).ready(function() {
       var table_asignacion = $('#table_asignacion').dataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
            },
        });
    });*/

</script>
