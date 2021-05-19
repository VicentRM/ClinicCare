<template>
  <div>
    <h3>Calendario</h3>
    <calendario-component
      @dateClick="dateClick"
      @clickEvento="clickEvento"
      :nuevoEventoCalendario="nuevoEventoCalendario"
    ></calendario-component>
    <modalcalendario-component
      v-show="showModal"
      :form="evento"
      @guardarEvento="guardarEvento"
      @abrirvisita="abrirvisita"
      @eliminarevento="eliminarEvento"
    ></modalcalendario-component>
  </div>
</template>

<script>
import CalendarioComponent from "./CalendarioComponent";
import ModalCalendarioComponent from "./ModalCalendarioComponent.vue";
import moment from "moment";
import { bus } from "../app";
export default {
  name: "agenda-component",
  components: {
    CalendarioComponent,
    ModalCalendarioComponent,
  },
  props: {
    paciente_id_prop: { required: false, type: Number },
  },
  data: () => ({
    showModal: false,
    nuevoEventoCalendario: false,
    modoAñadir: true,
    event_id: 0,
    visita_id: 0,
    evento: {
      pacientes: [],
      tipos_visita: null,
      motivos_visita: null,
      fecha: "",
      hora: "",
      duracion: 1800,
      paciente_id: null,
      tipo_visita_id: null,
      motivo_visita_id: null,
    },
  }),
  created() {
    console.log("Paciente:" + this.paciente_id_prop);
    if (this.paciente_id_prop != null) {
      this.evento.paciente_id = this.paciente_id_prop;
      console.log("asignado");
    }
  },
  methods: {
    dateClick(arg) {
      this.modoAñadir = true;
      this.showModal = true;
      this.abrirModalNuevoEvento(arg);
      console.log("recibiendo datos:", arg);
      $("#calendarModal").modal();
    },
    clickEvento(arg) {
      //Datos para apertur modal
      this.modoAñadir = false;
      const promise = axios.get("/datosModalEvento");
      promise
        .then((response) => {
          this.evento.pacientes = response.data.pacientes;
          this.evento.tipos_visita = response.data.tipos;
          this.evento.motivos_visita = response.data.motivos;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
      //Datos del evento/visita para dejarlos cargados en modal
      this.event_id = arg.event.id;
      console.log(this.event_id);
      const promise2 = axios.get("/visitas/visitaCalendario/" + this.event_id);
      promise2
        .then((response) => {
          let visita = {};
          visita = response.data.visita[0];
          const dateAndTime = visita.calendario.inicio.split(" ");
          this.visita_id = visita.id;
          this.evento.fecha = dateAndTime[0];
          this.evento.hora = dateAndTime[1].substr(0, 8);
          this.evento.paciente_id = visita.paciente_id;
          this.evento.tipo_visita_id = visita.tipo_visita_id;
          this.evento.motivo_visita_id = visita.motivo_visita_id;
          this.evento.duracion = visita.calendario.duracion;
          $("#calendarModal").modal();
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
      //this.$data.showModal = true;
      // $("#calendarModal").modal();
    },
    mostrarModal() {
      $("#calendarModal").modal();
    },
    abrirModalNuevoEvento(obj) {
      const dateAndTime = obj.dateStr.split("T");
      this.evento.fecha = dateAndTime[0];
      this.evento.hora = dateAndTime[1].substr(0, 8);
      const promise = axios.get("/datosModalEvento");
      promise
        .then((response) => {
          this.evento.pacientes = response.data.pacientes;
          this.evento.tipos_visita = response.data.tipos;
          this.evento.motivos_visita = response.data.motivos;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
      return;
    },
    abrirModalEditarEvento(obj) {
      console.log(obj);
      return;
    },
    guardarEvento(evento) {
      if (this.modoAñadir) {
        this.nuevoEvento(evento);
      } else {
        this.actualizarEvento(evento);
      }
    },
    nuevoEvento(evento) {
      let dateAppt = this.setEvento(evento);
      const promise = axios.post("/calendario", dateAppt);
      promise
        .then((response) => {
          console.log("Evento creado", response);
          this.nuevoEventoCalendario = !this.nuevoEventoCalendario;
          this.showModal = false;
          this.evento.paciente_id = null;
          this.evento.tipo_visita_id = null;
          this.evento.motivo_visita_id = null;
          bus.$emit("actualizarvisitas"); // 2.Emitting
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
    actualizarEvento(evento) {
      let dateAppt = this.setEvento(evento);
      console.log(dateAppt);
      const promise = axios.put("/calendario/" + this.event_id, dateAppt);
      promise
        .then((response) => {
          console.log("Evento actualizado", response);
          this.nuevoEventoCalendario = !this.nuevoEventoCalendario;
          this.showModal = false;
          this.event_id = 0;
          this.evento.paciente_id = null;
          this.evento.tipo_visita_id = null;
          this.evento.motivo_visita_id = null;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
    setEvento(form) {
      let fechaHora = form.fecha + "T" + form.hora;
      //console.log(fechaHora);
      let initSesion = new Date(fechaHora);
      let obtenerSegundosCita = initSesion.getSeconds() + form.duracion;
      initSesion.setSeconds(obtenerSegundosCita);
      let fechaFinFormat = moment(initSesion);
      fechaFinFormat = fechaFinFormat.format("YYYY-MM-DD HH:mm:ss");
      return {
        id: form.id,
        inicio: fechaHora,
        fin: fechaFinFormat,
        duracion: form.duracion,
        paciente_id: form.paciente_id,
        tipo_visita_id: form.tipo_visita_id,
        motivo_visita_id: form.motivo_visita_id,
      };
    },
    abrirvisita() {
      const promise = axios.get("/visitas/" + this.visita_id + "/edit");
      promise
        .then((response) => {
          console.log("Acceso a visita confirmado", response.statusText);
          let url =
            location.protocol +
            "//" +
            location.hostname +
            (location.port ? ":" + location.port : "");
          window.location.href = "/visitas/" + this.visita_id + "/edit";
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
    eliminarEvento() {
      const promise = axios.delete("/calendario/" + this.event_id);
      promise
        .then((response) => {
          console.log("Evento eliminado", response.statusText);
          this.nuevoEventoCalendario = !this.nuevoEventoCalendario;
          bus.$emit("actualizarvisitas"); // 2.Emitting
          this.event_id = 0;
          this.evento.paciente_id = null;
          this.evento.tipo_visita_id = null;
          this.evento.motivo_visita_id = null;
        })
        .catch((error) => {
          console.log("ERROR: " + error);
        });
    },
  },
};
</script>

<style>
</style>