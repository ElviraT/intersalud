<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
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
$('#id_medico').on('select2:select', function (e) {
   var id_medico = $('#id_medico').val();
    $.getJSON('{{ route('paciente_medico') }}?id_medico='+id_medico, function(objP){
        var opcion = $('#paciente').val();
        $('#paciente').empty();
        $('#paciente').prop('disabled', true);
        $('#paciente').change();

        if(objP.length > 0){
            $.each(objP, function (i, paciente) {
            $('#paciente').append(
                    $('<option>', {
                        value: paciente.id,
                        text : paciente.nombre
                    })
                );
            });
            $('#paciente').prop('disabled', false);
            $('#paciente').change();

        }        
    });
  });

  $('#moneda').on('select2:select', function (e) {
    var moneda = $('#moneda').val();
    switch (moneda) {
      case "Bs":
        $('#bs').attr('hidden', false);
        $('#usd').attr('hidden', true);
        $('#billetera').attr('hidden', true);
        break;
      case "USD":
        $('#usd').attr('hidden', false);
        $('#bs').attr('hidden', true);
        $('#billetera').attr('hidden', true);
        break;
      default:
        $('#billetera').attr('hidden', false);
        $('#usd').attr('hidden', true);
        $('#bs').attr('hidden', true);
        break;
    }
    
  });
  $('#tpago').on('select2:select', function (e) {
    var tpago = $('#tpago').val();
        switch (tpago) {
          case "2":
            $('#referencia').attr('hidden', true);
            break;
          default:
            $('#referencia').attr('hidden', false);
            break;
        }
});
  function calcular() {
      var total_pagar = $('#total_pagar').val();
      var simbolo = $('#simbolo').val();//factura original
      var moneda= $('#moneda').val();//cancelar
      var tpago= $('#tpago').val();
      var status= $('#statusP').val();
      var statusf= $('#statusF').val();
      var cbs= $('#cbsf').val();
      var cusd= $('#cusd').val();
      var billerera= $('#billetera').val();
      var ref= $('#ref').val();
      var total = 0;
      var impuesto = 0;

      if(moneda.length != 0 && tpago.length != 0 && status != undefined && statusf != undefined)
      {
        $.getJSON('{{ route('calcular-pago') }}', function(obj){
          if(moneda == simbolo){
            total = total_pagar;
          }else{
            switch(moneda){
              case "Bs":
                    total = (obj.BS * total_pagar);
                break;
              case "USD":
                  total = (obj.BS / total_pagar);
                break;
             /* case "Btc":
                
                break;
              case "Eth":
                
                break;*/
            }


        }
  
      if (moneda == 'USD') {
        $('#imp').attr('hidden', false);
        impuesto= (total * 3 / 100);
        total= parseFloat(total)+parseFloat(impuesto);
        $('#impuesto').html(impuesto.toFixed(2));
      }else{
        $('#imp').attr('hidden', true);
        $('#impuesto').html(0);
      }

        //console.log(moneda , simbolo, total, 'abajo');
            $('#div_total').attr('hidden', false);
            $('#simb').html(moneda);
            $('#total').html(total.toFixed(2));

            /*enviar al formulario*/
            $('#tpagof').val(tpago);
            $('#monedaf').val(moneda);
            $('#statusPf').val(status);
            $('#statusFf').val(statusf);
            $('#cbsf').val(cbs);
            $('#cusdf').val(cusd);
            $('#billeteraf').val(billerera);
            $('#reff').val(ref);
            $('#totalf').val(total.toFixed(2));
            $('#impuestof').val(impuesto.toFixed(2));
            $('#guardar').css('pointer-events', 'auto');
            /*fin formulario*/
      });
    }else{
      Swal.fire('Debe llenar los campos');
    }
  }

  $("#facturaAdd").submit(function(event) {
    event.preventDefault();

    var datos = jQuery(this).serialize();
    jQuery.ajax({
        type: "POST",
        url: "{{ route('factura.add') }}",
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