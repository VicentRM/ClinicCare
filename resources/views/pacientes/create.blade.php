@extends ("layouts.plantilla")
@section ("contenido")
        <h1>Alta paciente</h1>
        <form method="post" action="/pacientes" accept-charset="UTF-8" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="row">
                <div class="col-6">
                        <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="">
                        </div>
                        <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="">
                        </div>
                        <div class="mb-3">
                                <label for="NIF" class="form-label">NIF</label>
                                <input type="text" class="form-control" id="NIF" name="NIF" placeholder="">
                        </div>          
                        <div class="mb-3">   
                                <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>    
                                <input type="date" class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento">
                        </div>
                        <div class="mb-3">   
                                <label for="fecha_alta" class="form-label">Fecha alta</label>    
                                <input type="date" class="form-control" type="date" id="fecha_alta" name="fecha_alta">
                        </div>
                        <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                                <option>Femenino</option>
                                <option>Masculino</option>            
                        </select>            
                        </div>        
                        
                </div> 
                <div class="col-6">
                        <div class="mb-3">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="">
                        </div>  
                        <div class="mb-3">
                                <label for="CP" class="form-label">CP</label>
                                <input type="text" class="form-control" id="CP" name="CP" placeholder="">
                        </div> 
                        <div class="mb-3">
                                <label for="poblacion" class="form-label">Poblacion</label>
                                <input type="text" class="form-control" id="poblacion" name="poblacion" placeholder="">
                        </div> 
                        <div class="mb-3">
                                <label for="telefono1" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono1" name="telefono1" placeholder="">
                        </div> 
                        <div class="mb-3">
                                <label for="telefono2" class="form-label">Teléfono 2</label>
                                <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="">
                        </div> 
                        <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                        </div> 
                </div>
        </div>
            <button type="submit" class="btn btn-primary">Crear usuario</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
          </form>
@endsection