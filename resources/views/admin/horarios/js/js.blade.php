{{--datepicker--}}
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {
   var table_horarios = $('#table_horarios').DataTable({
        lengthChange: false,
        responsive: true,
        language: {
            url: "{{ asset('js/Spanish.json') }}",
          },
    });
});
$(function () {
       $('#fecha_lunes1').datetimepicker({
       	format: 'LT',
       });
       $('#fecha_lunes2').datetimepicker({
		   useCurrent: false, //Important! See issue #1075
		   format: 'LT',
		   });
       $("#fecha_lunes1").on("dp.change", function (e) {
           $('#fecha_lunes2').data("DateTimePicker").minDate(e.date);
       });
       $("#fecha_lunes2").on("dp.change", function (e) {
           $('#fecha_lunes1').data("DateTimePicker").maxDate(e.date);
       });
   });
$('#confirm-delete32').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_horario_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete32').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $("#form_horario_eliminar",  this).attr('action', data.action);
    $('#modal_registo_horario_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>