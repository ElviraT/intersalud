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
      var simbolo = $('#simbolo').val();
      var moneda= $('#moneda').val();

      $.getJSON('{{ route('calcular-pago') }}', function(obj){
        console.log(obj);
            $('#div_total').attr('hidden', false);

        switch (moneda){
          case "Bs":
            
            break;
          case "USD":
            
            break;
          case "Btc":
            
            break;
          case "Eth":
            
            break;
        }
      });
  }
</script>