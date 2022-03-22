<div class="row">
  <div class="col-md-12">
      <nav class="nav-justified ">
        <div class="nav nav-tabs " id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">{{'Antecedentes'}}</a>         
          <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false" hidden>{{'Anamenesis'}}</a>
          <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false" hidden>{{'Especialidad'}}</a>
          <a class="nav-item nav-link" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop4" aria-selected="false" hidden>{{'Historial'}}</a>           
        </div>
      </nav>

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
              <div class="pt-3"></div>
              @include('admin.consultaO.tabs.antecedentes')
        </div>
        <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
              <div class="pt-3"></div>
              @include('admin.consultaO.tabs.anamenesis')
        </div>
        <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
              <div class="pt-3"></div>
              @include('admin.consultaO.tabs.especialidad')
        </div> 
        <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop4-tab">
              <div class="pt-3"></div>
              @include('admin.consultaO.tabs.historial')
        </div>      
      </div>
  </div>
</div>    