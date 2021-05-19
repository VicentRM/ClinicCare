<template>
  <div>
      <h3 class="text-center">Motivos Visita</h3>
    <form accept-charset="UTF-8" @submit.prevent="guardarMotivo">
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          v-model="obj_motivo.descripcion"
          :class="{'is-invalid': enviar && $v.obj_motivo.descripcion.$error}"
        />
        <div class="input-group-append">
          <button class="btn btn-dark" type="submit">Guardar</button>
        </div>
      </div>
      <div
        v-if="enviar && !$v.obj_motivo.descripcion.required"
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
        <tr v-for="motivo in motivosvisita" :key="motivo.id">
          <td>{{ motivo.id }}</td>
          <td>{{ motivo.descripcion }}</td>
          <td style="width: 20%;">
            <button type="button" class="btn btn-warning btn-sm">
              <i
                class="fa fa-pencil"
                aria-hidden="true"
                @click="cargarMotivo(motivo.id,motivo.descripcion)"
              ></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm">
              <i class="fa fa-trash" aria-hidden="true" @click="borrarMotivo(motivo.id)"></i>
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
  name: "motivosvisita-component",
  components: {},
  props: {},
  data: () => ({
    motivosvisita: [],
    obj_motivo: {
      id: 0,
      descripcion: "",
    },
    edicion: false,
    enviar: false,
  }),
  validations: {
    obj_motivo: {
      descripcion: { required },
    },
  },
  created() {
    this.obtenerMotivos();
  },
  methods: {
    obtenerMotivos() {
      const promise = axios.get("/motivovisitas");
      promise
        .then((response) => {
          this.motivosvisita = response.data;
          console.log(this.motivosvisita);
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    guardarMotivo() {
      if (!this.edicion) {
        this.crearMotivo();
      } else {
        this.actualizarMotivo();
      }
    },
    crearMotivo() {
      this.enviar = true;
      //parar si el formulario es invalido
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      const promise = axios.post("/motivovisitas", this.obj_motivo);
      promise
        .then((response) => {
          this.motivosvisita = response.data;
          console.log(this.motivosvisita);
          this.resetForm();
          this.obtenerMotivos();
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    cargarMotivo(idMotivo, descripcionMotivo) {
      this.obj_motivo.id = idMotivo;
      this.obj_motivo.descripcion = descripcionMotivo;
      this.edicion = true;
    },
    actualizarMotivo() {
      console.log("/motivovisitas/" + this.obj_motivo.id, this.obj_motivo);
      const promise = axios.put(
        "/motivovisitas/" + this.obj_motivo.id,
        this.obj_motivo
      );
      promise
        .then((response) => {
          this.resetForm();
          this.obtenerMotivos();
          this.edicion = false;
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    borrarMotivo(idMotivo) {
     
      const promise = axios.delete("motivovisitas/" + idMotivo);
      promise
        .then((response) => {
          this.resetForm();
          this.obtenerMotivos();
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
          //console.log(error.response.status);
          //console.log(error.response.statusText);
          //console.log(error.response.data);
          if (error.response.data.includes("1451")) {
            alert("Hay visitas con este motivo, no es poible eliminarlo");
          }
        });
    },
    resetForm() {
      Object.keys(this.obj_motivo).forEach((key) => {
        return (this.obj_motivo[key] = "");
      });
      this.enviar = false;
    },
  },
};
</script>

<style>
</style>