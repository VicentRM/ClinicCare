<template>
  <div>
    <h2>Documentos</h2>
    <div>
      <table class="table table-sm table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Documento</th>
            <th scope="col">Subido</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="documento in c_documentos" :key="documento.id">
            <td @click="abrirdocumento(documento.id,documento.url)">{{documento.descripcion}}</td>

            <td>{{ documento.updated_at | formatFecha }} {{ documento.updated_at | formatHora }}</td>
            <td>
              <button type="button" class="btn btn-danger btn-sm">
                <i class="fa fa-trash" aria-hidden="true" @click="eliminardocumento(documento.id)"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      
      <vue-dropzone
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        @vdropzone-complete="afterUploadComplete"
        @vdropzone-sending-multiple="sendMessage"
      ></vue-dropzone>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  name: "documentos-component",
  components: {
    vueDropzone: vue2Dropzone,
  },
  props: {
    idvinculo: { required: true, type: Number },
    vinculo_doc: { required: true, type: String },
  },
  data: () => ({
    dropzoneOptions: {
      url: "http://webclinic.project/subirdocumentos",
      thumbnailWidth: 150,
      maxFilesize: 10,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      parallelUploads: 3,
      maxFiles: 3,
      uploadMultiple: true,
      dictDefaultMessage: "Arrastra los documentos aquí para subirlos",
    },
    c_documentos: [],
  }),
  filters: {
    formatFecha: function (value) {
      if (!value) return "";
      let fecha = moment(value);
      fecha = fecha.format("DD-MM-YYYY");
      return fecha;
    },
    formatHora: function (value) {
      if (!value) return "";
      let hora = moment(value);
      hora = hora.format("HH:mm");
      return hora;
    },
  },
  created() {    

    
    this.obtenerdocumentos();
  },
  watch: {
    //Realizamos un watch sobre el prop idvinculo para que si en el componente padre cambia este vinculo se actualizen los documentos.
    idvinculo: function () {
      this.obtenerdocumentos();
    },
  },
  methods: {
    obtenerdocumentos() {
      console.log("Obteniendo documentos....")
      let formData = new FormData();
      formData.append("id", this.idvinculo);
      formData.append("vinculo_doc", this.vinculo_doc);

      const promise = axios.post("/obtenerdocumentos", formData);
      promise
        .then((response) => {
          console.log(response.data);
          this.c_documentos = response.data;
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
          window.location.href = "/errors/"+error.response.status;
        });
    },
    abrirdocumento(id, descripcionDocumento) {
      const promise = axios.get("/abrirdocumento/" + id);
      promise
        .then((response) => {
          console.log(response);
          var fileURL = window.URL.createObjectURL(new Blob([response.data]));
          console.log(fileURL);
          var fileLink = document.createElement("a");
          fileLink.href = fileURL;
          fileLink.setAttribute("download", descripcionDocumento);
          document.body.appendChild(fileLink);
          fileLink.click();
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
          window.location.href = "/errors/"+error.response.status;
        });
    },
    eliminardocumento(id) {
      const promise = axios.delete("/eliminardocumento/" + id);
      promise
        .then((response) => {
          console.log(response);
          this.obtenerdocumentos();
        })
        .catch((error) => {
          console.log("ERROR: " + error.message);
          window.location.href = "/errors/"+error.response.status;
        });
    },

    afterUploadComplete: async function (response) {
      console.log("2");
      if (response.status == "success") {
        console.log("upload successful");
        this.obtenerdocumentos();
      } else {
        console.log("upload failed");
      }
    },
    sendMessage: async function (files, xhr, formData) {
      console.log("1");
      formData.append("id", this.idvinculo);
      formData.append("vinculo_doc", this.vinculo_doc);
    },
  },
};
</script>

<style>
</style>