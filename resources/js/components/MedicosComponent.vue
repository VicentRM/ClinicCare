<template>
  <div>     
        <h4>Médicos</h4>         
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="toolbar">
            <div class="botonera">
                    <button type="button" class="btnview btn-outline-dark" @click="viewTable()"><i class="fa fa-table"></i></button> 
                    <button type="button" class="btnview btn-outline-dark" @click="viewGird()"><i class="fa fa-th-large"></i></button> 
            </div>
        </div>
            <div class="medicos" v-if="view==0">
                    <div class="tarjeta" v-for="medico in arrayMedicos" :key="medico.id" @click="cargarMedico(medico)">
                        <div class="avatar">  
                            <upload-image-component
                                    :image="medico.user.avatar"
                                    :user="medico.user"
                                    @avatar-change="onAvatarChange"
                                />  
                        </div>
                        <div class="info">
                            <p>{{ medico.apellidos }},{{ medico.nombre }}</p>
                            <p>NºColegiado:{{ medico.num_colegiado }}</p>
                            <p>NIF:{{ medico.NIF }}</p>
                        </div>
                    </div>     
            </div>
            <div class="table-responsive"  v-if="view==1">
                <table class="table table-sm table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Nombre</th>  
                    <th scope="col">NIF</th>  
                    <th scope="col">NºColegiado</th>
                    <th scope="col">Usuario</th>           
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="medico in arrayMedicos" :key="medico.id">
                    <td @click="cargarMedico(medico)">{{ medico.apellidos }},{{ medico.nombre }}</td>
                    <td>{{ medico.NIF }}</td>
                    <td>{{ medico.num_colegiado }}</td>
                    <td>{{ medico.user_id }}</td>        
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    <div class="col-xl-6 col-md-12">
         <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" v-model="medicoEdit.nombre">                    
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" v-model="medicoEdit.apellidos">                    
                </div>
                <div class="form-group">
                    <label>NIF</label>
                    <input type="text" class="form-control" v-model="medicoEdit.NIF">                    
                </div>
                <div class="form-group">
                    <label>NºColegiado</label>
                    <input type="text" class="form-control" v-model="medicoEdit.num_colegiado">                                       
                </div>    
                <div class="form-group">
                    <label>Usuario</label>
                    <select class="form-control" v-model="medicoEdit.user_id">              
                        <option v-for="usuario in arrayUsuarios" :key="usuario.id" :value="usuario.id">
                            {{usuario.name}}-{{usuario.email}}
                        </option>
                    </select>                                      
                </div>    
                <div class="container-buttons">
                    <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
                    <button v-if="update == 0" @click="guardarMedico()" class="btn btn-success">Añadir</button>
                    <!-- Botón que modifica el medico que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="actualizarMedico()" class="btn btn-warning">Actualizar</button>
                    <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="resetForm()" class="btn">Atrás</button>
                </div>           
        </div>
    </div>

  </div>
</template>

<script>
export default {
    name: "medicos-component",
    data(){
        return{
            arrayMedicos:[],
            arrayUsuarios:[],
            medicoEdit:{},
            update:0, /*Esta variable contrarolará cuando es un nuevo medico o una modificación, si es 0 significará que no hemos seleccionado
                          ningun medico, pero si es diferente de 0 entonces tendrá el id del medico y no mostrará el boton guardar sino el modificar*/
            view:0,
        }
    },
    created(){
        this.obtenerMedicos();
        this.obtenerUsuariosSinAsignar();
    },
    methods:{
        //Funcion para obtener los medicos
        viewTable() {
            this.view=1;
        },
        viewGird(){
            this.view=0;
        },
        obtenerMedicos(){
            console.log("Medicos");
            const promise = axios.get("/medicos/obtenermedicos/");         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.arrayMedicos = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
             
        },
        
        obtenerUsuarios() {
            console.log("usssssssss");
            const promise = axios.get("/medicos/obtenerusuarios");         
            promise
                .then((response) => {
                    console.log("users:"+response.data);
                    this.arrayUsuarios = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        
        obtenerUsuariosSinAsignar() {
            
            const promise = axios.get("/medicos/usuariossinasignar");         
            promise
                .then((response) => {
                    console.log("users:"+response.data);
                    this.arrayUsuarios = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        

        guardarMedico(){//Esta funcion crea un nuevo medico segun lo rellenado en el formualrio
            console.log("Medico alta:"+this.medicoEdit)
            const promise = axios.post("/medicos",this.medicoEdit);        
            promise
                .then((response) => {
                    this.obtenerMedicos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        actualizarMedico(){/* esta funcion es igual que la anterior como estamos modificando el objeto medicoEdit contiene el objeto medico para pasarselo
                                con las modificaciones que hemos realizado*/
            console.log("Acualizar medico");
            console.log("Obejto a actualizar"+this.medicoEdit.id);
            const promise = axios.put("/medicos/{id}"+this.medicoEdit.id,this.medicoEdit);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.obtenerMedicos(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });
        },
        cargarMedico(data){//Esta función rellena los campos y la variable update, con el medico que queremos modificar
            this.update=data.id;
            this.obtenerUsuarios();
            //Obtenemos el medico a modificar a partir del id, 
            //podriamos rellenarlo con los campos del arrayMedicos pero es mejor obtenerlos por si otro usuario ha cambiado los datos mientras nosotros tenimos la pantalla abierta
            const promise = axios.get("/medicos/buscar/"+this.update);         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.medicoEdit = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                    window.location.href = "/errors/"+error.response.status;
                });            
        },
        resetForm(){/*Limpia los campos e inicializa la variable update a 0*/
            this.medicoEdit={},
            this.update = 0;
        },
        onAvatarChange() {
            this.obtenerMedicos();
        },
        
    },
}
</script>

<style lang="scss" scoped>
@import "../../sass/variables";

.medicos { 
    display: flex;
    box-sizing: border-box;
    flex-wrap: wrap;
    gap:20px;
}

.tarjeta {
  display: grid;
  padding:0.5em;
  width: 320px;
  border: 1px solid #ccc;
  box-shadow: 7px 7px 15px #592A08; box-shadow: 7px 7px 15px #592A08; 
  background-color: rgb(255, 255, 255); 
  grid-template-columns: 100px 200px;
  grid-template-rows: 100px;
  gap: 20px 20px;
  grid-template-areas:
    "avatar info"; 
  &:hover{
      cursor: pointer;
  }
}
.avatar { grid-area: avatar; }
.info { grid-area: info}
    

</style>