<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
   $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
            });
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

var xhr;
var select_medico, $select_medico;
var select_paciente, $select_paciente;

$select_medico = $('#id_medico').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar pacientes*/
        select_paciente.disable();
        select_paciente.clearOptions();
        select_paciente.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('paciente_medico') }}?id_medico='+value,
                success: function(results) {
                    select_paciente.enable();
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

$select_paciente = $('#paciente').selectize({
                    labelField: 'nombre',
                    valueField: 'id',
                    searchField: ['nombre'],
                    loadingClass: 'loading',
                });

                select_paciente  = $select_paciente[0].selectize;
                select_medico = $select_medico[0].selectize;

                select_paciente.disable();

$select_moneda = $('#moneda').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
      var tpago= $('#tpago').val();
        if (!value.length) return;
        switch (value) {
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
        if (tpago == '5') {
          $('#billetera').attr('hidden', true);
          $('#usd').attr('hidden', true);
          $('#bs').attr('hidden', true);
        }
    }
});

$select_tpago = $('#tpago').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
    var pago = $("#tpago option:selected").text();
        if (!value.length) return;
        //alert(value);
        switch (pago) {
          case "Efectivo":
            $('#referencia').attr('hidden', true);
            break;
          default:
            $('#referencia').attr('hidden', false);
            break;
        }
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