<template>
  <div class="content">    
    <div class="row">
      <div class="col-xl-6 col-md-12">
        <div class="form-group">
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
                <button class="btn btn-dark" type="button" @click="guardarPrueba()">Guardar</button>
              </div>
          </div>
        </div>       
        <table class="table table-sm table-striped table-bordered">
          <thead class="thead-dark">
            <tr>         
              <th scope="col">Tipo de prueba</th>        
              <th scope="col" style="width: 20%;">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="prueba in pruebas" :key="prueba.id">
              <td @click="cargarPrueba(prueba)">{{ prueba.tipo_prueba.descripcion }}</td>            
              <td style="width: 20%;">         
                <button type="button" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash" aria-hidden="true" @click="borrarPrueba(prueba)"></i>
                </button>
              </td>
            </tr>
            <tr></tr>
          </tbody>
        </table>
      </div>
      <div class="col-xl-6 col-md-12">
        <div class="alert alert-success" role="alert" v-show="showAlert">
                Datos guardados correctamente.
            </div>
          <div class="form-group">
              <div class="mb-3">
                <label for="comentarios" class="form-label">Valoración/conclusión prueba</label>
                <textarea class="form-control" rows="10" v-model="pruebaEdit.valoracion" :disabled="update == 0"></textarea>
                 </div>
                <button type="button" class="btn btn-dark" :disabled="update == 0" @click="actualizarPrueba()">
                                Guardar cambios
                </button>         
          </div>          
           
          <documentos-component v-if="update != 0"
                    :idvinculo="update"
                    :vinculo_doc="'prueba_medica_id'"                  
          ></documentos-component>
         
          
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
      pruebaEdit:{},
      modificar:0,
      update:0,
      nuevaprueba:{
          visita_id:null,
          tipo_prueba_id:null,
      },
      showAlert:false,
  }),
  created() {
      this.obtenerPruebas();
      this.otenerTipoPruebas();
  },
  filters: {
    
  },
  methods: {
    alertGuardar(){
     
            this.showAlert = true;
            setTimeout(() => {
                this.showAlert = false;
            }, 2000);
        },
    obtenerPruebas(){
        const promise = axios.get("/pruebasmedicas/obtenerpruebasmedicasvisita/" + this.visita.id);
      promise
        .then((response) => {
          console.log("Pruebas visita paciente:", response.data);
          this.pruebas = response.data;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
   
    cargarPrueba(data){
            this.update=data.id;                  
            const promise = axios.get("/pruebasmedicas/buscar/"+this.update);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.pruebaEdit = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });            
        },
     actualizarPrueba(){     
        const promise = axios.put("/pruebasmedicas/"+this.pruebaEdit.id,this.pruebaEdit);         
        promise
          .then((response) => {
              console.log(response.data);      
              this.alertGuardar();
              this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

          })
        .catch((error) => {
            console.log("ERROR: " + error);
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
    guardarPrueba(){
        this.nuevaprueba.visita_id=this.visita.id;
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
   
    borrarPrueba(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
           
         if (confirm('¿Seguro que deseas borrar esta prueba?')) {
                    const promise = axios.delete("/pruebasmedicas/" + data.id);
                    promise
                      .then((response) => {       
                        this.obtenerPruebas();
                      })
                      .catch((error) => {
                        console.log("ERROR: " + error.message);  
                        if (error.response.data.includes("1451")) {
                                alert("Hay visitas con este motivo, no es poible eliminarlo");
                        }       
                      });
                }
      
    },
    resetForm(){/*Limpia los campos e inicializa la variable update a 0*/
            this.pruebaEdit={},
            this.update = 0;
    },
  },
}

</script>

<style lang="scss" scoped>

.content{
  padding-top: 20px;
}
.toolbar {
  display: flex;
  //grid-template-columns: repeat(2,1fr);
}
.buscador {
  width: 50%;
}

.botonera {
  margin-left:auto;
  
  .btn{
  width: 80px;
}

}
</style>