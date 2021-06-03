<template>

<div class="upload-image">
  <div class="avatar" >
    <div class="edit">Cambiar</div>
    <div class="avatar-img"> <img v-if="image" :src="image" /></div>
       <input
          type="file"
          :name="uploadFieldName"
          :disabled="isSaving"
          accept="image/*"
          class="input-file"
          @change="filesChange($event)"
        />
  </div>
</div>



</template>

<script>


import axios from "axios";

const STATUS_INITIAL = 0,
  STATUS_SAVING = 1,
  STATUS_SUCCESS = 2,
  STATUS_FAILED = 3;

export default {
  name: "UploadImageComponent", // que sea siempre compuesto con - para evitar colisiones con otros tag HTML5
  props: {
    image: { required: false, type: String, default: "/storage/avatars/avatarDefecto.jpg"},
    user: {required:true, type:Object},
  }, // imagen por defecto
  data: () => ({
    currentStatus: null,
    uploadFieldName: "avatar",
    avatar:"",
  }),
  computed: {
    isInitial() {
      return this.currentStatus === STATUS_INITIAL;
    },
    isSaving() {
      return this.currentStatus === STATUS_SAVING;
    },
    isSuccess() {
      return this.currentStatus === STATUS_SUCCESS;
    },
    isFailed() {
      return this.currentStatus === STATUS_FAILED;
    },
  },
  created() {
   this.reset();
  
    console.log("Avatar por defecto:", this.image);
  },
  mounted() {
    console.log("UploadImageComponent montado.");
  },
  /*watch: {  
        image: function (val) {
            // image sólo cambia si se elimina el avatar desde el padre
            this.imageToRender = val;
        }
    },*/
  methods: {
    reset() {
      // reset form to initial state
      this.currentStatus = STATUS_INITIAL;      
    },  
   
    upload(formData) {
      console.log("Upload");
      const promise = axios.post("/usuarios/upload/avatar/"+this.user.id, formData);

      promise
        .then((response) => {
          this.currentStatus = STATUS_SUCCESS;
          console.log(response);

          this.$emit("avatar-change", response.data.path);
          this.currentStatus = STATUS_INITIAL;
        })
        .catch((error) => {
          this.currentStatus = STATUS_FAILED;
          console.log("ERROR: " + error);
          window.location.href = "/errors/"+error.response.status;
        });
    
      return promise;
    },
    save(formData) {
      // subimos los datos al servidor
      this.currentStatus = STATUS_SAVING;
      this.upload(formData);
    },
    takeFile(ev) {
      return ev.target.files[0];
    },
    filesChange(ev) {

      const formData = new FormData();
      const file = this.takeFile(ev);

      if (!file) return;

      // se adjuntan los ficheros a formData
      //Array.from(Array(fileList.length).keys()).map((x) => {
      // formData.append(fieldName,fileList[x],FileList[x].name)
            //});
      console.log("Usuario a acttualizar avatar:"+this.user.id);
      formData.append(ev.target.name, file, file.name);
      formData.append('user',this.user);
      // se graba
      this.save(formData);
    
    },
  },
};
</script>

<style lang="scss" scoped>

.upload-image{
  box-sizing:border-box;
}
.avatar{
  font-family: 'Lato', sans-serif;
  width: 100px;
  height: 100px;
  display:block;
  border-radius: 50%;
  overflow:hidden;
  position:relative;
  border: 2px solid #e9ecec91;
  transition: border .15s ease-in;
 
  &:hover {
     border: 2px solid #e9ecec91;
     cursor: pointer;
    .edit {
      padding-top: 10px;
      height: 40px;
    }
  } 
 
  .avatar-img,.edit{
    position:absolute;
  };
  
  img{
   width:100%;
   height: 100%;
   object-fit: cover;
  }
  
  .edit{
   width:100%;
   height: 0px;
   z-index:1;
   bottom:0;
   font-weight: bold;
   color:white;
   background-color: rgba(10, 175, 241, 0.781);
   transition: all 1s;
   padding-top: 0px;
    text-align: center;
  }
  .input-file {
  opacity: 0; 
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  cursor: pointer;
}

} 



</style>
