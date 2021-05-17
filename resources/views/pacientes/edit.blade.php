@extends ("layouts.plantilla")
@section('contenido')
<div class="row">
    <div class="col-xl-6 col-md-12">
        <paciente-component 
        :paciente="{{ json_encode($paciente) }}" :nuevopaciente="false" >  </paciente-component>
    </div>  
    <div class="col-xl-6 col-md-12">
        <visitas-component
        :visitas="{{ json_encode($visitas) }}">
        </visitas-component>
    </div>
</div>

@endsection


