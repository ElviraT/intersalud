<div class="form-group col-md-12">
	{!! Form::open(['route' => ['usuario_m.seniat'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_usuarioM' ]) !!}
    <input type="hidden" name="id" value="{{ isset(Session::get('medico')->Nombres_Medico) ? Session::get('medico')->id_Medico : null }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>{{ 'RIF' }}</label>
            <input type="text" class="form-control" name="rif" id="rif" placeholder="RIF" autofocus>
        </div> 
        <div class="col-md-6 mb-3">
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
        <div class="col-md-12 mb-3">
            <label>{{ 'Dirección' }}</label>
            <textarea class="form-control" rows="5" name="direccion" id="direccion" placeholder="Dirección"></textarea>
        </div> 
    </div>

    <div class="modal-footer">
        <a href="{{ route('usuario_m')}}" class="mt-1 btn btn-outline-secondary">
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