<template>
  <div>
      <h3 class="text-center">Motivos Visita</h3>
      <div class="alert alert-danger" role="alert" v-show="showAlert">
                {{msgError}}
      </div>
    <div class="form-group">
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          v-model="motivoEdit.descripcion"
          :class="{'is-invalid': enviar && $v.motivoEdit.descripcion.$error}"
        />
        <div class="input-group-append">
           <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
           <button v-if="update == 0" @click="guardarMotivo()" class="btn btn-success">Añadir</button>
           <!-- Botón que modifica el medico que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
           <button v-if="update != 0" @click="actualizarMotivo()" class="btn btn-warning">Actualizar</button>
           <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
           <button v-if="update != 0" @click="resetForm()" class="btn">Atrás</button>
        </div>
      </div>
      <div
        v-if="enviar && !$v.motivoEdit.descripcion.required"
        class="invalid-feedback"
      >La descripció es obligatoria</div>
    </div>
    <table class="table table-sm table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Descripción</th>
          <th scope="col" style="width: 20%;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="motivo in arrayMotivosVisita" :key="motivo.id">
          <td>{{ motivo.id }}</td>
          <td>{{ motivo.descripcion }}</td>
          <td style="width: 20%;">
            <button type="button" class="btn btn-warning btn-sm">
              <i
                class="fa fa-pencil"
                aria-hidden="true"
                @click="cargarMotivo(motivo)"
              ></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm">
              <i class="fa fa-trash" aria-hidden="true" @click="borrarMotivo(motivo)"></i>
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
    data(){
        return{
            arrayMotivosVisita:[],         
            motivoEdit:{},
             update:0, /*Esta variable contrarolará cuando es un nuevo motivo o una modificación, si es 0 significará que no hemos seleccionado
                          ningun medico, pero si es diferente de 0 entonces tendrá el id del medico y no mostrará el boton guardar sino el modificar*/
            enviar: false,
            msgError:"",
            showAlert : false,
        }
    },
    validations: {
        motivoEdit: {
           descripcion: { required },
        },
    },
    created(){
        this.obtenerMotivos();
        
    },
    methods:{
      alertError($msgError){
            this.showAlert = true;
            this.msgError=$msgError;
            setTimeout(() => {
                this.showAlert = false;
                this.msgError="";
            }, 3000);
        },
        //Funcion para obtener los medicos
        obtenerMotivos(){
            console.log("Medicos");
            const promise = axios.get("/motivovisitas/obtenermotivos/");         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.arrayMotivosVisita = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
             
        },       
             

        guardarMotivo(){//Esta funcion crea un nuevo medico segun lo rellenado en el formualrio
            this.enviar = true;
            //parar si el formulario es invalido
            this.$v.$touch();
            if (this.$v.$invalid) {
               return;
           }
            const promise = axios.post("/motivovisitas",this.motivoEdit);         
            promise
                .then((response) => {
                    this.obtenerMotivos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        actualizarMotivo(){
         
            const promise = axios.put("/motivovisitas/"+this.motivoEdit.id,this.motivoEdit);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.obtenerMotivos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        cargarMotivo(data){
            this.update=data.id;
       
            const promise = axios.get("/motivovisitas/buscar/"+this.update);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.motivoEdit = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });            
        },
        borrarMotivo(data){
           
            if (confirm('¿Seguro que deseas borrar este motivo?')) {
                    const promise = axios.delete("/motivovisitas/" + data.id);
                    promise
                      .then((response) => {       
                        this.obtenerMotivos();
                      })
                      .catch((error) => {
                        console.log("ERROR: " + error.message);  
                        this.alertError(error.response.data.msg);
                        //window.location.href = "/errors/"+error.response.status;       
                      });
                }
      
        },
        resetForm(){/*Limpia los campos e inicializa la variable update a 0*/
            this.motivoEdit={},
            this.update = 0;
            this.enviar=false;
        },

        
    },
}
</script>


<style>
</style>