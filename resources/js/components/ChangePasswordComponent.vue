<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cambio de contraseña primer inicio de sesión</div>
                <div class="card-body">  
                     
                  <div class="form-group">
                      <label>Contraseña antigua</label>                      
                      <input
                        type="password"
                        class="form-control"  
                        v-model="userEdit.oldPassword"  
                        :class="{
                            'is-invalid': $v.userEdit.oldPassword.$error
                        }"                
                      />
                      <div
                        v-if="!$v.userEdit.confirmPassword.required"
                        class="invalid-feedback"
                        >La antogia contraseña es obligatoria</div>                                     
                  </div>  
                  <div class="form-group">
                      <label>Nueva contraseña</label>                      
                      <input
                        type="password"
                        class="form-control"  
                        v-model="userEdit.newPassword"                   
                        :class="{
                            'is-invalid': $v.userEdit.newPassword.$error
                        }"
                      />     
                      <div
                        v-if="!$v.userEdit.newPassword.required"
                        class="invalid-feedback"
                        >La nueva contraseña es obligatoria</div>   
                    <div v-if="userEdit.newPassword && !$v.userEdit.newPassword.minLength" class="invalid-feedback">
                        La contraseña debe tener un mínimo de 6 caracteres
                    </div>                               
                  </div>  
                  <div class="form-group">
                      <label>Comfirmar contraseña</label>                      
                      <input
                        type="password"
                        class="form-control"  
                        v-model="userEdit.confirmPassword"                   
                        :class="{
                            'is-invalid': $v.userEdit.confirmPassword.$error
                        }"
                      />      
                      <div
                        v-if="!$v.userEdit.confirmPassword.required"
                        class="invalid-feedback"
                        >La confirmación de contraseñaa es obligatoria</div>
                    <div v-if="$v.userEdit.confirmPassword && !$v.userEdit.confirmPassword.sameAsPassword" class="invalid-feedback">
                        La contraseña y la contraseña de confirmación deben coincidir
                        </div>                              
                  </div>    
                  <div class="form-group" >                    
                      <button type="button" class="btn btn-dark" @click="updatePassword()">
                                    Guardar
                      </button>
                     <!-- <input type="password" class="form-control" v-model="usuarioEdit.password">-->
                  </div>                     
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
  required,
  email,
 maxValue,
  minLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);


export default {
    name: "changepassword-component",
     props:{
         usuario: { required: true, type: Object },
    },
     data(){
        return{
           
            userEdit:{
                oldPassword:"",
                newPassword:"",
                confirmPassword:"",
            }
        }
    },
    validations: {
        userEdit: {
            oldPassword: { required },
            newPassword: { required,minLength: minLength(6) },     
            confirmPassword: { required,sameAsPassword: sameAs('newPassword') },        
        },
    },
    serverValidation: {

    },
    methods:{
        updatePassword(){          
            //parar si el formulario es invalido
            this.$v.$touch();
            if (this.$v.$invalid) {
               return;
           }
            const promise=axios.put("/usuarios/updatepassword/"+this.usuario.id,this.userEdit);
            promise
                .then((response) => {
                    console.log("Datos de usuario:", response);                    
                    setTimeout(() => {
                        window.location.replace("/login");
                    }, 2000);
                    })
                    .catch((error) => {                  
                    //this.$v[oldPassword] && errors.push("La contraseña es incorrecta");
                    console.log("ERROR: " + error);
                    console.log("ERROR: " + error.response.status);
                    console.log("ERROR: " + error.response.statusText);
                    console.log("ERROR: " + error.response.data);
                    })
        }
    },
}
</script>

<style>

</style>
