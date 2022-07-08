<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.js" type="text/javascript"></script>

<script>
   $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading'
            });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
       var table_consultorios = $('#table_consultorios').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });
    });
/*$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
        dropdownParent: $('#modal_consultorio'),
         });
    });*/

$('#modal_consultorio').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#nombre').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_consultorio_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#direccion', modal).val(obj.Direccion);
            $('#local', modal).val(obj.Local);
            $('#telefono', modal).val(obj.Telefono);
            $('#celular', modal).val(obj.Celular);
            $('#correo', modal).val(obj.Correo);
            $('#especialidad').val(obj.Especialidad_Medica_id);
            $('#especialidad').change();
            $('#estado').val(obj.Estado_id);
            $('#estado').change();
            $('#ciudad').val(obj.Ciudad_id);
            $('#ciudad').change();
            $('#municipio').val(obj.Municipio_id);
            $('#municipio').change();
            $('#parroquia').val(obj.Parroquia_id);
            $('#parroquia').change();
            $('#status').val(obj.Status_id);
            $('#status').change();
            modal.removeClass('loading');
            loading_hide();
        });
    }
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
                    valueField: 'id_Ciudad',
                    labelField: 'Ciudad',
                    searchField: ['Ciudad'],
                    preload: true,
                    loadingClass: 'loading',
                });

$select_municipality = $('#municipio').selectize({
                    valueField: 'id_Municipio',
                    labelField: 'Municipio',
                    searchField: ['Municipio'],
                    preload: true,
                    loadingClass: 'loading',

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
                    valueField: 'id_Parroquia',
                    labelField: 'Parroquia',
                    searchField: ['Parroquia'],
                    preload: true,
                    loadingClass: 'loading'
                });

                select_city  = $select_city[0].selectize;
                select_state = $select_state[0].selectize;
                select_municipality = $select_municipality[0].selectize;
                select_parish  = $select_parish[0].selectize;

                select_city.disable();
                select_municipality.disable();
                select_parish.disable();


$('#modal_consultorio').on('hidden.bs.modal', function (e) {
    $('#direccion').val('');
    $('#local').val('');
    $('#telefono').val('');
    $('#celular').val('');
    $('#correo').val('');
    $('#especialidad').val('').change();
    $('#estado').val('').change();
    $('#ciudad').val('').change();
    $('#municipio').val('').change();
    $('#parroquia').val('').change();
    $('#status').val('').change();
});
$('#confirm-delete23').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_consultorio_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete23').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_consultorio_eliminar",  this).attr('action', data.action);
    $('#modal_registo_consultorio_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
