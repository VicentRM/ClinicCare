@extends ("layouts.plantilla")
@section('contenido')
    <nav>
        <h2>Nueva visita para paciente {{ $paciente->apellidos }}, {{ $paciente->nombre }}</h2>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab"
                aria-controls="nav-general" aria-selected="true">General</a>
            <a class="nav-link" id="nav-datos-tab" data-toggle="tab" href="#nav-datos" role="tab" aria-controls="nav-datos"
                aria-selected="false">Datos Visita</a>
        </div>
    </nav>
    <form method="post" action="/visitas" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf        
        <input name="paciente_id" type="hidden" value="{{ $paciente->id  }}"/>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-geenral-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" type="date" id="fecha" name="fecha">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="hora" class="form-label">Hora</label>
                                    <input type="time" class="form-control" type="time" id="hora" name="hora">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tipoVisita" class="form-label">Tipo Visita</label>
                            <select class="form-control" id="tipo_visita_id" name="tipo_visita_id" value="">
                                @foreach ($tiposVisita as $tipo)
                                    <option id="{{ $tipo->id }}" value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="motivoVisita" class="form-label">Motivo Visita</label>
                            <select class="form-control" id="motivo_visita_id" name="motivo_visita_id" value="">
                                @foreach ($motivosVisita as $motivo)
                                    <option id="{{ $motivo->id }}" value="{{ $motivo->id }}">{{ $motivo->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comentarios" class="form-label">Comentarios</label>
                            <textarea class="form-control" rows="4" name="comentarios"
                                id="comentarios"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" rows="4" name="observaciones"
                                id="observaciones"></textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-datos" role="tabpanel" aria-labelledby="nav-datos-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="anamnsesis" class="form-label">Anamnsesis</label>
                                    <textarea class="form-control" rows="4" name="anamnesis"
                                        id="anamnsesis"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exploracion" class="form-label">Exploracion</label>
                                <textarea class="form-control" rows="4" name="exploracion"
                                    id="anamnsesis"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 ">
                                <label for="peso" class="form-label">Peso</label>
                                <input type="number" class="form-control" id="peso" name="peso"
                                    onchange="calculoBMI()">
                            </div>
                            <div class="col-3">
                                <label for="altura" class="form-label">Altura</label>
                                <input type="number" class="form-control" id="altura" name="altura"
                                    onchange="calculoBMI()">
                            </div>
                            <div class="col-3">
                                <label for="IMC" class="form-label">IMC</label>
                                <input type="number" class="form-control" id="IMC" name="IMC">
                            </div>
                            <div class="col-3">
                                <label for="tension_arterial" class="form-label">Tension Arterial</label>
                                <input type="number" class="form-control" id="tension_arterial" name="tension_arterial"
                                   >
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="evolucion" class="form-label">Evolcion</label>
                            <textarea class="form-control" rows="6" name="evolucion"
                                id="evolucion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tratamiento" class="form-label">Tratamiento</label>
                            <textarea class="form-control" rows="6" name="tratamiento"
                                id="tratamiento"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Guardar cambios</button>
    </form>




@endsection
<script>
    /*calculo de IMC*/
    function calculoBMI() {
        var peso = parseFloat(document.getElementById('peso').value);
        var altura = parseFloat(document.getElementById('altura').value);
        if ((peso === null || peso == '') || (altura === null || altura == '')) {
            document.getElementById('IMC').value = 0;
        } else {
            var imc = Math.round(peso / (altura * altura), 2);
            document.getElementById('IMC').value = imc;
        }


    }

</script>
