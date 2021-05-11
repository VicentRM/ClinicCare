@extends ("layouts.plantilla")
@section ("contenido")
        <h1>Página para editar usuarios</h1>
        <form method="post"  action="{{ route('users.update', $user->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @method('PATCH')
            <div class="mb-3">
                <img src="/images/{{$user->foto ? $user->foto->ruta_foto : 'No-image-found.jpg' }}" width='100'>            
            </div> 
            <div class="mb-3">    
                <input type="file" name="foto_id">  
            </div>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">              
            </div>
            <div class="mb-3">
                <label for="emailVerificar" class="form-label">Verificar email</label>
                <input type="email" class="form-control" id="emailVerificar" name="email_verified_at">              
            </div>   
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <input type="text" class="form-control" id="role_id" name="role_id" value="{{ $user->role_id }}">              
            </div>  
        
            <button type="submit" class="btn btn-primary">Modificar usuario</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
          </form>
          <form method="post"  action="{{ route('users.destroy', $user->id) }}" accept-charset="UTF-8">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Eliminar usuario</button>
          </form>
@endsection