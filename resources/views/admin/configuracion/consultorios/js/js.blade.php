<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

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
$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
        dropdownParent: $('#modal_consultorio'),
         });
    });

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
$('#estado').on('select2:select', function (e) {
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
            $('#municipio').prop('disabled', false);
        }        
    });
    
});

$('#municipio').on('select2:select', function (e) {
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
