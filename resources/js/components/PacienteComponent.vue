<template>
  <div>
    <h4>Datos paciente</h4>
    <div class="form-group">
      <div class="row mb-6">
        <div class="col-6">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input
              type="text"
              class="form-control"
              v-model="pacienteEdit.nombre"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.nombre.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.nombre.required"
              class="invalid-feedback"
            >El nombre es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input
              type="text"
              class="form-control"
              v-model="pacienteEdit.apellidos"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.apellidos.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.apellidos.required"
              class="invalid-feedback"
            >Los apellidos son obligatorios</div>
          </div>
          <div class="mb-3">
            <label for="NIF" class="form-label">NIF</label>
            <input
              type="text"
              class="form-control"
              v-model="pacienteEdit.NIF"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.NIF.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.NIF.required"
              class="invalid-feedback"
            >El NIF es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>
            <input
              type="date"
              class="form-control"
              v-model="pacienteEdit.fecha_nacimiento"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.fecha_nacimiento.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.fecha_nacimiento.required"
              class="invalid-feedback"
            >La fecha de nacimiento es obligatoria</div>
          </div>
          <div class="mb-3">
            <label for="fecha_alta" class="form-label">Fecha alta</label>
            <input
              type="date"
              class="form-control"
              v-model="pacienteEdit.fecha_alta"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.fecha_alta.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.fecha_alta.required"
              class="invalid-feedback"
            >La fecha de alta es obligatoria</div>
          </div>
          <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-control" id="sexo" name="sexo" v-model="pacienteEdit.sexo">
              <option id="Femenino">Femenino</option>
              <option id="Masculino">Masculino</option>
            </select>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control" placeholder v-model="pacienteEdit.direccion" />
          </div>
          <div class="mb-3">
            <label for="CP" class="form-label">CP</label>
            <input
              type="text"
              class="form-control"
              placeholder
              v-model="pacienteEdit.CP"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.CP.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.CP.required"
              class="invalid-feedback"
            >La código postal es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="poblacion" class="form-label">Poblacion</label>
            <input type="text" class="form-control" placeholder v-model="pacienteEdit.poblacion" />
          </div>
          <div class="mb-3">
            <label for="telefono1" class="form-label">Teléfono</label>
            <input
              type="text"
              class="form-control"
              placeholder
              v-model="pacienteEdit.telefono1"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.telefono1.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.telefono1.required"
              class="invalid-feedback"
            >El télefono es obligatorio</div>
          </div>
          <div class="mb-3">
            <label for="telefono2" class="form-label">Teléfono 2</label>
            <input type="text" class="form-control" placeholder v-model="pacienteEdit.telefono2" />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input
              type="email"
              class="form-control"
              placeholder
              v-model="pacienteEdit.email"
              :class="{
                    'is-invalid': enviar && $v.pacienteEdit.email.$error
                  }"
            />
            <div
              v-if="enviar && !$v.pacienteEdit.email.required"
              class="invalid-feedback"
            >El email es obligatorio</div>
          </div>
        </div>
      </div>   
      <div class=toolbar>
      <div class="botonera">
           <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
           <button v-if="update == 0" @click="guardarPaciente()" class="btn btn-success">Añadir</button>
           <!-- Botón que modifica el medico que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
           <button v-if="update != 0" @click="actualizarPaciente()" class="btn btn-warning">Actualizar</button>    
      </div>
      </div>
    </div>
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
    update: {required:true,type: Number},
  },

  data: () => ({
    pacienteEdit:{},   
    enviar: false, 
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
    pacienteEdit: {
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
    if (this.update!=0) {
      this.pacienteEdit = this.paciente;
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
    guardarPaciente(){//Esta funcion crea un nuevo paciente segun lo rellenado en el formualrio
            this.enviar = true;
            //parar si el formulario es invalido
            this.$v.$touch();
            if (this.$v.$invalid) {
               return;
           }
            const promise = axios.post("/pacientes",this.pacienteEdit);         
            promise
                .then((response) => {
                    //this.obtenerMotivos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    //this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0
                    window.location.href = "/pacientes";

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });
    },
    actualizarPaciente() {
      this.enviar = true;
      //parar si el formulario es invalido
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      if (!this.validarNIF(this.pacienteEdit.NIF)){
        return;
      }
      const promise = axios.put(
        "/pacientes/" + this.pacienteEdit.id,
        this.pacienteEdit
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
    validarNIF(dni) {
      let numero;
      let letr;
      let letra;
      let expresion_regular_dni;
    
      expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
    
      if(expresion_regular_dni.test (dni) == true){
        numero = dni.substr(0,dni.length-1);
        letr = dni.substr(dni.length-1,1);
        numero = numero % 23;
        letra='TRWAGMYFPDXBNJZSQVHLCKET';
        letra=letra.substring(numero,numero+1);
        if (letra!=letr.toUpperCase()) {
          alert('Dni erroneo, la letra del NIF no se corresponde');
          return false;
        }else{
          //Dni correcto
          return true;
        }
      }else{
        alert('Dni erroneo, formato no válido');
        return false;
      }
    }
  },
};
</script>

<style lang="scss" scoped>
.toolbar {
  display: flex;
  //grid-template-columns: repeat(2,1fr);
}
.botonera {
  margin-left:auto;
  
  
}
</style>