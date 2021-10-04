@section('css')
<style type="text/css">
  .nav-tabs .nav-link.active {
    font-weight:bold;
    background-color: transparent;
    border-bottom:3px solid #dd0000;
    border-right: none;
    border-left: none;
    border-top: none;
}

</style>
@endsection
<div class="row">
  <div class="col-md-12">
      <nav class="nav-justified ">
        <div class="nav nav-tabs " id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">{{'Datos De Identificación'}}</a>
          <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">{{'Antecedentes Personales'}}</a>
          <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">{{'Examen Físico'}}</a>  
          <a class="nav-item nav-link" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop4" aria-selected="false">{{'Ecos-Laboratorios'}}</a> 
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
              <div class="pt-3"></div>
              @include('admin.historias.urologia.tabs.identificacion')
        </div>
        <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
             <div class="pt-3"></div>
              @include('admin.historias.urologia.tabs.antecedentes')
            
        </div>
        <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
             <div class="pt-3"></div>
                       
        </div> 
        <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop4-tab">
             <div class="pt-3"></div>
                         
        </div>         
      </div>
  </div>
</div>       