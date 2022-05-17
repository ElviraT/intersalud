<div class="row" style="padding: 30px;">
    <div class="form-group">
        <div class="col-md-12">
            <div class="row">
                
                <input type="text" name="id" value="{{isset($limite) ? $limite->id : null}}">
                <div class="col-md-12 mb-3">
                    <label>{{'Administrativo'}}</label>
                    <input type="text" name="administrativo" class="form-control" id="administrativo" placeholder="Medico" value="{{isset($limite) ? $limite->administrativo : null}}" required onkeypress = 'return SoloNumeros(event)' autofocus="true">
                </div>
                <div class="col-md-12 mb-3">
                    <label>{{'Medico'}}</label>
                    <input type="text" name="medico" class="form-control" id="medico" placeholder="Medico" value="{{isset($limite) ? $limite->medico : null}}" required onkeypress = 'return SoloNumeros(event)'>
                </div>
                <div class="col-md-12 mb-3">
                    <label>{{'Asistente'}}</label>
                    <input type="text" name="asistente" class="form-control" id="asistente" placeholder="Asistente" value="{{isset($limite) ? $limite->asistente : null}}" required onkeypress = 'return SoloNumeros(event)'>
                </div>
                <div class="col-md-12 mb-3">
                    <label>{{'Paciente'}}</label>
                    <input type="text" name="paciente" class="form-control" id="paciente" placeholder="Paciente" value="{{isset($limite) ? $limite->paciente : null}}" required onkeypress = 'return SoloNumeros(event)'>
                </div>
                <div class="col-md-12 mb-3">
                    {!! Form::label('status', 'Status:') !!}
                    {!! Form::select('status',$status, isset($limite) ? $limite->status : null, [
                          'placeholder' => 'Seleccione', 
                          'class' => 'select2 form-control',
                          'id' => 'status',
                          'required'=>'required'
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="{{ route('limites.index') }}" class="mt-1 btn btn-outline-secondary">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="fa fa-reply-all" aria-hidden="true"></i>
        </span>{{'Volver'}}
    </a>
    <button type="submit" class="mt-1 btn-transition btn btn-outline-primary">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="ti-save"></i>
        </span>{{'Guardar'}}
    </button>
</div>