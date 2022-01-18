<!-- Fullcalendar -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/es.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    
$(function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale:'es',
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      initialDate: '2020-01-01',
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
    });
    calendar.render();
});

</script>