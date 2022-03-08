{!! Form::open(['route' => ['consultao.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
    <div class="form-group col-md-12">
        <div class="row">
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Enfermedad Actual'}}</label>
	           <textarea name="Eactual" id="Eactual" rows="3" class="form-control"></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Origen'}}</label>
	           <textarea name="origen" id="origen" rows="3" class="form-control"></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Hallazgo'}}</label>
	           <textarea name="hallazgo" id="hallazgo" rows="3" class="form-control"></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Tratamiento'}}</label>
	           <textarea name="tratamiento" id="tratamiento" rows="3" class="form-control"></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Diagnóstico'}}</label>
	           <textarea name="diagnostico" id="diagnostico" rows="3" class="form-control"></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Pronostico'}}</label>
	           <textarea name="pronostico" id="pronostico" rows="3" class="form-control"></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Peso'}}</label>
	           <input type="text" name="peso" id="peso" class="form-control">
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Estatura'}}</label>
	           <input type="text" name="estatura" id="estatura" class="form-control">
	        </div>
        </div>
    </div>
<div class="modal-footer">
    <button type="submit" class="mt-1 btn btn-outline-success" id="btnantecedente" disabled="true">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="fa fa-floppy-o" aria-hidden="true"></i>
        </span>{{'Guardar'}}
    </button>
    {!! Form::close() !!}
</div>