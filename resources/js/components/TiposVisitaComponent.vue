<template>
  <div>
      <h3 class="text-center">Tipos Visita</h3>
    <div class="form-group">
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          v-model="tipoEdit.descripcion"
          :class="{'is-invalid': enviar && $v.tipoEdit.descripcion.$error}"
        />
        <div class="input-group-append">
           <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
           <button v-if="update == 0" @click="guardarTipo()" class="btn btn-success">Añadir</button>
           <!-- Botón que modifica el medico que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
           <button v-if="update != 0" @click="actualizarTipo()" class="btn btn-warning">Actualizar</button>
           <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
           <button v-if="update != 0" @click="resetForm()" class="btn">Atrás</button>
        </div>
      </div>
      <div
        v-if="enviar && !$v.tipoEdit.descripcion.required"
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
        <tr v-for="tipo in arrayTiposVisita" :key="tipo.id">
          <td>{{ tipo.id }}</td>
          <td>{{ tipo.descripcion }}</td>
          <td style="width: 20%;">
            <button type="button" class="btn btn-warning btn-sm">
              <i
                class="fa fa-pencil"
                aria-hidden="true"
                @click="cargarTipo(tipo)"
              ></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm">
              <i class="fa fa-trash" aria-hidden="true" @click="borrarTipo(tipo)"></i>
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
    data(){
        return{
            arrayTiposVisita:[],         
            tipoEdit:{},
             update:0, /*Esta variable contrarolará cuando es un nuevo tipo o una modificación, si es 0 significará que no hemos seleccionado
                          ningun medico, pero si es diferente de 0 entonces tendrá el id del medico y no mostrará el boton guardar sino el modificar*/
            enviar: false,
        }
    },
    validations: {
        tipoEdit: {
           descripcion: { required },
        },
    },
    created(){
        this.obtenerTipos();
        
    },
    methods:{
        //Funcion para obtener los medicos
        obtenerTipos(){
            console.log("Medicos");
            const promise = axios.get("/tipovisitas/obtenertipos/");         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.arrayTiposVisita = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
             
        },       
             

        guardarTipo(){//Esta funcion crea un nuevo medico segun lo rellenado en el formualrio
            this.enviar = true;
            //parar si el formulario es invalido
            this.$v.$touch();
            if (this.$v.$invalid) {
               return;
           }
            const promise = axios.post("/tipovisitas",this.tipoEdit);         
            promise
                .then((response) => {
                    this.obtenerTipos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        actualizarTipo(){
         
            const promise = axios.put("/tipovisitas/"+this.tipoEdit.id,this.tipoEdit);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.obtenerTipos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        cargarTipo(data){
            this.update=data.id;
       
            const promise = axios.get("/tipovisitas/buscar/"+this.update);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.tipoEdit = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });            
        },
        borrarTipo(data){
           
            if (confirm('¿Seguro que deseas borrar este tipo?')) {
                    const promise = axios.delete("/tipovisitas/" + data.id);
                    promise
                      .then((response) => {       
                        this.obtenerTipos();
                      })
                      .catch((error) => {
                        console.log("ERROR: " + error.message); 
                        window.location.href = "/errors/"+error.response.status;        
                      });
                }
      
        },
        resetForm(){/*Limpia los campos e inicializa la variable update a 0*/
            this.tipoEdit={},
            this.update = 0;
            this.enviar=false;
        },

        
    },
}
</script>


<style>
</style>