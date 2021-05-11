
@extends ("layouts.plantilla")
@section ("contenido")

        <h1>Página principal del administrador</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Foto</th>
                <th scope="col">Role Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Creado</th>
                <th scope="col">Actualizado</th>
              </tr>
            </thead>
            @if($users)
                @foreach ($users as $user)                   
                    <tbody>
                    <tr>               
                        <th scope="row">{{$user->id}}</th>
                        <td><img src="/images/{{$user->foto ? $user->foto->ruta_foto : 'No-image-found.jpg' }}" width='100'></td>
                        <td>{{$user->role_id}}</td>
                        <td><a href="{{route('users.edit',$user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>             
                    </tbody>
                @endforeach
            @endif
          </table>
@endsection