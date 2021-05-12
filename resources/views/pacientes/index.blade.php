@extends("layouts.plantilla")

@section('contenido')

    <div class="row">
        <button type="button" class="btn btn-dark"
            onclick="location.href='{{ route('pacientes.create') }}'">Nuevo</button>

    </div>
    <hr />
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">N.Historia</th>
                            <th scope="col">NIF</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Teléfono 2</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Poblacion</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes as $paciente)
                            <tr>
                                <td>
                                    <a href="{{ route('pacientes.edit', $paciente->id) }}">{{ $paciente->apellidos }},
                                        {{ $paciente->nombre }}</a>
                                </td>
                                <td>{{ $paciente->NHC }}</td>
                                <td>{{ $paciente->NIF }}</td>
                                <td>{{ $paciente->telefono1 }}</td>
                                <td>{{ $paciente->telefono2 }}</td>
                                <td>{{ $paciente->email }}</td>
                                <td>{{ $paciente->poblacion }}</td>
                                <td>

                                    <form method="post" action="{{ route('pacientes.destroy', $paciente->id) }}"
                                        accept-charset="UTF-8">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pacientes->links() }}
        </div>



    </div>

@endsection
