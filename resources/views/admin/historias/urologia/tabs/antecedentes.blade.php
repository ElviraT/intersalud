<div class="form-group col-md-12">
	{!! Form::open(['route' => ['urologia.add'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_identificacion' ]) !!}

    <div class="row">
	    <div class="col-md-12">
		    <div class="col-md-12">
		    	<div class="form-check">
				  <input class="form-check-input pl-2" type="radio" name="genero" id="femenino">
				  <label class="form-check-label" for="femenino">
				    {{'Femenino'}}
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input pl-2" type="radio" name="genero" id="masculino">
				  <label class="form-check-label" for="masculino">
				    {{'Masculino'}}
				  </label>
				</div>
		    </div>
		    <div class="col-md-12 mt-1" id="div_masculino" style="display: none; border-top: double;">
		    	<div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'1.- ANTECEDENTES MICCIONALES:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota1" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota1" id="mnota1"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'2.- ANTECEDENTES DE CANCER :'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar4" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota4" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota4" id="mnota4"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'3.- PATOLOGIAS QUIRURGICAS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar5" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota5" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota5" id="mnota5"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'4.- HABITOS TABAQUICOS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar6" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota6" class="col-md-12" style="display: none;">
				    	<div class="row">
				    		<div class="col-md-2">
					    		<label>{{ 'Nº CAJA / DIA:' }}</label>
					    	</div>
					    	<div class="col-md-2">
			            		<input type="text" class="form-control" name="mnumero" id="mnumero"></input>
					    	</div>
					    	<div class="col-md-1">
					    		<label>{{ 'Años:' }}</label>
					    	</div>
					    	<div class="col-md-2">
			            		<input type="text" class="form-control" name="manio" id="manio"></input>
					    	</div>
					    	<div class="col-md-1">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-4">
			            		<textarea class="form-control" rows="1" name="mnota6" id="mnota6"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'5.- SUFRE DE ALGUNA ENFERMEDAD:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar7" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota7" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota7" id="mnota7"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'6.- SUFRE DE DISFUNCION ERECTIL:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar8" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota8" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota8" id="mnota8"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'7.- ANTECEDENTES LITIASICOS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar9" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota9" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota9" id="mnota9"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'8.- PATOLOGIAS NEUROLOGICAS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar10" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota10" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota10" id="mnota10"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'9.- ANTECEDENTES ALERGICOS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar11" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota11" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota11" id="mnota11"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'10.- TOMA MEDICAMENTO:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="mconfirmar12" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_mnota12" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="mnota12" id="mnota12"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

		    </div>
		    <div class="col-md-12 mt-1" id="div_femenino" style="display: none; border-top: double">
		    	<div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'1.- ANTECEDENTES MICCIONALES:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota1" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota1" id="nota1"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'2.- CONTROLES GINECOLOGICOS ANTERIORES:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar2" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota2" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota2" id="nota2"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'3.- SUFRE DE ALGUNA ENFERMEDAD:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar3" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota3" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota3" id="nota3"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'4.- ANTECEDENTES DE CANCER :'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar4" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota4" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota4" id="nota4"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'5.- PATOLOGIAS QUIRURGICAS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar5" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota5" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota5" id="nota5"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'6.- HABITOS TABAQUICOS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar6" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota6" class="col-md-12" style="display: none;">
				    	<div class="row">
				    		<div class="col-md-2">
					    		<label>{{ 'Nº CAJA / DIA:' }}</label>
					    	</div>
					    	<div class="col-md-2">
			            		<input type="text" class="form-control" name="numero" id="numero"></input>
					    	</div>
					    	<div class="col-md-1">
					    		<label>{{ 'Años:' }}</label>
					    	</div>
					    	<div class="col-md-2">
			            		<input type="text" class="form-control" name="anio" id="anio"></input>
					    	</div>
					    	<div class="col-md-1">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-4">
			            		<textarea class="form-control" rows="1" name="nota6" id="nota6"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-3">
			    		<label>{{'7.- F.U.R.:'}}</label>
			    	
		                {!! Form::text('fur', null, [
	                        'id' => 'fur',
	                        'placeholder'=>'Y-M-D',
	                        'class' => 'form-control datepicker'] )
		                !!}
			        </div>
	          		<div class="col-md-3">
			    		<label>{{ 'DURACIÓN:' }}</label>
			    	
	            		<input type="text" class="form-control" name="duracion" id="duracion"></input>
			    	</div>
			    	<div class="col-md-3">
			    		<label>{{ 'PERIODICIDAD:' }}</label>
			    	
	            		<input type="text" class="form-control" name="periodicidad" id="periodicidad"></input>
			    	</div>
			    	<div class="col-md-3">
			    		<label>{{ 'MENARQUIA' }}</label>
			    	
	            		<input type="text" class="form-control" name="menarquia" id="menarquia"></input>
			    	</div>				    	
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-4">
			    		<label>{{'8.- EDAD DE INICO DE ACTIVIDAD SEXUAL'}}</label>
			    	</div>
			    	<div class="col-md-2">
			    		<input type="text" id="edad" name="edad" class="form-control">
			    	</div>
		    		<div class="col-md-3">
			    		<label>{{ 'CANTIDAD DE PAREJAS:' }}</label>
			    	</div>
			    	<div class="col-md-3">
	            		<input type="text" class="form-control" name="cantidadp" id="cantidadp"></input>
			    	</div>			    	
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'9.- SINTOMAS DURANTE LA ACTIVIDAD SEXUAL:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar7" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota7" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota7" id="nota7"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-4">
			    		<label>{{'10.- EDAD DE MENOPAUSIA:'}}</label>		    	
		                <input type="text" class="form-control" name="emenopausia" id="emenopausia"></input>
			        </div>
	          		<div class="col-md-4">
			    		<label>{{ 'TRATAMIENTOS:' }}</label>			    	
	            		<input type="text" class="form-control" name="tratamiento" id="tratamiento"></input>
			    	</div>
			    	<div class="col-md-4">
			    		<label>{{ 'TIEMPO:' }}</label>			    	
	            		<input type="text" class="form-control" name="tiempo" id="tiempo"></input>
			    	</div>			    	
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-3">
			    		<label>{{'11.- Nº DE EMBARAZOS:'}}</label>			    	
		                <input type="text" class="form-control" name="nembrazo" id="nembrazo"></input>
			        </div>
	          		<div class="col-md-2">
			    		<label>{{ 'PARTO:' }}</label>			    	
	            		<input type="text" class="form-control" name="parto" id="parto"></input>
			    	</div>
			    	<div class="col-md-2">
			    		<label>{{ 'CESARIAS:' }}</label>			    	
	            		<input type="text" class="form-control" name="cesarias" id="cesarias"></input>
			    	</div>
			    	<div class="col-md-2">
			    		<label>{{ 'FORCEPS:' }}</label>			    	
	            		<input type="text" class="form-control" name="forceps" id="forceps"></input>
			    	</div>
			    	<div class="col-md-3">
			    		<label>{{ 'ABORTOS:' }}</label>			    	
	            		<input type="text" class="form-control" name="abortos" id="abortos"></input>
			    	</div>				    	
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'12.-TOMA MEDICAMENTO :'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar8" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota8" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota8" id="nota8"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'13.- APARATO INTRAUTERINO:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar9" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota9" class="col-md-6" style="display: none;">
				    	<div class="row">
				    		<div class="col-md-2">
				    			<label>{{'Tiempo'}}</label>
				    		</div>
				    		<div class="col-md-4">
				    			<input type="text" name="tiempo" class="form-control">
				    		</div>
					    	<div class="col-md-2">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-4">
			            		<textarea class="form-control" rows="1" name="nota9" id="nota9"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'14.- PATOLOGIAS NEUROLOGICAS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar10" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota10" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota10" id="nota10"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'15.- ANTECEDENTES LITIASICOS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar11" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota11" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota11" id="nota11"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

			    <div class="row mt-2">
			    	<div class="col-md-5">
			    		<label>{{'16.- ANTECEDENTES ALERGICOS:'}}</label>
			    	</div>
			    	<div class="col-md-1">
			    		<input type="checkbox" id="confirmar12" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
			    	</div>
			    	<div id="div_nota12" class="col-md-6" style="display: none;">
				    	<div class="row">
					    	<div class="col-md-3">
					    		<label>{{ 'Nota' }}</label>
					    	</div>
					    	<div class="col-md-9">
			            		<textarea class="form-control" rows="1" name="nota12" id="nota12"></textarea>
					    	</div>
				    	</div>
			    	</div>
			    </div>

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
        {!! Form::close() !!}
</div>