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
      var total = 0;
      var impuesto = 0;

      $.getJSON('{{ route('calcular-pago') }}', function(obj){
        //console.log(moneda , simbolo, total, 'arriba');
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
      });
  }
</script>