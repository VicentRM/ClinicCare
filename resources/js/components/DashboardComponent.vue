<template>
<div>
  <div class="row">  
    <div class="col-xl-3 col-md-12">
          <usuario-component :user="c_user" :avatar="c_avatar"  @avatar-change="onAvatarChange"></usuario-component>
    </div>
    <div class="col-xl-9 col-md-12">
        <agenda-component></agenda-component> 
    </div>
</div> 
        
</div>
</template>

<script>
import UsuarioComponent from "./UsuarioComponent";
import AgendaComponent from "./AgendaComponent";
export default {
    name: "dashboard-component",
    components: {
        UsuarioComponent,
        AgendaComponent,
    },
props: {
    user: { required: true, type: Object },
    avatar: { required: true, type: String },
},

data: () => ({
    c_user: null,
    c_avatar: "",   
}),
created() {  
    this.c_user = this.user;
    if (!this.avatar) this.c_avatar = "";
    else this.c_avatar = this.avatar;
    
  
},
methods:{
    onAvatarChange(image) {
        console.log("Cambiar imagen");
      this.c_avatar = image;
    },
}




}

</script>

<style>

</style>