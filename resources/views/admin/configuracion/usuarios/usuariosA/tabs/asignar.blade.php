<div class="form-group col-md-12">
    {!! Form::open(['route' => ['asignar.add'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'asigna_medico' ]) !!}

    <input type="hidden" name="id_Asistente" value="{{ isset($asistente) ? $asistente->id_asistente : null }}">

    <div class="row">
         <div class="col-md-4 mb-3">
            {!! Form::label('Medico', 'Medico:') !!}
            {!! Form::select('id_Medico',$medicos, null, [
                'placeholder' => 'Seleccione', 
                'class' => 'select2 form-control',
                'id' => 'id_Medico',
                'required'=>'required'
                ]) !!}
        </div>
    </div>
@if(count($asignacion) != 0)
    <div class="col-md-12 mt-3">
        <table id="table_asignacion" class="table table-striped table-bordered" width="100%">
            <thead>
                <tr>
                    <th>{{'Medico'}}</th>
                    <th>{{'Acción'}}</th>
                </tr>
            </thead>
            <tbody>
              @foreach($asignacion as $resultado)
                <tr>
                    <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos}}</td>                            
                    <td width="20">
                      @can('usuario_a.destroy')
                        <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete35" data-record-id="{{$resultado->id}}" data-record-title="{{$resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="ti-eraser"></i>
                                </span>{{'Eliminar'}}
                        </a>
                      @endcan
                    </td>
                </tr>
              @endforeach
            </tbody>                   
        </table>
    </div>
@endif
    <div class="modal-footer">
        <a href="{{ route('usuario_a')}}" class="mt-1 btn btn-outline-secondary">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-reply-all" aria-hidden="true"></i>
            </span>{{'Volver'}}
        </a>
        <button type="submit" class="mt-1 btn btn-outline-success" id="btnusuarioA">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </span>{{'Guardar'}}
        </button>
    </div> 
        {!! Form::close() !!}
</div>