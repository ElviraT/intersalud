
<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#example').DataTable( {
	        lengthChange: false,
	        buttons: ['excel', 'pdf', 'colvis' ],
	        language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }

	    } );
	 
	    table.buttons().container()
	        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
	} );

	$(document).ready(function() {
        $('.select2').select2({ 
            theme : "classic" });
      });
	$(function () {
        var dtn = new Date();
        dtn.setFullYear(new Date().getFullYear()-18);
        //Date picker
        $('#fechNac').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            viewMode: "years",
            endDate : dtn,
            todayHighlight: true,
            language: 'es'
        });
    });

    $(function () {
        var dtn = new Date();
        //Date picker
        $('#fur').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            viewMode: "years",
            endDate : dtn,
            todayHighlight: true,
            language: 'es'
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

$('input[name="genero"]').change(function(e) {
	var x = document.getElementById("div_masculino");
	var y = document.getElementById("div_femenino");
	if(document.getElementById('masculino').checked) {
	     x.style.display = "block";
	     y.style.display = "none";
	}else if(document.getElementById('femenino').checked) {
	    x.style.display = "none";
	    y.style.display = "block";
	}
});

$(function() {
    $('#confirmar').change(function() {      
      	var s = $(this).prop('checked');
		if(s == true) {
		   document.getElementById('div_nota1').style.display = 'block';
		}else{
		   document.getElementById('div_nota1').style.display = 'none';
		}
    });

    $('#confirmar2').change(function() {      
      	var b = $(this).prop('checked');
		if(b == true) {
		   document.getElementById('div_nota2').style.display = 'block';
		}else{
		   document.getElementById('div_nota2').style.display = 'none';
		}
    });

    $('#confirmar3').change(function() {      
      	var c = $(this).prop('checked');
		if(c == true) {
		   document.getElementById('div_nota3').style.display = 'block';
		}else{
		   document.getElementById('div_nota3').style.display = 'none';
		}
    });

    $('#confirmar4').change(function() {      
      	var d = $(this).prop('checked');
		if(d == true) {
		   document.getElementById('div_nota4').style.display = 'block';
		}else{
		   document.getElementById('div_nota4').style.display = 'none';
		}
    });

    $('#confirmar5').change(function() {      
      	var e = $(this).prop('checked');
		if(e == true) {
		   document.getElementById('div_nota5').style.display = 'block';
		}else{
		   document.getElementById('div_nota5').style.display = 'none';
		}
    });

    $('#confirmar6').change(function() {      
      	var f = $(this).prop('checked');
		if(f == true) {
		   document.getElementById('div_nota6').style.display = 'block';
		}else{
		   document.getElementById('div_nota6').style.display = 'none';
		}
    });

    $('#confirmar7').change(function() {      
      	var g = $(this).prop('checked');
		if(g == true) {
		   document.getElementById('div_nota7').style.display = 'block';
		}else{
		   document.getElementById('div_nota7').style.display = 'none';
		}
    });

    $('#confirmar8').change(function() {      
      	var h = $(this).prop('checked');
		if(h == true) {
		   document.getElementById('div_nota8').style.display = 'block';
		}else{
		   document.getElementById('div_nota8').style.display = 'none';
		}
    });

    $('#confirmar9').change(function() {      
      	var i = $(this).prop('checked');
		if(i == true) {
		   document.getElementById('div_nota9').style.display = 'block';
		}else{
		   document.getElementById('div_nota9').style.display = 'none';
		}
    });

    $('#confirmar10').change(function() {      
      	var j = $(this).prop('checked');
		if(j == true) {
		   document.getElementById('div_nota10').style.display = 'block';
		}else{
		   document.getElementById('div_nota10').style.display = 'none';
		}
    });

    $('#confirmar11').change(function() {      
      	var k = $(this).prop('checked');
		if(k == true) {
		   document.getElementById('div_nota11').style.display = 'block';
		}else{
		   document.getElementById('div_nota11').style.display = 'none';
		}
    });

    $('#confirmar12').change(function() {      
      	var l = $(this).prop('checked');
		if(l == true) {
		   document.getElementById('div_nota12').style.display = 'block';
		}else{
		   document.getElementById('div_nota12').style.display = 'none';
		}
    });
  });

$(function() {
    $('#mconfirmar').change(function() {      
      	var ms = $(this).prop('checked');
		if(ms == true) {
		   document.getElementById('div_mnota1').style.display = 'block';
		}else{
		   document.getElementById('div_mnota1').style.display = 'none';
		}
    });

    $('#mconfirmar4').change(function() {      
      	var md = $(this).prop('checked');
		if(md == true) {
		   document.getElementById('div_mnota4').style.display = 'block';
		}else{
		   document.getElementById('div_mnota4').style.display = 'none';
		}
    });

    $('#mconfirmar5').change(function() {      
      	var me = $(this).prop('checked');
		if(me == true) {
		   document.getElementById('div_mnota5').style.display = 'block';
		}else{
		   document.getElementById('div_mnota5').style.display = 'none';
		}
    });

    $('#mconfirmar6').change(function() {      
      	var mf = $(this).prop('checked');
		if(mf == true) {
		   document.getElementById('div_mnota6').style.display = 'block';
		}else{
		   document.getElementById('div_mnota6').style.display = 'none';
		}
    });

    $('#mconfirmar7').change(function() {      
      	var mg = $(this).prop('checked');
		if(mg == true) {
		   document.getElementById('div_mnota7').style.display = 'block';
		}else{
		   document.getElementById('div_mnota7').style.display = 'none';
		}
    });

    $('#mconfirmar8').change(function() {      
      	var mh = $(this).prop('checked');
		if(mh == true) {
		   document.getElementById('div_mnota8').style.display = 'block';
		}else{
		   document.getElementById('div_mnota8').style.display = 'none';
		}
    });

    $('#mconfirmar9').change(function() {      
      	var mi = $(this).prop('checked');
		if(mi == true) {
		   document.getElementById('div_mnota9').style.display = 'block';
		}else{
		   document.getElementById('div_mnota9').style.display = 'none';
		}
    });

    $('#mconfirmar10').change(function() {      
      	var mj = $(this).prop('checked');
		if(mj == true) {
		   document.getElementById('div_mnota10').style.display = 'block';
		}else{
		   document.getElementById('div_mnota10').style.display = 'none';
		}
    });

    $('#mconfirmar11').change(function() {      
      	var mk = $(this).prop('checked');
		if(mk == true) {
		   document.getElementById('div_mnota11').style.display = 'block';
		}else{
		   document.getElementById('div_mnota11').style.display = 'none';
		}
    });

    $('#mconfirmar12').change(function() {      
      	var ml = $(this).prop('checked');
		if(ml == true) {
		   document.getElementById('div_mnota12').style.display = 'block';
		}else{
		   document.getElementById('div_mnota12').style.display = 'none';
		}
    });
  })

/*CODIGOS CANVAS*/

$("#canvasC").click(function(e){
     getPosition(e); 
});

var pointSize = 8;

function getPosition(event){
     var rect = canvasC.getBoundingClientRect();
     var x = event.clientX - rect.left;
     var y = event.clientY - rect.top;     
   
     drawCoordinates(x,y);
}

function drawCoordinates(x,y){  
    var ctx = document.getElementById("canvasC").getContext("2d");
    placeDiv(x,y);

    ctx.fillStyle = "#ff2626"; // Red color
    $('#x').val(x);
    $('#y').val(y);
    ctx.beginPath();
    ctx.arc(x, y, pointSize, 0, Math.PI * 2, true);
    ctx.fill();
}
function placeDiv(x, y) {
 var d = document.getElementById('CDetalle');
 d.style.display = 'block'
 d.style.position = "absolute"; 
 d.style.left = x+'px'; 
 d.style.top = y+'px'; 
 xx=  Math.trunc(x);
 yy=  Math.trunc(y);
}


// tab
$('#nav-tab a:first').tab('show');

//for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//save the latest tab; use cookies if you like 'em better:
localStorage.setItem('selectedTab', $(e.target).attr('id'));
});

//go to the latest tab, if it exists:
var selectedTab = localStorage.getItem('selectedTab');
if (selectedTab) {
  $('#'+selectedTab).tab('show');
}
</script>