@extends ("layouts.plantilla")
@section('contenido')
<div class="row">
    <div class="col-xl-6 col-md-12">
        <paciente-component 
        :paciente="{{ json_encode($paciente) }}" :update=1>  </paciente-component>
        <documentos-component :idvinculo="{{ json_encode($paciente->id) }}" :vinculo_doc="'paciente_id'"></documentos-component>
    </div>  
    <div class="col-xl-6 col-md-12">
        <visitas-component       
         :paciente="{{ json_encode($paciente) }}">
        </visitas-component>
    </div>
</div>

@endsection


