<template>
  <div>
    <h4>Pacientes</h4>
    <div class="row">
      <div class="col-12">
        <div class="toolbar">
          <div class="buscador">
            <input
              type="text"
              class="form-control mb-3"
              placeholder="Filtra por nombre, apellido o NIF"
              v-model="filtro"
            />
          </div>
          <div class="botonera">
            <button type="button" class="btn btn-success" @click="nuevoPaciente()">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>

        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
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
              <tr v-for="paciente in buscarPaciente" :key="paciente.id">
                <td
                  @click="abrirPaciente(paciente.id)"
                >{{ paciente.apellidos }},{{ paciente.nombre }}</td>
                <td>{{ paciente.NHC }}</td>
                <td>{{ paciente.NIF }}</td>
                <td>{{ paciente.telefono1 }}</td>
                <td>{{ paciente.telefono2 }}</td>
                <td>{{ paciente.email }}</td>
                <td>{{ paciente.poblacion }}</td>
                <td>
                  <button type="button" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil" aria-hidden="true" @click="abrirPaciente(paciente.id)"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger btn-sm"
                    @click="borrarPaciente(paciente)"
                  >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <pagination :data="pacientes_pag" @pagination-change-page="obtenerPacientes"></pagination>
      </div>
    </div>
  </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
import axios from "axios";

export default {
  name: "pacientes-component",
  components: {
    pagination,
  },
  props: {},
  data: () => ({
    pacientes_pag: {},
    pacientes: [],
    filtro: "",
  }),
  created() {
    this.obtenerPacientes();
  },

  mounted() {},
  methods: {
    obtenerPacientes() {
      const promise = axios.get("/obtenerPacientesMedico");
      promise
        .then((response) => {
          console.log(response.data);
          // this.pacientes_pag = response.data;
          this.pacientes = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log("ERROR: " + error.response.status);
          // window.location.href = "/errors/" + error.response.status;
        });
    },
    nuevoPaciente() {
      window.location.href = "/pacientes/create";
    },
    abrirPaciente(idPaciente) {
      //accede a partida con ID

      const promise = axios.get("/pacientes/" + idPaciente + "/edit");
      promise
        .then((response) => {
          console.log("Acceso a paciente confirmado", response.statusText);
          let url =
            location.protocol +
            "//" +
            location.hostname +
            (location.port ? ":" + location.port : "");
          window.location.href = "/pacientes/" + idPaciente + "/edit";
        })
        .catch((error) => {
          console.log("ERROR: " + error);
          window.location.href = "/errors/" + error.response.status;
        });
    },
    borrarPaciente(paciente) {
      let paciente_id = paciente.id;
      if (confirm("¿Seguro que deseas borrar este paciente?")) {
        const promise = axios.delete("/pacientes/" + paciente_id, paciente);
        promise
          .then((response) => {
            // console.log(response.data);
            this.obtenerPacientes();
          })
          .catch((error) => {
            console.log("ERROR: " + error.message);
            window.location.href = "/errors/" + error.response.status;
          });
      }
    },
  },
  computed: {
    buscarPaciente() {
      return this.pacientes.filter((paciente) => {
        const nombre = paciente.nombre.toString().toLowerCase();
        const apellidos = paciente.apellidos.toLowerCase();
        const NIF = paciente.NIF.toLowerCase();
        const busqueda = this.filtro.toLowerCase();
        return (
          nombre.includes(busqueda) ||
          apellidos.includes(busqueda) ||
          NIF.includes(busqueda)
        );
      });
    },
  },
};
</script>
<style lang="scss" scoped>
.my-custom-scrollbar {
  position: relative;
  height: 90%;
  overflow: auto;
}
.table-wrapper-scroll-y {
  display: block;
}
</style>