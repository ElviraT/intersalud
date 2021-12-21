{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_tcambios = $('#table_tcambios').DataTable({
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
        dropdownParent: $('#modal_tcambio'),
         });
    });
$(function () {
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        todayHighlight: true,
        language: 'es'
    });

});
$('#modal_tcambio').on('show.bs.modal', function (e) {
    var modal = $(e.delegateTarget),
        data = $(e.relatedTarget).data();
        $('#bs').focus();
        loading_hide();
    if (data.recordId != undefined) {
        modal.addClass('loading');
        $('.modal_registro_tcambio_id', modal).val(data.recordId);
        $.getJSON(modal.data().consulta + '?id=' + data.recordId, function (data) {
            var obj = data[0];
            $('#bs', modal).val(obj.BS);
            $('#usd', modal).val(obj.USD);
            $('#btc', modal).val(obj.BitCoins);
            $('#eth', modal).val(obj.Ethereum);
            $('#fecha', modal).val(obj.Fecha);
            $('#status', modal).val(obj.Status_Tasa_id).change();
            modal.removeClass('loading');
            loading_hide();
        });
    }
});
$('#modal_tcambio').on('hidden.bs.modal', function (e) {
    $('#bs').val('');
    $('#usd').val('');
    $('#btc').val('');
    $('#eth').val('');
    $('#fecha').val('');
    $('#status').val(0).change();
});
$('#confirm-delete30').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_tcambio_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete30').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_tcambio_eliminar",  this).attr('action', data.action);
    $('#modal_registo_tcambio_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
