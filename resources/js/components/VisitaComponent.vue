<template>
    <div>
        <nav>
            <h2>
                Visita del paciente: {{ c_visita.paciente.apellidos }},
                {{ c_visita.paciente.nombre }}
            </h2>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a
                    class="nav-link active"
                    id="nav-general-tab"
                    data-toggle="tab"
                    href="#nav-general"
                    role="tab"
                    aria-controls="nav-general"
                    aria-selected="true"
                    >General</a
                >
                <a
                    class="nav-link"
                    id="nav-datos-tab"
                    data-toggle="tab"
                    href="#nav-datos"
                    role="tab"
                    aria-controls="nav-datos"
                    aria-selected="false"
                    >Datos Visita</a
                >
                <a
                    class="nav-link"
                    id="nav-documentos-tab"
                    data-toggle="tab"
                    href="#nav-documentos"
                    role="tab"
                    aria-controls="nav-documentos"
                    aria-selected="false"
                    >Documentos</a
                >
                <a
                    class="nav-link"
                    id="nav-pruebasmedicas-tab"
                    data-toggle="tab"
                    href="#nav-pruebasmedicas"
                    role="tab"
                    aria-controls="nav-pruebasmedicas"
                    aria-selected="false"
                    >Pruebas médicas</a
                >
            </div>
        </nav>
        <div class="row justify-content-center">
            <div class="col-12">
                <form
                    method="post"
                    accept-charset="UTF-8"
                    enctype="multipart/form-data"
                    @submit.prevent="actualizarVisita"
                >
                    <div class="tab-content" id="nav-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="nav-general"
                            role="tabpanel"
                            aria-labelledby="nav-geenral-tab"
                        >
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label
                                                    for="fecha"
                                                    class="form-label"
                                                    >Fecha</label
                                                >
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="fecha"
                                                    name="fecha"
                                                    v-model="fecha"
                                                    disabled
                                                />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label
                                                    for="hora"
                                                    class="form-label"
                                                    >Hora</label
                                                >
                                                <input
                                                    type="time"
                                                    class="form-control"
                                                    id="hora"
                                                    name="hora"
                                                    v-model="hora"
                                                    disabled
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="tipoVisita"
                                            class="form-label"
                                            >Tipo Visita</label
                                        >
                                        <select
                                            class="form-control"
                                            id="tipo_visita_id"
                                            name="tipo_visita_id"
                                            v-model="c_visita.tipo_visita_id"
                                        >
                                            <option
                                                v-for="tipo in tiposvisita"
                                                :key="tipo.id"
                                                :value="tipo.id"
                                                >{{ tipo.descripcion }}</option
                                            >
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="motivoVisita"
                                            class="form-label"
                                            >Motivo Visita</label
                                        >
                                        <select
                                            class="form-control"
                                            id="motivo_visita_id"
                                            name="motivo_visita_id"
                                            v-model="c_visita.motivo_visita_id"
                                        >
                                            <option
                                                v-for="motivo in motivosvisita"
                                                :key="motivo.id"
                                                :value="motivo.id"
                                                >{{
                                                    motivo.descripcion
                                                }}</option
                                            >
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="comentarios"
                                            class="form-label"
                                            >Comentarios</label
                                        >
                                        <textarea
                                            class="form-control"
                                            rows="4"
                                            name="comentarios"
                                            id="comentarios"
                                            v-model="c_visita.comentarios"
                                        ></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="observaciones"
                                            class="form-label"
                                            >Observaciones</label
                                        >
                                        <textarea
                                            class="form-control"
                                            rows="4"
                                            name="observaciones"
                                            id="observaciones"
                                            v-model="c_visita.observaciones"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark">
                                Guardar cambios
                            </button>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-datos"
                            role="tabpanel"
                            aria-labelledby="nav-datos-tab"
                        >
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label
                                                    for="anamnsesis"
                                                    class="form-label"
                                                    >Anamnsesis</label
                                                >
                                                <textarea
                                                    class="form-control"
                                                    rows="4"
                                                    name="anamnesis"
                                                    id="anamnsesis"
                                                    v-model="c_visita.anamnesis"
                                                ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label
                                                for="exploracion"
                                                class="form-label"
                                                >Exploracion</label
                                            >
                                            <textarea
                                                class="form-control"
                                                rows="4"
                                                name="exploracion"
                                                id="anamnsesis"
                                                v-model="c_visita.exploracion"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label for="peso" class="form-label"
                                                >Peso</label
                                            >
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="peso"
                                                name="peso"
                                                v-model="c_visita.peso"
                                                @change="calculoBMI()"
                                            />
                                        </div>
                                        <div class="col-3">
                                            <label
                                                for="altura"
                                                class="form-label"
                                                >Altura</label
                                            >
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="altura"
                                                name="altura"
                                                step="any"
                                                v-model="c_visita.altura"
                                                @change="calculoBMI()"
                                            />
                                        </div>
                                        <div class="col-3">
                                            <label for="IMC" class="form-label"
                                                >IMC</label
                                            >
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="IMC"
                                                name="IMC"
                                                v-model="c_visita.IMC"
                                                disabled
                                            />
                                        </div>
                                        <div class="col-3">
                                            <label
                                                for="tension_arterial"
                                                class="form-label"
                                                >Tension Arterial</label
                                            >
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="tension_arterial"
                                                name="tension_arterial"
                                                v-model="
                                                    c_visita.tension_arterial
                                                "
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="evolucion"
                                            class="form-label"
                                            >Evolcion</label
                                        >
                                        <textarea
                                            class="form-control"
                                            rows="6"
                                            name="evolucion"
                                            id="evolucion"
                                            v-model="c_visita.evolucion"
                                        ></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="tratamiento"
                                            class="form-label"
                                            >Tratamiento</label
                                        >
                                        <textarea
                                            class="form-control"
                                            rows="6"
                                            name="tratamiento"
                                            id="tratamiento"
                                            v-model="c_visita.tratamiento"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark">
                                Guardar cambios
                            </button>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-documentos"
                            role="tabpanel"
                            aria-labelledby="nav-documentos-tab">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <documentos-component
                                        :idvinculo="c_visita.id"
                                        :vinculo_doc="'visita_id'"
                                    ></documentos-component>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-pruebasmedicas"
                            role="tabpanel"
                            aria-labelledby="nav-prueasmedicas-tab">                            
                                    <pruebasmedicas-component
                                        :visita="c_visita"                                                                                
                                    ></pruebasmedicas-component>                               
                        </div>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    name: "visita-component",
    props: {
        visita: { required: true, type: Array },
        tiposvisita: { required: true, type: Array },
        motivosvisita: { required: true, type: Array }
    },
    data: () => ({
        c_visita: {},
        fecha: null,
        hora: null
    }),
    created() {
        this.c_visita = this.visita[0];
        this.fecha = moment(this.c_visita.calendario.inicio).format(
            "YYYY-MM-DD"
        );
        this.hora = moment(this.c_visita.calendario.inicio).format("HH:mm");
        console.log(this.c_visita);
        console.log(this.fecha);
    },
    filters: {
        formatFecha: function(value) {
            if (!value) return "";
            let fecha = moment(value);
            fecha = fecha.format("DD-MM-YYYY");
            return fecha;
        },
        formatHora: function(value) {
            if (!value) return "";
            let hora = moment(value);
            hora = hora.format("HH:mm");
            return hora;
        }
    },
    methods: {
        actualizarVisita() {
            console.log(this.c_visita);

            const promise = axios.put(
                "/visitas/" + this.c_visita.id,
                this.c_visita
            );
            promise
                .then(response => {
                    // console.log(response.data);
                    //  window.location.href = "/pacientes";
                })
                .catch(error => {
                    console.log("ERROR: " + error.message);
                });
        },
        calculoBMI() {
            let peso = this.c_visita.peso;
            let altura = this.c_visita.altura;
            if (
                peso === null ||
                peso == "" ||
                altura === null ||
                altura == ""
            ) {
                this.c_visita.IMC = 0;
            } else {
                let imc = Math.round(peso / (altura * altura), 2);
                this.c_visita.IMC = imc;
            }
        }
    }
};
</script>

<style></style>
