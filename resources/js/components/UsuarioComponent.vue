<template>
  <div class="usuario">    
      <div class="avatar">
        <upload-image-component
          :image="avatar"
          :user="user"
          @avatar-change="onAvatarChange"
        />
      </div>
         <div class="info">
           <p>{{ user.medico.apellidos }},{{ user.medico.nombre }}</p>
           <p>NºColegiado: {{ user.medico.num_colegiado }}</p>
          </div>        
  </div>
  
</template>

<script>
import UploadImageComponent from "./UploadImageComponent";


export default {
  name: "usuario-component",
  components: {
    UploadImageComponent,   
  },
  props: {
    user: { required: true, type: Object },
    avatar: { required: true, type: String },   
  },
  data: () => ({
    
  }),  
  watch: {
      validacionAct(newValue, oldValue) {    
          this.showAlert=true;    
      }
  },
  mounted() {
    console.log("UsuarioComponent montado.");
    console.log("Usuario medico:"+this.user.medico.nombre);
  },
  methods: {
    onAvatarChange(image) {
      this.$emit("avatar-change", image);
    },
    activaFormsEdit: function (event) {
      this.modificarNick = !this.modificarNick;
      this.modificarPassword = !this.modificarPassword;
      this.cambiarIdioma = !this.cambiarIdioma;
    },
    borrarCuentaAlert(){
      var mensaje;
      var opcion = confirm("Estas seguro/a de borrar la cuenta?");
        if (opcion == true) {
            this.$emit('borrar-cuenta');
      } else {   
      }
    },
    ocultaAlert(){
        this.showAlert=false;
    },  
    cambiaNick(){
        this.$emit('modifica-nick', this.nick);
        
    },
    cambiaPassword(){
        this.$emit('modifica-password', this.oldPassword, this.password, this.passwordConfirm);
      
    },
    cambiaIdioma(){
      this.$emit('cambiar-idioma', this.idiomaPreferido);
   
    },
 
  },
};
</script>

<!-- el estilo lo implemento en scss -->
<!-- además, para ganar en reusabilidad y evitar conflictos, hago que las clases
     sólo tengan validez en el componente -->
<style lang="scss" scoped>
@import "../../sass/variables";
.usuario {
  display: grid;
  width: 200px;
  grid-template-columns:1fr;
  grid-template-rows: 0.5fr 1fr;
  gap: 20px 0px;
  border: 1px solid #ccc;
  box-shadow: 7px 7px 15px #592A08; box-shadow: 7px 7px 15px #592A08;
  grid-template-areas:
    "avatar"
    "info";
}
.avatar { 
  grid-area: avatar;   
  justify-self: center;
}
.info { 
  grid-area: info; 
   justify-self: center;
  }
</style>

