<template>
  <div>

    <calendario-component @dateClick="dateClick" @clickEvento="clickEvento" :nuevoEventoCalendario="nuevoEventoCalendario"></calendario-component>
    <modalcalendario-component v-show="showModal" :form="nuevoEvento" @guardarEvento="guardarEvento"></modalcalendario-component>
  </div>
</template>

<script>
import CalendarioComponent from "./CalendarioComponent";
import ModalCalendarioComponent from "./ModalCalendarioComponent.vue";
import moment from 'moment';
export default {
  name: "agenda-component",
  components: {
    CalendarioComponent,
    ModalCalendarioComponent
  },
  data:() => ({    
      showModal:false,
      nuevoEventoCalendario:false,     
      nuevoEvento: {       
        pacientes: null,
        tipos_visita:null,
        motivos_visita:null,
        fecha: "",
        hora: "",  
        duracion: 1800,      
        paciente_id:0,    
        tipo_visita_id:0,
        motivo_visita_id:0
      
    }
  }),
  methods: {
    dateClick(arg) {
      this.showModal = true;
      this.abrirModalNuevoEvento(arg);
      console.log("recibiendo datos:", arg);

      $("#calendarModal").modal();
    },
    clickEvento(eventInfo){
      
      this.$data.showModal = true;
       
      this.abrirModalEditarEvento(eventInfo);
      $("#calendarModal").modal();
    },
    mostrarModal() {
      $("#calendarModal").modal();
    },
  
    abrirModalNuevoEvento(obj) {
    
      const dateAndTime = obj.dateStr.split("T");
     // this.nuevoEvento.fecha = moment(dateAndTime[0]).format('DD/MM/YYYY');
       this.nuevoEvento.fecha = dateAndTime[0];
      this.nuevoEvento.hora = dateAndTime[1].substr(0, 8);
    
  
      //obtenemos los pacientes del medico para pasarselos al modal
      const promise = axios.get("/datosModalEvento");
        promise
          .then((response) => {
            console.log("Pacientes:", response.data.pacientes); 
            console.log("Tipos:", response.data.motivos);              
            console.log("Motivos:", response.data.tipos);              
            this.nuevoEvento.pacientes= response.data.pacientes;
            this.nuevoEvento.tipos_visita= response.data.tipos;
            this.nuevoEvento.motivos_visita= response.data.motivos;
          })
          .catch((error) => {
            console.log("ERROR: " + error);
          });
      return;
    },
    abrirModalEditarEvento(obj) {
        console.log(obj);

  
      //obtenemos los pacientes del medico para pasarselos al modal
      const promise = axios.get("/datosModalEvento");
        promise
          .then((response) => {
                        
            this.nuevoEvento.pacientes= response.data.pacientes;
            this.nuevoEvento.tipos_visita= response.data.tipos;
            this.nuevoEvento.motivos_visita= response.data.motivos;
          })
          .catch((error) => {
            console.log("ERROR: " + error);
          });
      return;
    },
    guardarEvento(evento){
        console.log(evento);
        let dateAppt= this.setEvento(evento);
        console.log(dateAppt);     
        //Aqui deberiamos de pasar los datos por ajax al controlador de visita para crear la visita       
        const promise = axios.post("/calendario",dateAppt);
        promise
        .then((response) => {
          console.log("Evento creado", response);   
          this.nuevoEventoCalendario=!this.nuevoEventoCalendario;  
          this.showModal = false; 
        })
        .catch((error) => {
          console.log("ERROR: " + error);    
        });
    },
    setEvento (form){
        let fechaHora= form.fecha+" "+form.hora;
      //console.log(fechaHora);
        let initSesion=new Date(fechaHora);
        let obtenerSegundosCita=initSesion.getSeconds() + form.duracion;
        initSesion.setSeconds(obtenerSegundosCita);
        let fechaFinFormat=moment(initSesion);
        fechaFinFormat=fechaFinFormat.format('YYYY-MM-DD HH:mm:ss'); 
        return {
            id:form.id,          
            inicio: fechaHora,
            fin: fechaFinFormat,
            duracion: form.duracion,     
            paciente_id:form.paciente_id,
            tipo_visita_id:form.tipo_visita_id,
            motivo_visita_id:form.motivo_visita_id
        }
    }
  }
};
</script>

<style>
</style>