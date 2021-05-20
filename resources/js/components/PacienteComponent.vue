<template>
  <div>
    <h2>Datos paciente</h2>
    <form accept-charset="UTF-8" enctype="multipart/form-data" @submit.prevent="guardarPaciente">
      <div class="row mb-6">
        <div class="col-6">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input
              type="text"
              class="form-control"
              v-model="c_paciente.nombre"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.nombre.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.nombre.required"
              class="invalid-feedback"
            >El nombre es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input
              type="text"
              class="form-control"
              v-model="c_paciente.apellidos"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.apellidos.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.apellidos.required"
              class="invalid-feedback"
            >Los apellidos son obligatorios</div>
          </div>
          <div class="mb-3">
            <label for="NIF" class="form-label">NIF</label>
            <input
              type="text"
              class="form-control"
              v-model="c_paciente.NIF"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.NIF.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.NIF.required"
              class="invalid-feedback"
            >El NIF es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>
            <input
              type="date"
              class="form-control"
              v-model="c_paciente.fecha_nacimiento"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.fecha_nacimiento.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.fecha_nacimiento.required"
              class="invalid-feedback"
            >La fecha de nacimiento es obligatoria</div>
          </div>
          <div class="mb-3">
            <label for="fecha_alta" class="form-label">Fecha alta</label>
            <input
              type="date"
              class="form-control"
              v-model="c_paciente.fecha_alta"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.fecha_alta.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.fecha_alta.required"
              class="invalid-feedback"
            >La fecha de alta es obligatoria</div>
          </div>
          <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-control" id="sexo" name="sexo" v-model="c_paciente.sexo">
              <option id="Femenino">Femenino</option>
              <option id="Masculino">Masculino</option>
            </select>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control" placeholder v-model="c_paciente.direccion" />
          </div>
          <div class="mb-3">
            <label for="CP" class="form-label">CP</label>
            <input
              type="text"
              class="form-control"
              placeholder
              v-model="c_paciente.CP"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.CP.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.CP.required"
              class="invalid-feedback"
            >La código postal es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="poblacion" class="form-label">Poblacion</label>
            <input type="text" class="form-control" placeholder v-model="c_paciente.poblacion" />
          </div>
          <div class="mb-3">
            <label for="telefono1" class="form-label">Teléfono</label>
            <input
              type="text"
              class="form-control"
              placeholder
              v-model="c_paciente.telefono1"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.telefono1.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.telefono1.required"
              class="invalid-feedback"
            >El télefono es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="telefono2" class="form-label">Teléfono 2</label>
            <input type="text" class="form-control" placeholder v-model="c_paciente.telefono2" />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input
              type="email"
              class="form-control"
              placeholder
              v-model="c_paciente.email"
              :class="{
                    'is-invalid': enviar && $v.c_paciente.email.$error
                  }"
            />
            <div
              v-if="enviar && !$v.c_paciente.email.required"
              class="invalid-feedback"
            >El email es obligatorio</div>
          </div>
        </div>
      </div>
      <div class="row justify-content-md-center">
        <button type="submit" class="btn btn-dark">Guardar</button>
      </div>
    </form>
  </div>
</template>
<script>
import moment from "moment";

import {
  required,
  email,
  minLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);

export default {
  components: {},
  props: {
    paciente: { required: false, type: Object },
    nuevopaciente: { required: true, type: Boolean },
  },

  data: () => ({
    c_paciente: {
      nombre: "",
      apellidos: "",
      fecha_nacimiento: "",
      fecha_alta: "",
      sexo: "",
      direccion: "",
      poblacion: "",
      telefono1: "",
      telefono2: "",
      email: "",
    },

    enviar: false,
    c_documentos: [],
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
  validations: {
    c_paciente: {
      nombre: { required },
      apellidos: { required },
      NIF: { required },
      fecha_nacimiento: { required },
      fecha_alta: { required },
      CP: { required },
      telefono1: { required },
      email: { required, email },
    },
  },
  created() {
    if (!this.nuevopaciente) {
      this.c_paciente = this.paciente;
    }
  },
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

  methods: {
    guardarPaciente() {
      if (this.nuevopaciente) {
        this.nuevoPaciente();
      } else {
        this.actualizarPaciente();
      }
    },
    nuevoPaciente() {
      this.enviar = true;
      //parar si el formulario es invalido
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      const promise = axios.post("/pacientes", this.c_paciente);
      promise
        .then((response) => {
          // console.log(response.data);
          window.location.href = "/pacientes";
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    actualizarPaciente() {
      this.enviar = true;
      //parar si el formulario es invalido
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      const promise = axios.put(
        "/pacientes/" + this.c_paciente.id,
        this.c_paciente
      );

      promise
        .then((response) => {
          // console.log(response.data);
          window.location.href = "/pacientes";
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
  },
};
</script>

<style>
</style>