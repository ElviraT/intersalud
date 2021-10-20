<!-- DATATABLE -->
    <script src= 'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js'></script>
    <script src= 'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js'></script>
   
    <script src= 'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js'></script>
    <script src= 'https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js'></script>
{{--datepicker--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

{{--fileinput--}}

<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
 
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 
<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
 
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/themes/fas/theme.min.js"></script -->
 
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_paises = $('#table_usuarioM').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    });

$(document).ready(function() {
  $('.select2').select2({ 
      theme : "classic" });
  });
    
    $(function () {
        var dtn = new Date();
        dtn.setFullYear(new Date().getFullYear()-18);
        //Date picker
        $('#fechNac').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            viewMode: "years",
            endDate : dtn,
            todayHighlight: true,
            language: 'es'
        });
    });
    $(function () {
        var dtn = new Date();
        //Date picker
        $('#fecha').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            viewMode: "years",
            endDate : dtn,
            todayHighlight: true,
            language: 'es'
        });
    });

     $("#avatar").fileinput({
        languaje: 'es',
        overwriteInitial: false,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class="ti-eraser"></i>',
        removeTitle: 'Cancelar o restablecer cambios',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
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

$('#confirm-delete6').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_usuariosM_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete6').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_usuariosM_eliminar",  this).attr('action', data.action);
    $('#modal_registo_usuariosM_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
});
</script>
