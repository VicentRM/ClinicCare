<template>
  <div>
    <FullCalendar :options="calendarOptions" ref="fullCalendar"/>
    {{texto}}
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
      texto:"",
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, timeGrid],
        events: "",
        initialView: "timeGridWeek",
        firstDay: 1,
        locale: "es",
        headerToolbar: {
          left: "prev,next,today",
          //center:"title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        height: "auto",
        allDaySlot: false,
        //horario inicio y fin
        slotMinTime: "09:00:00",
        slotMaxTime: "15:00:00",
        dateClick: this.dateClick,
        dayHeaders:true,
        buttonText: {
          today: "hoy",
          month: "mes",
          week: "semana",
          day: "dia",
          list: "lista",
        },
        eventClick: this.clickEvento,
        dayHeaderFormat: {
           weekday: 'short', month: 'numeric', day: 'numeric', omitCommas: true
        },
        views: {       
            day: {
                  titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
            }
        }

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
    //Detectamos ancho de pantalla y inicializamos opcion de vista calendario segun ancho
    if (window.innerWidth < 800) {
      this.calendarOptions.initialView="timeGridDay";
    }
    //activara myEventHandler cuando se cambie el tamaño de pantalla
    window.addEventListener("resize", this.myEventHandler);
    
  },
  destroyed() {
    window.removeEventListener("resize", this.myEventHandler);
  },
  methods: {
    //Detectamos ancho de pantalla y segun mostramos el calendario en dia o semana
    myEventHandler(e) {  
      if (window.innerWidth < 800) {    
          this.$refs.fullCalendar.getApi().changeView('timeGridDay');
      }else{
          this.$refs.fullCalendar.getApi().changeView('timeGridWeek');
      }  
  },
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
          window.location.href = "/errors/"+error.response.status;
        });
    },
  },
};
</script>

<style>
</style>