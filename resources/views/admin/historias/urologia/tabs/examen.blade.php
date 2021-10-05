	{!! Form::open(['route' => ['urologia.add'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_identificacion' ]) !!}
	<div class="col-md-12">
	    <div class="row">
	        <div class="col-md-3 mb-3">
	            <label>{{ 'Peso' }}</label>
	            <input type="text" class="form-control" name="peso" id="peso" placeholder="Peso">
	        </div> 
	        <div class="col-md-3 mb-3">
	            <label>{{ 'Talla' }}</label>
	            <input type="text" class="form-control" name="talla" id="talla" placeholder="Talla">
	        </div> 
	        <div class="col-md-3 mb-3">
	            <label>{{ 'TA' }}</label>
	            <input type="text" class="form-control" name="ta" id="ta" placeholder="TA">
	        </div> 
	        <div class="col-md-3 mb-3">
	            <label>{{ 'IMC' }}</label>
	            <input type="text" class="form-control" name="imc" id="imc" placeholder="IMC">
	        </div>  
	    </div> 
		<div class="form-row mt-4">
			<div class="col-md-12 col-lg-6">
				<div class="row">
		            <div class="col-md-12">
		            	<canvas id="canvasC" width="500" height="420" style="cursor:crosshair;background:url({{ asset('assets/images/partes1.png') }}) no-repeat "></canvas>

		            	<input type="hidden" name="x" id="x">		
		            	<input type="hidden" name="y" id="y">	
		            	<input type="hidden" name="xg" id="xg" value="{{ isset($xg) ? $xg : 0 }}">	
		            	<input type="hidden" name="yg" id="yg" value="{{ isset($yg) ? $yg : 0 }}">	
		            	<div id="CDetalle" class="col-md-4 mt-2" style="display: none">
				            {!! Form::select('idDetalle', $detalle, null,['id'=>"idDetalle",'class'=>'select2 form-control','placeholder'=>'Seleccione']) !!}
				           <div class="card col-md-12" align="center">
					           <div class="row">
						           <div class="col-md-3">
						           	<button class="btn btn-success btn-xs" type="button"><i class="fa fa-check" onclick="guardar_coor()"></i></button>
						           </div> 
						           <div class="col-md-3"> 
						           	<button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o" onclick="eliminar_coor()"></i></button>
						           </div> 
					           </div> 
				           </div> 
				        </div>

					</div>
				</div>
			</div>  
			<div class="col-md-12 col-lg-6 p-2" style="border: 1px solid grey;">
				<div class="row">
					<div class="col-md-6 mb-3">
			            <label>{{ 'PROLAPSO ANTERIOR' }}</label>
			            <input type="text" class="form-control" name="prolapsoA" id="prolapsoA" placeholder="PROLAPSO ANTERIOR">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'PROLAPSO POSTERIOR' }}</label>
			            <input type="text" class="form-control" name="prolapsoP" id="prolapsoP" placeholder="PROLAPSO POSTERIOR">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'URETRA ANTERIOR' }}</label>
			            <input type="text" class="form-control" name="uretraA" id="prolapsoA" placeholder="URETRA ANTERIOR">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'URETRA POSTERIOR' }}</label>
			            <input type="text" class="form-control" name="uretraP" id="prolapsoP" placeholder="URETRA POSTERIOR">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'URETERES' }}</label>
			            <input type="text" class="form-control" name="ureteres" id="ureteres" placeholder="URETERES">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'CUELLO VESICAL' }}</label>
			            <input type="text" class="form-control" name="cuelloV" id="cuelloV" placeholder="CUELLO VESICAL">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'LESIONES' }}</label>
			            <input type="text" class="form-control" name="lesiones" id="lesiones" placeholder="LESIONES">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'CITOLOGÍAS' }}</label>
			            <input type="text" class="form-control" name="citologia" id="citologia" placeholder="CITOLOGÍAS">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'RIÑONES' }}</label>
			            <input type="text" class="form-control" name="riñones" id="riñones" placeholder="RIÑONES">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label>{{ 'URETERES' }}</label>
			            <input type="text" class="form-control" name="ureteres" id="ureteres" placeholder="URETERES">
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
	</div>  
    {!! Form::close() !!} 