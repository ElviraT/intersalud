{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

{{--fileinput--}}
<script src="{{ asset('js/piexif.min.js')}}"></script>
<script src="{{ asset('js/sortable.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/fileinput.min.js')}}"></script>
<script src="{{ asset('js/LANG.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_paises = $('#table_usuarioM').DataTable({
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
          @if(isset($medico) && $medico->Foto_Medico != '' )
            defaultPreviewContent: '<img src="{{ asset("avatars/".str_replace('\\','/', $medico->Foto_Medico)) }}" alt="Foto Perfil" style="width:100%"><h6 class="text-muted">Clic para seleccionar</h6>',
          @else
            defaultPreviewContent: '<img src="{{ asset("img/avatar.png") }}" alt="Foto Perfil" style="width:100%"><h6 class="text-muted">Clic para seleccionar</h6>',
          @endif 
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
     loading_hide();
});

var xhr;
var xhr2;
var xhr3;
var select_state, $select_state;
var select_city, $select_city;
var select_municipality, $select_municipality;
var select_parish, $select_parish;

$select_state = $('#estado').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar ciudades*/
        select_city.disable();
        select_city.clearOptions();
        select_city.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('ciudad_dependiente') }}?estado='+value,
                success: function(results) {
                    select_city.enable();
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
        /*listar municipios*/
        select_municipality.disable();
        select_municipality.clearOptions();
        select_municipality.load(function(callback) {
            xhr2 && xhr2.abort();
            xhr2 = $.ajax({
                url: '{{ route('municipio_dependiente') }}?estado='+value,
                success: function(results) {
                    select_municipality.enable();
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

$select_city = $('#ciudad').selectize({
                    labelField: 'Ciudad',
                    valueField: 'id_Ciudad',
                    searchField: ['Ciudad'],
                    loadingClass: 'loading',
                });

$select_municipality = $('#municipio').selectize({
                    labelField: 'Municipio',
                    valueField: 'id_Municipio',
                    searchField: ['Municipio'],
                    loadingClass: 'loading',
                    preload: true,

                    onChange: function(value) {
                    if (!value.length) return;
                    /*listar parroquias*/
                    select_parish.disable();
                    select_parish.clearOptions();
                    select_parish.load(function(callback) {
                        xhr3 && xhr3.abort();
                        xhr3 = $.ajax({
                            url: '{{ route('parroquia_dependiente') }}?municipio='+value,
                            success: function(results) {
                                select_parish.enable();
                                callback(results);
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });
                }
     });

$select_parish = $('#parroquia').selectize({
                    labelField: 'Parroquia',
                    valueField: 'id_Parroquia',
                    searchField: ['Parroquia'],
                    loadingClass: 'loading',
                });

                select_city  = $select_city[0].selectize;
                select_parish  = $select_parish[0].selectize;
                select_municipality = $select_municipality[0].selectize;
                select_state = $select_state[0].selectize;

                select_city.disable();
                select_municipality.disable();
                select_parish.disable();
</script>
