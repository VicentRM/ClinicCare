<template>
  <div>
    <FullCalendar :options="calendarOptions" />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGrid from "@fullcalendar/timegrid";
export default {
  name: "calendario-component",
  components: {
    FullCalendar,
  },

  props: {
    nuevoEventoCalendario: { required: false, type: Boolean },

  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, timeGrid],
        events: "",
        initialView: "timeGridWeek",
        firstDay: 1,
        locale: "es",
        headerToolbar: {
          left: "prev,next,today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        height: "auto",
        allDaySlot: false,
        //horario inicio y fin
        slotMinTime: "09:00:00",
        slotMaxTime: "15:00:00",
        dateClick: this.dateClick,
        buttonText: {
          today: "hoy",
          month: "mes",
          week: "semana",
          day: "dia",
          list: "lista",
        },
        eventClick: this.clickEvento,
      },
      datosEvento: {
        event_name: "",
        start_date: "",
        end_date: "",
      },
    };
  },
  watch: {
    nuevoEventoCalendario: function () {
      this.obtenerEventos();
    },
  },
  created() {
    this.obtenerEventos();
  
  },

  methods: {
    dateClick(clickInfo) {
      this.$emit("dateClick", clickInfo);
    },
    clickEvento(clickInfo) {
      this.$emit("clickEvento", clickInfo);
    },
    obtenerEventos() {
      const promise = axios.get("/calendario");
      promise
        .then((response) => {
          this.$data.calendarOptions.events = response.data;
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