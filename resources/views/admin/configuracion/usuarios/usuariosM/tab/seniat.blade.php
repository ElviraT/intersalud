<div class="form-group col-md-12">
	{!! Form::open(['route' => ['usuario_m.seniat'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_usuarioM' ]) !!}
    <input type="hidden" name="id" value="{{ isset(Session::get('medico')->Nombres_Medico) ? Session::get('medico')->id_Medico : null }}">
    <input type="hidden" name="idS" value="{{ isset($seniat) ? $seniat->id_Datos_SENIAT : null }}">
    <div class="row">
      <div class="col-md-12 col-lg-6">
          <div class="row">
            <div class="col-md-12 mb-3">
                <label>{{ 'RIF' }}</label>
                <input type="text" class="form-control" name="rif" id="rif" placeholder="RIF" autofocus value="{{ isset($seniat) ? $seniat->RIF : null }}" maxlength="20">
            </div> 
            <div class="col-md-12 mb-3">
                <label>{{ 'Fecha' }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                     {!!
                         Form::text('fecha', isset($seniat) ? $seniat->Fecha : null, [
                             'id' => 'fecha',
                             'placeholder'=>'Y-M-D',
                             'class' => 'form-control pull-right datepicker'] )
                      !!}
                 </div>
            </div>
          </div>
      </div>
      <div class="col-md-12 col-lg-6">
        <div class="row">
          <div class="col-md-12 mb-3">
              <label>{{ 'Dirección' }}</label>
              <textarea class="form-control" rows="5" name="direccion" id="direccion" placeholder="Dirección" maxlength="200">{{ isset($seniat) ? $seniat->Direccion : null }}</textarea>
          </div> 
        </div>
      </div>
    </div>

    <div class="modal-footer">
        <a href="{{ route('usuario_m')}}" class="mt-1 btn btn-outline-secondary">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-reply-all" aria-hidden="true"></i>
            </span>{{'Volver'}}
        </a>
        <button type="submit" class="mt-1 btn btn-outline-success">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </span>{{'Guardar'}}
        </button>
    </div> 
        {!! Form::close() !!}
</div>