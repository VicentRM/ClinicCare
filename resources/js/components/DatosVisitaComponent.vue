<template>
<div>
<!--
    
          <form method="post" name="datos" action="{{ route('datosvisita.update', $datosVisita->id) }}"
                        accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="anamnsesis" class="form-label">Anamnsesis</label>
                                    <textarea class="form-control" rows="4" name="anamnsesis"
                                        id="anamnsesis"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exploracion" class="form-label">Exploracion</label>
                                <textarea class="form-control" rows="4" name="exploracion"
                                    id="anamnsesis">}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 ">
                                <label for="peso" class="form-label">Peso</label>
                                <input type="number" class="form-control" id="peso" name="peso"
                                    value="{{ c_datosVisita.peso }}" onchange="calculoBMI()">
                            </div>
                            <div class="col-3">
                                <label for="altura" class="form-label">Altura</label>
                                <input type="number" class="form-control" id="altura" name="altura"
                                    value="{{ c_datosVisita.altura }}">
                            </div>
                            <div class="col-3">
                                <label for="exploracion" class="form-label">BMI</label>
                                <input type="number" class="form-control" id="BMI" name="BMI"
                                    value="{{ c_datosVisita.BMI }}">
                            </div>
                            <div class="col-3">
                                <label for="tension_arterial" class="form-label">Tension Arterial</label>
                                <input type="number" class="form-control" id="tension_arterial" name="tension_arterial"
                                    value="{{ c_datosVisita.tension_arterial }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="evolucion" class="form-label">Evolcion</label>
                            <textarea class="form-control" rows="6" name="anamnsesis"
                                id="anamnsesis"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tratamiento" class="form-label">Tratamiento</label>
                            <textarea class="form-control" rows="6" name="anamnsesis"
                                id="anamnsesis"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                    -->
    {{ c_datosVisita.exploracion }}
    </div>
</template>

<script>
import axios from "axios";
export default {
  name: "datosvisita-component",
  components: {},
  props: {},
  data: () => ({
    c_datosVisita: null,
  }),
  created() {},

  mounted() {
    this.datosVisita();
  },
  methods: {
    datosVisita() {
      console.log("hola");
      this.c_datosVisita = null;
      let url = "/datosvisitavue/1";
      const promise = axios.get(url);    
      promise
        .then(response => {
          console.log("Datos visita:", response.data);
          this.c_datosVisita = response.data;
        })
        .catch(error => {
          console.log("ERROR: " + error);
          window.location.href = "/errors/"+error.response.status;
        });
    }
  },
  computed: {}
};
</script>
