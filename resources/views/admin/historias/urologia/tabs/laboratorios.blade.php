{!! Form::open(['route' => ['urologia.add'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_identificacion' ]) !!}
	<div class="col-md-12">
	    <div class="row">
	        <div class="col-md-6 mb-3">
	            <label>{{ 'ECONOSOGRAMA ABDOMINO -PELVICO' }}</label>
	            <input type="text" class="form-control" name="ecoAP" id="ecoAP" placeholder="ECONOSOGRAMA ABDOMINO -PELVICO">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'ECOSONOGRAMA RENAL' }}</label>
	            <input type="text" class="form-control" name="ecoR" id="ecoR" placeholder="ECOSONOGRAMA RENAL">
	        </div>
	        <div class="col-md-6 mb-3">
	            <label>{{ 'ECOSONOGRAMA PELVICO' }}</label>
	            <input type="text" class="form-control" name="ecoP" id="ecoP" placeholder="ECOSONOGRAMA PELVICO">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'TRATAMIENTO' }}</label>
	            <input type="text" class="form-control" name="tratamiento" id="tratamiento" placeholder="TRATAMIENTO">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'LABORATORIOS' }}</label>
	            <input type="text" class="form-control" name="laboratorio" id="laboratorio" placeholder="LABORATORIOS">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'RADIOLOGÍA' }}</label>
	            <input type="text" class="form-control" name="radiologia" id="radiologia" placeholder="RADIOLOGÍA">
	        </div>  
	        <div class="col-md-6 mb-3">
	            <label>{{ 'UROGRAFIA DE ELIMINACION' }}</label>
	            <input type="text" class="form-control" name="urografia" id="urografia" placeholder="UROGRAFIA DE ELIMINACION">
	        </div>  
	        <div class="col-md-6 mb-3">
	            <label>{{ 'PIELOGRAFIA' }}</label>
	            <input type="text" class="form-control" name="pielografia" id="pielografia" placeholder="PIELOGRAFIA">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'TOMOGRAFIAS SIMPLE ( UROTAC )' }}</label>
	            <input type="text" class="form-control" name="tomografiaS" id="tomografiaS" placeholder="TOMOGRAFIAS SIMPLE ( UROTAC )">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'TOMOGRAFIAS CON MEDIOS DE CONTRASTES: ( PROTOCOLO LITIASICO)' }}</label>
	            <input type="text" class="form-control" name="tomografiaMC" id="tomografiaMC" placeholder="TOMOGRAFIAS CON MEDIOS DE CONTRASTES: ( PROTOCOLO LITIASICO)">
	        </div> 
	        <div class="col-md-6 mb-3">
	            <label>{{ 'URETROCISTOSCOPIA' }}</label>
	            <input type="text" class="form-control" name="uretrocistoscopia" id="uretrocistoscopia" placeholder="URETROCISTOSCOPIA">
	        </div>
	        <div class="col-md-6 mb-3">
	            <label>{{ 'ANATOMIA PATOLOGICA' }}</label>
	            <input type="text" class="form-control" name="anatomiaP" id="anatomiaP" placeholder="ANATOMIA PATOLOGICA">
	        </div>
	        <div class="col-md-6 mb-3">
	            <label>{{ 'DIAGNOSTICO CEI 10' }}</label>
	            <input type="text" class="form-control" name="diagnostico" id="diagnostico" placeholder="DIAGNOSTICO CEI 10">
	        </div>   
	        <div class="col-md-12 mb-3">
	        	<h4>{{'CITAS CONTROLES:'}}</h4>  
	        </div>  
	        <div class="col-md-12 mb-3">
	        	<div class="row">  	
		        	<div class="col-md-3 mb-3">
			            <label>{{ 'Fecha' }}</label>
			              <div class="input-group">
			                <div class="input-group-prepend">
			                    <span class="input-group-text">
			                    <i class="fa fa-calendar"></i>
			                    </span>
			                </div>
			                 {!!
			                     Form::text('fecha', null, [
			                         'id' => 'fecha',
			                         'placeholder'=>'Y-M-D',
			                         'class' => 'form-control pull-right datepicker'] )
			                  !!}
			             </div>
			        </div>
		        	<div class="col-md-3 mb-3">
			            <label>{{ 'Evolución' }}</label>
			            <input type="text" class="form-control" name="evolucion" id="evolucion" placeholder="Evolución">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label>{{ 'Tratamiento' }}</label>
			            <textarea name="tratamiento" class="form-control" rows="2"></textarea> 
			        </div>
			        <div class="col-md-3 mb-3 mt-1">
				        <a href="{{ route('urologia')}}" class="mt-4 btn btn-outline-primary">
			            <span class="btn-icon-wrapper pr-2 opacity-7">
			              <i class="fa fa-plus" aria-hidden="true"></i>
			            </span>{{'Agregar'}}
			        </a>
			        </div>  
		        </div> 
		        <div class="col-md-12 mt-3">
	                <table id="laboratorio" class="table table-striped table-bordered">
	                    <thead>
	                        <tr>
	                            <th>{{'Fecha'}}</th>
	                            <th>{{'Evolución'}}</th>
	                            <th>{{'Tratamiento'}}</th>
	                            <th>{{'Acción'}}</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <td>{{'03/10/2021'}}</td>
	                            <td>{{'......'}}</td>
	                            <td>{{'......'}}</td>
	                            <td>
	                            	<button class="btn btn-success btn-xs" type="button"><i class="fa fa-edit"></i></button>
						           
						           	<button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button>
	                            </td>
	                        </tr>
	                    </tbody>                   
	                </table>
                </div> 
	        </div>  

	    </div>  
	         <div class="modal-footer">
		        <a href="{{ route('urologia')}}" class="mt-1 btn btn-outline-secondary">
		            <span class="btn-icon-wrapper pr-2 opacity-7">
		             <i class="fa fa-reply-all" aria-hidden="true"></i>
		            </span>{{'Cancelar'}}
		        </a>
		        <button type="submit" class="mt-1 btn btn-outline-success">
		            <span class="btn-icon-wrapper pr-2 opacity-7">
		             <i class="fa fa-floppy-o" aria-hidden="true"></i>
		            </span>{{'Guardar'}}
		        </button>
		    </div> 
	</div>  
{!! Form::close() !!} 