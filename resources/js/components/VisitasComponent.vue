<template>
  <div>
    <h4>Visitas</h4>
    <!--<button type="button" class="btn btn-dark" onclick="location.href='/visitas/crearVisitaPaciente/{{ $paciente->id }}'">Nueva</button>-->
    <div class="toolbar">
      <div class="botonera">
        <button type="button" class="btn btn-success" @click="nuevavisita=!nuevavisita">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>

    <table class="table table-sm table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
          <th scope="col">Tipo Visita</th>
          <th scope="col">Motivo Visita</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="visita in visitas" :key="visita.id">          
          <td>{{ visita.calendario.inicio | formatFecha }}</td>
          <td>{{ visita.calendario.inicio | formatHora }}</td>
          <td>{{ visita.tipo_visita.descripcion }}</td>
          <td>{{ visita.motivo_visita.descripcion }}</td>
          <td >
            <button type="button" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil" aria-hidden="true" @click="abrirVisita(visita.id)"></i>
            </button>            
          </td>
        </tr>
      </tbody>
    </table>

    <agenda-component v-if="nuevavisita" :paciente_id_prop="paciente.id"></agenda-component>
  </div>
</template>

<script>
import moment from "moment";
import { bus } from "../app";
export default {
  name: "visitas-component",
  components: {},
  props: {
    // visitas: {required:true, type:Object},
    paciente: { required: true, type: Object },
  },
  data: () => ({
    nuevavisita: false,
    visitas: [],
  }),
  filters: {
    formatFecha: function (value) {
      if (!value) return "";
      let fecha = moment(value);
      fecha = fecha.format("DD-MM-YYYY");
      return fecha;
    },
    formatHora: function (value) {
      if (!value) return "";
      let hora = moment(value);
      hora = hora.format("HH:mm");
      return hora;
    },
  },
  created() {
    console.log("Paciente:" + this.paciente.id);
    this.obtenerVisitas();
    bus.$on("actualizarvisitas", this.obtenerVisitas); // 3.Listening
  },
  methods: {
    obtenerVisitas() {
      const promise = axios.get("/visitas/obtenervisitas/" + this.paciente.id);
      promise
        .then((response) => {
          console.log("Visitas paciente:", response.data.visitas);
          this.visitas = response.data.visitas;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
          window.location.href = "/errors/" + error.response.status;
        });
    },
    abrirVisita(idVisita) {
      //accede a partida con ID

      const promise = axios.get("/visitas/" + idVisita + "/edit");
      promise
        .then((response) => {
          console.log("Acceso a visita confirmado", response.statusText);
          let url =
            location.protocol +
            "//" +
            location.hostname +
            (location.port ? ":" + location.port : "");
          window.location.href = "/visitas/" + idVisita + "/edit";
        })
        .catch((error) => {
          console.log("ERROR: " + error);
          window.location.href = "/errors/" + error.response.status;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.toolbar {
  display: flex;
  //grid-template-columns: repeat(2,1fr);
}
.botonera {
  margin-left: auto;
}
