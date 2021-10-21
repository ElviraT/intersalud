<!-- DATATABLE -->
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('js/responsive.bootstrap.min.js')}}"></script>

<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table = $('#table_ciudades').DataTable({
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
        dropdownParent: $('#modal_ciudad'),
         });
    });
$('#modal_ciudad').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_ciudad_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#estado').val(obj.Estado_id);
            $('#estado').change();
            $('#nombre', modal).val(obj.Ciudad);
            if (obj.Capital == 1) {
                $('#capital').prop('checked', true).change();
            }else{
                $('#capital').prop('checked',false).change();
            }
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_ciudad').on('hidden.bs.modal', function (e) {
    $('#estado').val('').change();
    $('#nombre').val('');
    $('#capital').prop('checked',false).change();
});
$('#confirm-delete3').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_ciudad_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete3').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_ciudad_eliminar",  this).attr('action', data.action);
    $('#modal_registo_ciudad_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});

</script>
