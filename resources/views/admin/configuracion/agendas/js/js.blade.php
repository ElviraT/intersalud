<!-- Fullcalendar -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/es.js') }}" type="text/javascript"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    });

$('#medico').on('change', function (e) {
   var medico = $('#medico').val();
    $.getJSON('{{ route('especialidad_dependiente') }}?medico='+medico, function(objC){
        var opcion = $('#especialidad').val();
        $('#especialidad').empty();
        $('#especialidad').prop('disabled', true);
        $('#especialidad').change();

        if(objC.length > 0){
            $.each(objC, function (i, especialidad) {
            $('#especialidad').append(
                    $('<option>', {
                        value: especialidad.id,
                        text : especialidad.name
                    })
                );
            });
            $('#especialidad').prop('disabled', false);
            $("#especialidad option:first").attr("selected", "selected");
        }        
    });
});

function horario() {
  var medico = $('#medico').val();
  var espec  = $('#especialidad').val();
  var array_dias = [];

   $.getJSON('{{ route('consultar_horario') }}?medico='+medico+'&espec='+espec, function(objch){     
if (objch['Lunes'] == 0) {
    array_dias.push(1);
}
if (objch['Martes'] == 0) {
    array_dias.push(2); 
}
if (objch['Miercoles'] == 0) {
    array_dias.push(3);  
}
if (objch['Jueves'] == 0) {
    array_dias.push(4);  
}
if (objch['Viernes'] == 0) {
    array_dias.push(5); 
}
if (objch['Sabado'] == 0) {
    array_dias.push(6);  
}
if (objch['Domingo'] == 0) {
    array_dias.push(0);
}
      $(function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
              locale:'es',
              headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
              },
              initialDate: new Date(),
              eventLimit: true,
              navLinks: true, // can click day/week names to navigate views
              fixedWeekCount:false,
              showNonCurrentDates:false,
              selectable: true,
              selectMirror: true,
              select: function(arg) {
                $('#modal_agenda').modal();
                calendar.unselect()
              },
              editable: true,
              hiddenDays: array_dias,
              views: {
                  timeGrid: {
                    eventLimit: 3 // adjust to 3 only for timeGridWeek/timeGridDay
                  }
                },
            });
            calendar.render();
        });


   });
}

</script>