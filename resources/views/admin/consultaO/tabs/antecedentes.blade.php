{!! Form::open(['method' => 'post', 'autocomplete' =>'off', 'id'=>"formulario1"]) !!}
    <div class="form-group col-md-12">
    	
    	<input type="hidden" name="id_antecedente" id="id_antecedente" value="0">
        <input type="hidden" name="id_paciente" id="id_paciente" required>
        <input type="hidden" name="id_pacienteE" id="id_pacienteE" value="null">
        <input type="hidden" name="id_medico" id="id_medico" value="{{ auth()->user()->id_usuario }}">
        <div class="row">
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Personales'}}</label>
	           <textarea name="personales" id="personales" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Familiares'}}</label>
	           <textarea name="familiares" id="familiares" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Farmacológicos'}}</label>
	           <textarea name="farmacologicos" id="farmacologicos" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Examen Fisico'}}</label>
	           <textarea name="fisico" id="fisico" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Impresión Diagnostica'}}</label>
	           <textarea name="impresion" id="impresion" rows="3" class="form-control" required></textarea>
	        </div>
	        <div class="col-md-6 mb-3"> 
	           <label>{{'Fecha'}}</label>
	           <input type="date" name="fecha" id="fecha" value="{{date('Y-m-d')}}" class="form-control" readonly="true">
	        </div>
        </div>
    </div>
	<div class="modal-footer">
	    <button type="submit" class="mt-1 btn btn-outline-success" id="btnantecedente">
	        <span class="btn-icon-wrapper pr-2 opacity-7">
	         <i class="fa fa-floppy-o" aria-hidden="true"></i>
	        </span>{{'Guardar'}}
	    </button>
	</div>
{!! Form::close() !!}