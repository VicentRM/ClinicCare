<template>
  <div>
    <h3>Usuarios</h3>    
    <div class="row">
      <div class="col-xl-8 col-md-12">  
        <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
          
                  </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in arrayUsuarios" :key="usuario.id">
              <td>{{ usuario.id }}</td>
              <td @click="cargarUsuario(usuario)">{{ usuario.name }}</td>
              <td>{{ usuario.email }}</td>
                 
            </tr>     
          </tbody>
        </table>
        </div>
      </div>
      <div class="col-xl-4 col-md-12">    
                <div class="form-group d-flex justify-content-center" >                      
                      <upload-image-component
                        :image="usuarioEdit.avatar"
                        :user="usuarioEdit"
                        @avatar-change="onAvatarChange"
                      />        
                  </div>  
                  <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" v-model="usuarioEdit.name">                    
                  </div>
                  <div class="form-group">
                      <label>email</label>
                      <input type="text" class="form-control" v-model="usuarioEdit.email">                    
                  </div>     
                  <div class="form-group">
                      <label>Rol</label>
                      <select class="form-control" v-model="usuarioEdit.role_id">              
                          <option v-for="role in arrayRoles" :key="role.id" :value="role.id">
                              {{role.nombre_rol}}
                          </option>
                      </select>                                      
                  </div> 
                  <div class="form-group" v-if="update != 0">                    
                      <button type="button" class="btn btn-dark" @click="resetPassword()">
                                    Restablecer contraseña
                      </button>
                     <!-- <input type="password" class="form-control" v-model="usuarioEdit.password">-->
                  </div>
                              
                  <div class="container-buttons">
                      <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
                      <button v-if="update == 0" @click="guardarUsuario()" class="btn btn-success">Añadir</button>
                      <!-- Botón que modifica el medico que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                      <button v-if="update != 0" @click="actualizarUsuario()" class="btn btn-warning">Actualizar</button>
                      <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                      <button v-if="update != 0" @click="resetForm()" class="btn">Atrás</button>
                  </div>              
          </div>
      </div>
  </div>
</template>

