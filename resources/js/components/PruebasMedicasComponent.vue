<template>
  <div>
    <div class="row">
      <div class="col-6">
        <form @submit.prevent="guardarNuevaPrueba">  
          <label for="recipient-name" class="col-form-label">Tipo de prueba</label>
          <div class="input-group mb-3">     
              <select class="form-control" v-model="nuevaprueba.tipo_prueba_id">
                <option
                  v-for="prueba in tipopruebas"
                  :key="prueba.id"
                  :value="prueba.id"
                >{{ prueba.descripcion }}</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-dark" type="subbmit">Guardar</button>
              </div>
          </div>
        </form>       
        <table class="table table-sm table-striped table-bordered">
          <thead class="thead-dark">
            <tr>         
              <th scope="col">Tipo de prueba</th>        
              <th scope="col" style="width: 20%;">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="prueba in pruebas" :key="prueba.id">
              <td @click="cargarValoracion(prueba)">{{ prueba.tipo_prueba.descripcion }}</td>            
              <td style="width: 20%;">         
                <button type="button" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash" aria-hidden="true" @click="borrarPrueba(prueba.id)"></i>
                </button>
              </td>
            </tr>
            <tr></tr>
          </tbody>
        </table>
      </div>
      <div class=col-6>
          <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" @submit.prevent="guardarValoracion">
          <div class="mb-3">
             <label for="comentarios" class="form-label">Valoración/conclusión prueba</label>
                <textarea class="form-control" rows="4" v-model="pruebaMod.valoracion" :disabled="modificar == 0"></textarea>
                 </div>
                <button type="submit" class="btn btn-dark" :disabled="modificar == 0">
                                Guardar cambios
                </button>
         
          </form>
      </div>
      </div>
  </div>
</template>

<script>

export default {

  name: "pruebasmedicas-component",
  props: {
    visita: { required: true, type: Object },
    
  },
  data: () => ({
      pruebas:[],
      tipopruebas:[],
      pruebaMod:{},
      modificar:0,
      nuevaprueba:{
          visita_id:null,
          tipo_prueba_id:null,
      }
  }),
  created() {
      this.obtenerPruebas();
      this.otenerTipoPruebas();
  },
  filters: {
    
  },
  methods: {
    obtenerPruebas(){
        const promise = axios.get("/pruebasmedicas/obtenerpruebasmedicasvisita/" + this.visita.id);
      promise
        .then((response) => {
          console.log("Pruebas visita paciente:", response.data);
          this.pruebas = response.data.pruebas;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
    cargarValoracion(pruebaModificar){
       
        this.pruebaMod=pruebaModificar;
        console.log(this.pruebaMod.valoracion);

        this.modificar=1;
    },
    guardarValoracion(){    
      const promise = axios.put("/pruebasmedicas/"+this.pruebaMod.id, this.pruebaMod);
      promise
        .then((response) => {
          console.log(response.data);
          this.c_documentos = response.data;
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    otenerTipoPruebas(){
      const promise = axios.get("/tipopruebas");
      promise
        .then((response) => {
          this.tipopruebas = response.data;          
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    guardarNuevaPrueba(){
        this.nuevaprueba.visita_id=this.visita.id;
      console.log("Guardar"+this.nuevaprueba.tipo_prueba_id);
        const promise = axios.post("/pruebasmedicas/",this.nuevaprueba);
        promise
        .then((response) => {
          
          this.obtenerPruebas();
          console.log(response);
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
        });
    },
    borrarPrueba(){

    },
  },
}

</script>

<style>

</style>