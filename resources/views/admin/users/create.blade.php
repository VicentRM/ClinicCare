@extends ("layouts.plantilla")
@section ("contenido")
        <h1>Página para agregar usuarios</h1>
        <form method="post" action="/admin/users" accept-charset="UTF-8" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email">              
            </div>
            <div class="mb-3">
                <label for="emailVerificar" class="form-label">Verificar email</label>
                <input type="email" class="form-control" id="emailVerificar" name="email_verified_at">              
            </div>   
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <input type="text" class="form-control" id="role_id" name="role_id">              
            </div>  
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto_id"> 
            </div>      
            <button type="submit" class="btn btn-primary">Crear usuario</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
          </form>
@endsection