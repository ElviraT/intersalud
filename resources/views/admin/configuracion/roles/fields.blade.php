<div class="row" style="padding: 30px;">
  <div class="form-group col-md-12">
    <div class="col-md-12 mb-3">
        <label for="validationCustom01">{{'Nombre'}}</label>
        {!! form::text('name', null ,['class' => 'form-control', 'required' => 'required', 'autofocus'=>'autofocus'])!!}
    </div>

        <div class="col-md-12">
            <h5>{{'Listado de Permisos'}}</h5>
            <div class="row  mt-2">
                @foreach($permisos as $permiso)
                    <div class="col-md-4">
                        <label>
                            {!! form::checkbox('permissions[]', $permiso->id, null,['class' => 'form-control checkbox', 'data-toggle'=>"toggle" ,'data-on'=>"Si", 'data-off'=>"No" ,'data-size'=>"xs"]) !!}
                            {{$permiso->description}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="{{ route('rol') }}" class="mt-1 btn btn-outline-secondary">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="fa fa-reply-all" aria-hidden="true"></i>
        </span>{{'Cancelar'}}
    </a>
    <button type="submit" class="mt-1 btn-transition btn btn-outline-primary">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="ti-save"></i>
        </span>{{'Guardar'}}
    </button>
</div>