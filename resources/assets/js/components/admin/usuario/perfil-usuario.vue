<template>
    <transition name="fade">
        <section class="content">
            <modal v-if="showModal">
                <h3 slot="header">Confirmar</h3>
                <h4 slot="body">¿Dar de baja?</h4>
                <div slot="footer">
                    <div class="row">
                        <div class="col-xs-6">
                            <button class="btn btn-primary btn-block" v-on:click="showModal = false">
                                Cancelar
                            </button>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn btn-danger btn-block" v-on:click="borrar()">
                                Aceptar
                            </button>
                        </div>
                    </div>
                </div>
            </modal>

            <div class="row">
                <div class="col-md-2 col-offset-10 cerrar">
                    <a class="btn btn-default" href="#" v-on:click="cerrar()">
                        <i class="fa fa-close"></i> Cerrar
                    </a>
                </div>
                <br>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" :src="profileImagePath" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ usuario.nombres + ' ' + usuario.apellido_paterno + ' ' + usuario.apellido_materno }}</h3>

                            <p class="text-muted text-center">{{ usuario.rol.nombre }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Fecha de contratación</b> <p class="pull-right text-muted">{{ fechaContratacion }}</p>
                                </li>
                            </ul>

                            <a v-on:click="editar();" class="btn btn-primary btn-block">
                                <i class="fa fa-edit margin-r-5"></i>
                                <b>Editar</b>
                            </a>
                            <a v-on:click="showModal = true" class="btn btn-danger btn-block">
                                <i class="fa fa-close margin-r-5"></i>
                                <b>Eliminar</b>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Perfil</h3>
                        </div>
                        <div class="box-body">
                            <strong><i class="fa fa-envelope margin-r-5"></i> Correo</strong>
                            <p class="text-muted"> {{ usuario.correo_usuario }} </p>

                            <hr>

                            <strong><i class="fa fa-calendar margin-r-5"></i> Fecha de nacimiento</strong>
                            <p class="text-muted"> {{ usuario.fecha_nacimiento }} </p>

                            <hr>

                            <strong><i class="fa fa-users margin-r-5"></i> Clientes</strong>
                            <ul>
                                <li v-for="cliente in usuario.clientes">{{ cliente.nombre_comercial }}</li>
                            </ul>
                            <hr>

                            <strong><i class="fa fa-bar-chart margin-r-5"></i> Estadisticas</strong>
                            <canvas id="estadisticas">grafica de ventas y cotizaciones</canvas>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </transition>
</template>

<script>
var Chart = require('chartjs');
export default {
    data () {
        return {
            showModal: false,
            clientes: [],
            ventas: [],
            cotizaciones: []
        };
    },
    props: ['usuario'],
    computed: {
        fechaContratacion: function() {
            var fecha = this.usuario.created_at;
            fecha = fecha.split(' ');
            return fecha[0];
        },
        profileImagePath: function() {
            return '/storage/' + this.usuario.imagen_perfil;
        },
    },
    watch: {
        usuario: function() {
            this.crearChart();
        }
    },
    methods: {
        cerrar: function() {
            this.$emit('cerrar');
        },
        editar: function() {
            this.showModal = false;
        },
        borrar: function() {
            this.showModal = false;
        },
        loadData: function () {
            this.$http.get('/api/usuarios/' + this.usuario.idUsuario + '/clientes').then(response => {
                this.clientes = response.body.clientes;
            });
            this.$http.get('/api/usuarios/' + this.usuario.idUsuario + '/ventas').then(response => {
                this.ventas = response.body.ventas;
                this.crearChart();
            });
            this.$http.get('/api/usuarios/' + this.usuario.idUsuario + '/cotizaciones').then(response => {
                this.cotizaciones = response.body.cotizaciones;
                this.crearChart();
            });
        },
        crearChart: function() {
            var ctx = document.getElementById("estadisticas");
            var meses = new Array(6);
            var ventas = [];
            var cotizaciones = [];
            var nombresMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            var ultimoMes = this.usuario.ventas[0] != null ? this.usuario.ventas[0].mes  - 1 : (function() { var d = new Date(); return d.getMonth() }());
            for (var i = 0; i < 6; i++) {
                if (ultimoMes < 0) {
                    meses[i] = nombresMeses[12 + ultimoMes];
                } else {
                    meses[i] = nombresMeses[ultimoMes];
                }
                ventas[i] = this.usuario.ventas[i] != null ? this.usuario.ventas[i].ventas : 0;
                cotizaciones[i] = this.usuario.cotizaciones[i] != null ? this.usuario.cotizaciones[i].cotizaciones : 0;
                ultimoMes--;
            }
            meses.reverse();
            ventas.reverse();
            cotizaciones.reverse();
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [
                        {
                            type: 'line',
                            label: 'Ventas',
                            data: ventas,
                            backgroundColor: "rgba(0,166,90,0.2)",
                            borderColor: "rgba(0,166,90,1)"
                        },
                        {
                            type: 'line',
                            label: 'Cotizaciones',
                            data: cotizaciones,
                            backgroundColor: "rgba(0,192,240,0.2)",
                            borderColor: "rgba(0,192,240,1)"
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                stepSize: 1
                            }
                        }]
                    }
                }
            });
        }
    },
    mounted: function() {
        this.crearChart();
    }
};
</script>

<style>
    #estadisticas {
        width: 100%;
        height: 300px;
    }
    .cerrar {
        margin-bottom: 15px;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>
