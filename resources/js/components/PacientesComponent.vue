<template>
    <h1>Hola</h1>
</template>

<script>

    import axios from "axios";
    export default {
  name: "pacientes-component",
  components: {
  
  },
  props: {
   
  },
  data: () => ({
      c_pacientes: null,
   
  }),
  created() {
    
  },

  mounted() {    
    this.pacientes(); 
  },
  methods: {
       pacientes() {
         console.log("hola");         

      this.c_pacientes = null; 
      let url='/pacientes2'

      const promise = axios.get(url);
       console.log("hola"); 
      promise
        .then((response) => {      
          console.log("Pacientes del medico:", response.data);
          this.c_pacientes = response.data;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
  },
  computed:{
    
  },
};
</script>
