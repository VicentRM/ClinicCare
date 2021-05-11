@extends ("layouts.plantilla")
@section ("contenido")
        <h1>Modificación paciente</h1>
        <form method="post" action="{{ route('pacientes.update', $paciente->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @method('PATCH')
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

            <div class="row">
                <div class="col-6">
                        <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="{{ $paciente->nombre }}">
                        </div>
                        <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" value="{{ $paciente->apellidos }}">
                        </div>
                        <div class="mb-3">
                                <label for="NIF" class="form-label">NIF</label>
                                <input type="text" class="form-control" id="NIF" name="NIF" placeholder="" value="{{ $paciente->NIF }}">
                        </div>          
                        <div class="mb-3">   
                                <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>    
                                <input type="date" class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento }}">
                        </div>
                        <div class="mb-3">   
                                <label for="fecha_alta" class="form-label">Fecha alta</label>    
                                <input type="date" class="form-control" type="date" id="fecha_alta" name="fecha_alta" value="{{ $paciente->fecha_alta }}">
                        </div>
                        <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" value="{{ $paciente->sexo }}">
                                <option>Femenino</option>
                                <option>Masculino</option>            
                        </select>            
                        </div>        
                        
                </div> 
                <div class="col-6">
                        <div class="mb-3">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="" value="{{ $paciente->direccion }}">
                        </div>  
                        <div class="mb-3">
                                <label for="CP" class="form-label">CP</label>
                                <input type="text" class="form-control" id="CP" name="CP" placeholder="" value="{{ $paciente->CP }}">
                        </div> 
                        <div class="mb-3">
                                <label for="CP" class="form-label">Poblacion</label>
                                <input type="text" class="form-control" id="CP" name="poblacion" placeholder="" value="{{ $paciente->poblacion }}">
                        </div> 
                        <div class="mb-3">
                                <label for="telefono1" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono1" name="telefono1" placeholder="" value="{{ $paciente->telefono1 }}">
                        </div> 
                        <div class="mb-3">
                                <label for="telefono2" class="form-label">Teléfono 2</label>
                                <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="" value="{{ $paciente->telefono2 }}">
                        </div> 
                        <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{ $paciente->email }}">
                        </div> 
                </div>
        </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            
          </form>

          @foreach($visitas as $visita)
          {{$visita->fecha}}
          @endforeach
       
@endsection