<script>
import UsuarioComponent from "./UsuarioComponent";
import { required } from "vuelidate/lib/validators";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
export default {
    name: "usuarios-component",
    components: {
        UsuarioComponent,        
    },
    props:{
     
    },
    data(){
        return{
            arrayUsuarios:[],
            arrayRoles:[],         
            usuarioEdit:{},
             update:0, /*Esta variable contrarolará cuando es un nuevo usuario o una modificación, si es 0 significará que no hemos seleccionado
                          ningun medico, pero si es diferente de 0 entonces tendrá el id del medico y no mostrará el boton guardar sino el modificar*/
            enviar: false,
            //avatar:"",
            avatarMiniatura:"",
          
        }
    },
    validations: {
        usuarioEdit: {
           
        },
    },
    created(){
        this.obtenerusuarios();
        this.obtenerroles();
   
        
    },
    computed:{
        avatar() {
            return this.avatarMiniatura;
        }
    },
    methods:{
        onAvatarChange(image) {
        console.log("Cambiar imagen");
        this.usuarioEdit.avatar= image;
    },
        obtenerAvatar(e){
            let file=e.target.files[0];
            console.log("Foto:"+file);
            this.usuarioEdit.avatar=file;
            this.cargarAvatar(file);
        },
        cargarAvatar(file){
            let reader = new FileReader();
            reader.onload= (e) => {
                this.avatarMiniatura = e.target.result;
            }
            reader.readAsDataURL(file);
        },
        //Funcion para obtener los usuario
        obtenerusuarios(){
            console.log("usuarios");
            const promise = axios.get("/usuarios/obtenerusuarios/");         
            promise
                .then((response) => {
                    console.log(response.data);
                    this.arrayUsuarios = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });
             
        },     
        obtenerroles(){
            console.log("Roles");
            const promise = axios.get("/usuarios/obtenerroles/");         
            promise
                .then((response) => {
                    console.log("Roles;"+response.data);
                    this.arrayRoles = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });
             
        },     
     
        guardarUsuario(){//Esta funcion crea un nuevo medico segun lo rellenado en el formualrio
            this.enviar = true;
            //parar si el formulario es invalido
            this.$v.$touch();
            if (this.$v.$invalid) {
               return;
           }
            console.log("Usuario nuevo");
            let formData= new FormData();
            for (let key in this.usuarioEdit) {
                
                if(key=="avatar"){
                    formData.append(key,this.usuarioEdit.avatar);
                    console.log(key+":"+this.usuarioEdit.avatar);
                }else{
                    formData.append(key,this.usuarioEdit[key]);
                    console.log(key+":"+this.usuarioEdit[key]);
                }
            }   
            const promise = axios.post("/usuarios",formData);         
            promise
                .then((response) => {
                    this.obtenerusuarios(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });
        },
        actualizarUsuario(){
            console.log("Usuario a acutlizar"+this.usuarioEdit.role_id)
            let formData= new FormData();
            for (let key in this.usuarioEdit) {
                
                if(key=="avatar"){
                    formData.append(key,this.usuarioEdit.avatar);
                    console.log(key+":"+this.usuarioEdit.avatar);
                }else{
                    formData.append(key,this.usuarioEdit[key]);
                    console.log(key+":"+this.usuarioEdit[key]);
                }
            }   
            formData.append("_method", "put");     
            console.log(formData);
          //Laravel no acepta el envio por put del mutliplatform data, tenemos que usar post añadiendo como metodo PUT.
            formData.append('_method', 'PUT');
            const promise =axios.post('/usuarios/'+this.usuarioEdit.id , formData );
            promise
                .then((response) => {
                    console.log(response.data);
                    this.obtenerusuarios(); //llamamos al metodo obtenerMedicos para que refresque nuestro arrayy
                    this.resetForm(); //Limìamos los campos e inicializamos la variable update a 0

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });
        },
        cargarUsuario(data){
            this.update=data.id;
       
            const promise = axios.get("/usuarios/buscar/"+this.update);         
            promise
                .then((response) => {
                    console.log("Usuario:"+response.data);
                    this.usuarioEdit = response.data;                    
                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });            
        },
        borrarUsuario(data){
           
            if (confirm('¿Seguro que deseas borrar este usuario?')) {
                    const promise = axios.delete("/usuarios/" + data.id);
                    promise
                      .then((response) => {       
                        this.obtenerusuarios();
                      })
                      .catch((error) => {
                        console.log("ERROR: " + error.message);         
                      });
                }
      
        },
        resetPassword(){
             let formData= new FormData();
                 formData.append("email",this.usuarioEdit.email);
            const promise = axios.post("/forgot-password",formData);     
            

            promise
                .then((response) => {
                    console.log(response);

                })
                .catch((error) => {
                    console.log("ERROR: " + error);
                });
        },
        resetForm(){/*Limpia los campos e inicializa la variable update a 0*/
            this.usuarioEdit={},
            this.update = 0;
            this.enviar=false;
        },

        
    },
}
</script>


<style lang="scss" scoped>



.grid-container{
  display: grid;  
  grid-auto-flow: column;
  grid-auto-columns: 115px;
  column-gap: 20px;
}
.cardPartida{
  width: 115px;
  height: 115px;  
  border-radius: 10%; 
  font-weight: 800;  
  position: relative;
  overflow: hidden;
  z-index: 1;
  cursor: pointer; 
  .cardTop{
    width: 110px;
    height: 35px;
    margin: 5px;  
  }
  .cardAvatar{
    width: 35px; 
   
    margin-right:6px; 
    float:left; 
    .imgAvatar{                  
      img{     
        width: 35px;
        height: 35px;
        border-radius: 50%;   
      }
    }
  }
  .cardInfo{
    width: 57px;  
    text-align: center;   
    float: left;
    white-space: nowrap;
    text-overflow:".";
    overflow: hidden;
    span.name {  
       font-size: 12px;
      display: block;   
    }
    span.score{   
       font-size: 14px;
      display: block;    
    }    
  }
  .cardTime{
    height: 24px;
    text-align: center;
    
  }
  .botonera{
     height: 20px;
      button{
            background-color: black;          
            font-size: 12px;
            color: white;
            border-radius: 50%;
            padding: 2px 4px;
            text-align: center;
            border: 0px solid transparent;
            display:block; 
            float:right;
            margin-right: 6px;   
            cursor: pointer;                 
          }
      span.idioma{
        float:left;
        margin-left:6px;
      
      }
  }
  
  .cardTurno{
    position:absolute;
    width: 100%;
    height: 20px;    
    bottom:0px;
    right:0px;    
    background-color: #9e9b9b;
    text-align: center; 
    span.turno{
      display: block;  
      color:white
      ;
    }
  }

}

@keyframes shine {
    to {
      background-position: 200% center;
    }
  }

</style>