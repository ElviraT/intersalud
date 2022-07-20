{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
<!--Toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
       var table_usuariosPE = $('#table_usuariosPE').DataTable({
            lengthChange: false,
            responsive: true,
            language: {
                url: "{{ asset('js/Spanish.json') }}",
            },
        });
    });

$(function() {
    $('.pickerSelectClass').selectize({
        preload: true,
        loadingClass: 'loading',
        closeAfterSelect: true
        });
});
    
    $(function () {
        $('#fechNacPE').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            viewMode: "years",
            todayHighlight: true,
            language: 'es'
        });

    });

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

$('#confirm-delete28').on('click', '.btn-ok', function(e) {
        var $modalDiv = $(e.delegateTarget);
        $modalDiv.addClass('loading');
        setTimeout(function(){
            $('#form_usuariosPE_eliminar').submit();
        }, 2000);
    });
$('#confirm-delete28').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $("#form_usuariosPE_eliminar",  this).attr('action', data.action);
    $('#modal_registo_usuariosPE_id', this).val(data.recordId);
    $('.title', this).text(data.recordTitle);
    $('.btn-ok', this).data('recordId', data.recordId);
    loading_hide();
});
</script>
