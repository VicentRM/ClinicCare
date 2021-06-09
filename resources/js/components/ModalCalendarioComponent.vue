<template>
  <div class="modal fade in modal-active" data-target="#myModal" id="calendarModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cita paciente</h4>
        </div>
        <form @submit="comprobarForm">
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Paciente:</label>
              <select
                class="form-control"
                id="paciente"
                name="paciente"
                value
                v-model="form.paciente_id"
              >
                <option
                  v-for="paciente in form.pacientes"
                  :key="paciente.id"
                  :value="paciente.id"
                >{{ paciente.apellidos }}, {{ paciente.nombre }}</option>
              </select>

              <label for="recipient-name" class="col-form-label">Tipo visita:</label>
              <select
                class="form-control"
                id="paciente"
                name="tipo_visita"
                value
                v-model="form.tipo_visita_id"
              >
                <option
                  v-for="(visita,index) in form.tipos_visita"
                  :key="visita.id"
                  :value="visita.id"
                  v-bind:selected="index === 0 ? 'true' :'false'"
                >{{ visita.descripcion }}</option>
              </select>
              <label for="recipient-name" class="col-form-label">Motivo visita:</label>
              <select
                class="form-control"
                id="paciente"
                name="motivo_visita"
                value
                v-model="form.motivo_visita_id"
              >
                <option
                  v-for="(motivo,index) in form.motivos_visita"
                  :key="motivo.id"
                  :value="motivo.id"
                  v-bind:selected="index === 0"
                >{{ motivo.descripcion }}</option>
              </select>
              <label for="recipient-name" class="col-form-label">Fecha:</label>
              <input type="date" class="form-control" id="fecha" v-model="form.fecha" />
              <label for="recipient-name" class="col-form-label">Hora:</label>
              <input type="time" class="form-control" id="hora" v-model="form.hora" />
              <label for="recipient-name" class="col-form-label">Duracion:</label>
              <select
                class="form-control"
                id="tiempo"
                name="duracion"
                value
                v-model="form.duracion"
              >
                <option value="900">15 minutos</option>
                <option value="1800">30 minutos</option>
                <option value="3600">1 hora</option>
              </select>
              <div v-if="errores.length">
                <ul class="listaErrores">
                  <li v-for="error in errores" :key="error.id">{{ error }}</li>
                </ul>
              </div>
              <!-- <v-select :options="[form.pacientes]"  :getOptionLabel="paciente=>paciente.nombre" v-model="form.paciente_id"></v-select>   -->
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-dark" @click="resetEvento()" data-dismiss="modal" >Cerrar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fa fa-trash" @click="eliminarEvento()"></i>
            </button>
            <button
              v-if="update==1"
              type="button"
              class="btn btn-dark"
              data-dismiss="modal"
              @click="abrirvisita()"
            >Ir a la visita</button>
            <button
              type="button"
              class="btn btn-dark"
              @click="comprobarForm(form)"
              data-dismiss="modal"
            >Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script>
import "vue-select/dist/vue-select.css";
import vSelect from "vue-select";
Vue.component("v-select", vSelect);
export default {
  name: "modalcalendario-component",
  components: {},
  props: {
    form: {
      type: Object,
      default: () => {},
    },
    update: { required: true, type: Number },
  },
  data: () => ({
    errores: [],
  }),
  methods: {
    abrirvisita() {
      this.$emit("abrirvisita");
    },
    guardar(form) {
      this.$emit("guardarEvento", form);
    },
    eliminarEvento() {
      console.log("eliminar");
      this.$emit("eliminarevento");
    },
    comprobarForm: function (form) {
      this.errores = [];
      if (this.form.paciente_id === 0) {
        this.errores.push("Indique paciente");
      }
      if (this.form.tipo_visita_id === 0) {
        this.errores.push("Indique tipo de visita");
      }
      if (this.form.motivo_visita_id === 0) {
        this.errores.push("Indique motivo de la visita");
      }
      if (this.errores.length == 0) {
        this.guardar(form);
      }
    },
    resetEvento(){
      this.$emit("resetEvento");
    }
  },
};
</script>

<style lang="scss" scoped>
.listaErrores {
  list-style: none;
  color: red;
  padding: 0;
  margin: 0;
}
</style>