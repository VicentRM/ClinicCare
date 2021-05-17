@extends ("layouts.plantilla")
@section('contenido')

    <visita-component 
    :visita="{{ json_encode($visita) }}" 
    :tiposvisita="{{ json_encode($tiposvisita) }}" 
    :motivosvisita="{{ json_encode($motivosvisita) }}">
    </visita-component>


@endsection