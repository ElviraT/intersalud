<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function() {
       var table_reportesc = $('#table_reportesc').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });

       var table_factura = $('#table_factura').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },
        });

       var table_cservicios = $('#table_cservicios').DataTable({
            dom: 'Bfrtip',
              buttons: [
                {
                  extend: 'pdf',
                  title: 'Consulta de Servicios',
                  footer: true,
                  customize: function (doc) {
                    doc.defaultStyle.alignment = "center";
                    doc.content[1].table.widths = 
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');    
                  }
                }
              ],
            responsive: true,

            language: {
                url: "{{ asset('js/Spanish.json') }}",
              },

            "footerCallback": function ( row, data, start, end, display ) {
        
                total = this.api()
                    .column(3)//numero de columna a sumar
                    //.column(1, {page: 'current'})//para sumar solo la pagina actual
                    .data()
                    .reduce(function (a, b) {
                        return parseInt(a) + parseInt(b);
                    }, 0 );

                $(this.api().column(3).footer()).html(total.toFixed(2));
                
            }
        });
        
    });

$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    });  

$(function () {
    //Date picker
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        todayHighlight: true,
        language: 'es'
    });
});

function limpiar() {
  	$('#id_medico').val('').change();
  	$('#id_especialidad').val('').change();
  	$('#id_servicio').val('').change();
  	$('#cerrado').val('').change();
  	$('#fecha').val('');
  }  
</script>