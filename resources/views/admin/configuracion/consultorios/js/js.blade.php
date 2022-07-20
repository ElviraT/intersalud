<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script>
   $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
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
                    loadingClass: 'loading'
                });

                select_city  = $select_city[0].selectize;
                select_parish  = $select_parish[0].selectize;
                select_municipality = $select_municipality[0].selectize;
                select_state = $select_state[0].selectize;

                select_city.disable();
                select_municipality.disable();
                select_parish.disable();


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
            var $especialidad = $('#especialidad').selectize();
            $especialidad[0].selectize.setValue(obj.Especialidad_Medica_id);
            var $status = $('#status').selectize();
            $status[0].selectize.setValue(obj.Status_id);
            $select_state[0].selectize.setValue(obj.Estado_id, true);
            $('#direccion', modal).val(obj.Direccion);
            $('#local', modal).val(obj.Local);
            $('#telefono', modal).val(obj.Telefono);
            $('#celular', modal).val(obj.Celular);
            $('#correo', modal).val(obj.Correo);
            $select_municipality[0].selectize.setValue(obj.Municipio_id, true);
            $select_city[0].selectize.setValue(obj.Ciudad_id);
            $select_parish[0].selectize.setValue(obj.Parroquia_id);

            modal.removeClass('loading');
            loading_hide();
        });
    }
});

$('#modal_consultorio').on('hidden.bs.modal', function (e) {
    $('#direccion').val('');
    $('#local').val('');
    $('#telefono').val('');
    $('#celular').val('');
    $('#correo').val('');
    $('#especialidad')[0].selectize.clear();
    $('#status')[0].selectize.clear();
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
