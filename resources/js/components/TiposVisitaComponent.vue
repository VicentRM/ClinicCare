<template>
  <div>
    <h3 class="text-center">Tipos Visita</h3>
    <form accept-charset="UTF-8" @submit.prevent="guardarTipo">
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          v-model="obj_tipo.descripcion"
          :class="{'is-invalid': enviar && $v.obj_tipo.descripcion.$error}"
        />
        <div class="input-group-append">
          <button class="btn btn-dark" type="submit">Guardar</button>
        </div>
      </div>
      <div
        v-if="enviar && !$v.obj_tipo.descripcion.required"
        class="invalid-feedback"
      >La descripció es obligatoria</div>
    </form>
    <table class="table table-sm table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Descripción</th>
          <th scope="col" style="width: 20%;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tipo in tiposvisita" :key="tipo.id">
          <td>{{ tipo.id }}</td>
          <td>{{ tipo.descripcion }}</td>
          <td style="width: 20%;">
            <button type="button" class="btn btn-warning btn-sm">
              <i
                class="fa fa-pencil"
                aria-hidden="true"
                @click="cargarTipo(tipo.id,tipo.descripcion)"
              ></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm">
              <i class="fa fa-trash" aria-hidden="true" @click="borrarTipo(tipo.id)"></i>
            </button>
          </td>
        </tr>
        <tr></tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
export default {
  name: "tiposvisita-component",
  components: {},
  props: {},
  data: () => ({
    tiposvisita: [],
    obj_tipo: {
      id: 0,
      descripcion: "",
    },
    edicion: false,
    enviar: false,
  }),
  validations: {
    obj_tipo: {
      descripcion: { required },
    },
  },
  created() {
    this.obtenerTipos();
  },
  methods: {
    obtenerTipos() {
      const promise = axios.get("/tipovisitas");
      promise
        .then((response) => {
          this.tiposvisita = response.data;
          console.log(this.tiposvisita);
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    guardarTipo() {
      if (!this.edicion) {
        this.crearTipo();
      } else {
        this.actualizarTipo();
      }
    },
    crearTipo() {
      this.enviar = true;
      //parar si el formulario es invalido
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      const promise = axios.post("/tipovisitas", this.obj_tipo);
      promise
        .then((response) => {
          this.tiposvisita = response.data;
          console.log(this.tiposvisita);
          this.resetForm();
          this.obtenerTipos();
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    cargarTipo(idTipo, descripcionTipo) {
      this.obj_tipo.id = idTipo;
      this.obj_tipo.descripcion = descripcionTipo;
      this.edicion = true;
    },
    actualizarTipo() {
      console.log("/tipovisitas/" + this.obj_tipo.id, this.obj_tipo);
      const promise = axios.put(
        "/tipovisitas/" + this.obj_tipo.id,
        this.obj_tipo
      );
      promise
        .then((response) => {
          this.resetForm();
          this.obtenerTipos();
          this.edicion = false;
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    borrarTipo(idTipo) {
      const promise = axios.delete("tipovisitas/" + idTipo);
      promise
        .then((response) => {
          this.resetForm();
          this.obtenerTipos();
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
          //console.log(error.response.status);
          //console.log(error.response.statusText);
          //console.log(error.response.data);
          if (error.response.data.includes("1451")) {
            alert("Hay visitas con este tipo, no es poible eliminarlo");
          }
        });
    },
    resetForm() {
      Object.keys(this.obj_tipo).forEach((key) => {
        return (this.obj_tipo[key] = "");
      });
      this.enviar = false;
    },
  },
};
</script>

<style>
</style>