{!! Form::open(['method' => 'post', 'autocomplete' =>'off', 'id'=>"formulario2"]) !!}
    <div class="form-group col-md-12">
    	<input type="hidden" name="id_antecedente" id="id_anamenesis" value="0">
        <input type="hidden" name="id_paciente" id="id_pacienteA" required>
        <input type="hidden" name="id_pacienteE" id="id_pacienteEA" value="0">
        <input type="hidden" name="id_medico" id="id_medico" value="{{ auth()->user()->id_usuario }}">
        <input type="hidden" name="control" id="control" value="null">
        <div class="row">
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Enfermedad Actual'}}</label>
	           <textarea name="Eactual" id="Eactual" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Origen'}}</label>
	           <textarea name="origen" id="origen" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Hallazgo'}}</label>
	           <textarea name="hallazgo" id="hallazgo" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Tratamiento'}}</label>
	           <textarea name="tratamiento" id="tratamiento" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Diagnóstico'}}</label>
	           <textarea name="diagnostico" id="diagnostico" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Pronostico'}}</label>
	           <textarea name="pronostico" id="pronostico" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Peso'}}</label>
	           <input type="number" step="0.01" name="peso" id="peso" class="form-control" required>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Estatura'}}</label>
	           <input type="number" step="0.01" name="estatura" id="estatura" class="form-control" required>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Fecha'}}</label>
	           <input type="date" name="fecha" id="fecha" value="{{date('Y-m-d')}}" class="form-control" readonly="true">
	        </div>
        </div>
    </div>
<div class="modal-footer">
    <button type="submit" class="mt-1 btn btn-outline-success" id="btnsnsmrnrdid">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="fa fa-floppy-o" aria-hidden="true"></i>
        </span>{{'Guardar'}}
    </button>
    {!! Form::close() !!}
</div>