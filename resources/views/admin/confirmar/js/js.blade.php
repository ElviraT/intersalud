<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>


<script type="text/javascript">
    $(function() {
        $('.pickerSelectClass').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
            });
    });
  $(document).ready(function() {
    //Date picker
    var dtn = new Date();
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        todayHighlight: true,
        language: 'es',
        endDate : dtn
    });
   
  });
  $("#confirmarAdd").submit(function(event) {
    event.preventDefault();

    var datos = jQuery(this).serialize();
    jQuery.ajax({
        type: "POST",
        url: "{{ route('confirmar_pago.add') }}",
        data: datos,
        success: function(resp)
        {
            Swal.fire(resp[0]);
            var id_factura= resp[1];
            var url_pdf = "{{ route('factura.pdf', ':id') }}";
            url_pdf = url_pdf.replace(':id', id_factura);
            window.location.href = url_pdf;
        }
    });
});
</script>