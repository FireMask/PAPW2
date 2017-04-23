<template>
    <div class="">
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
                        <i class="fa fa-arrow-left"></i> Volver
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

                            <strong><i class="fa fa-bar-chart margin-r-5"></i> Estadisticas</strong>
                            <canvas id="estadisticas">grafica de ventas y cotizaciones</canvas>
                            <div class="row" style="text-align: center; margin-top: 30px;">
                                <div class="col-md-6">
                                    <strong><i class="fa fa-line-chart margin-r-5"></i> Progreso mensual</strong>
                                    <div id="progresoMensual"></div>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fa fa-dashboard margin-r-5"></i> Porcentaje de exito en ventas</strong>
                                    <div id="PorcentajeExito"></div>
                                </div>
                                <div class="col-md-12" id="total" style="margin-top: 30px; margin-bottom: 30px; font-size: 30px;">
                                    <strong><i class="fa fa-cubes margin-r-5"></i> Ventas totales</strong>
                                    <p class="badge bg-green" style="font-size: 30px; padding: 10px 20px;">{{ ventasTotales }}</p>
                                </div>
                            </div>

                            <hr>

                            <strong><i class="fa fa-users margin-r-5"></i> Clientes</strong>
                            <div class="content">
                                <view-cliente v-for="cliente in clientes" :cliente="cliente"></view-cliente>
                            </div>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
var Chart = require('chartjs');
var ProgressBar = require('progressbar');
var store = require('./../../../store/store.js');
export default {
    data () {
        return {
            showModal: false,
            clientes: [],
            ventas: [],
            cotizaciones: [],
            progresoMensual: 0,
            promedioMensual: 0,
            ventasTotales: 0
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
            this.$emit('editar');
        },
        borrar: function() {
            this.showModal = false;
            var data = {
                _method: 'DELETE'
            };
            this.$http.post('/usuario/' + this.usuario.idUsuario, data).then(response => {
                this.cerrar();
            });
        },
        getColor: function(value) {
            //value from 0 to 1
            var hue=((value)*120).toString(10);
            return ["hsl(",hue,",70%,50%)"].join("");
        },
        loadData: function () {
            this.$http.get('/usuario/' + this.usuario.idUsuario).then(response => {
                this.clientes = response.body.clientes;
                this.ventas = response.body.ventas;
                this.cotizaciones = response.body.cotizaciones;
                this.progresoMensual = response.body.progresoMensual;
                this.promedioMensual = response.body.promedioMensual;
                this.ventasTotales = response.body.ventasTotales;
                this.crearChart();
            });
        },
        crearChartProgreso: function() {
            var self = this;
            var progressBar = new ProgressBar.Circle('#progresoMensual', {
                strokeWidth: 8,
                color: '#3a3a3a',
                svgStyle: {
                    display: 'block',
                    height: '150px',
                    position: 'absolute',
                    left: '50%',
                    top: '50%',
                    padding: '0px',
                    margin: '0px',
                    transform: 'translate(-50%, -50%)'
                },
                trailColor: 'rgb(170, 170, 170)',
                trailWidth: 5,
                text: {
                    value: 'Text',
                    className: 'progressbar__label',
                    style: {
                        color: 'rgb(170, 170, 170)',
                        position: 'absolute',
                        left: '50%',
                        top: '50%',
                        padding: 0,
                        margin: 0,
                        'font-size': '20px',
                        fontFamily: '"Raleway", Helvetica, sans-serif',
                        transform: {
                            prefix: true,
                            value: 'translate(-50%, -50%)'
                        }
                    },
                    autoStyleContainer: true,
                    alignToBottom: true
                },
                duration: 1200,
                easing: 'easeOut',
                step: function(state, circle, attachment) {
                    var value = Math.round(circle.value() * 100);
                    circle.setText(value + '%');
                    circle.path.setAttribute('stroke', self.getColor(circle.value()));
                }
            });
            progressBar.animate(this.progresoMensual / 100);
        },
        crearChartPorcentajeExito: function() {
            var self = this;
            var progressBar = new ProgressBar.Circle('#PorcentajeExito', {
                strokeWidth: 8,
                color: '#3a3a3a',
                svgStyle: {
                    display: 'block',
                    height: '150px',
                    position: 'absolute',
                    left: '50%',
                    top: '50%',
                    padding: '0px',
                    margin: '0px',
                    transform: 'translate(-50%, -50%)'
                },
                trailColor: 'rgb(170, 170, 170)',
                trailWidth: 5,
                text: {
                    value: 'Text',
                    className: 'progressbar__label',
                    style: {
                        color: 'rgb(170, 170, 170)',
                        position: 'absolute',
                        left: '50%',
                        top: '50%',
                        padding: 0,
                        margin: 0,
                        'font-size': '20px',
                        fontFamily: '"Raleway", Helvetica, sans-serif',
                        transform: {
                            prefix: true,
                            value: 'translate(-50%, -50%)'
                        }
                    },
                    autoStyleContainer: true,
                    alignToBottom: true
                },
                duration: 1200,
                easing: 'easeOut',
                step: function(state, circle, attachment) {
                    var value = Math.round(circle.value() * 100);
                    circle.setText(value + '%');
                    circle.path.setAttribute('stroke', self.getColor(circle.value()));
                }
            });
            progressBar.animate(this.promedioMensual / 100);
        },
        crearChartVentas: function() {
            var ctx = document.getElementById("estadisticas");
            var meses = new Array(6);
            var ventas = [];
            var cotizaciones = [];
            var nombresMeses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            var ultimoMes = this.ventas[0] != null ? this.ventas[0].mes  - 1 : (function() { var d = new Date(); return d.getMonth() }());
            for (var i = 0; i < 6; i++) {
                if (ultimoMes < 0) {
                    meses[i] = nombresMeses[12 + ultimoMes];
                } else {
                    meses[i] = nombresMeses[ultimoMes];
                }
                ventas[i] = this.ventas[i] != null ? this.ventas[i].ventas : 0;
                cotizaciones[i] = this.cotizaciones[i] != null ? this.cotizaciones[i].cotizaciones : 0;
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
        },
        crearChart: function() {
            this.crearChartVentas();
            this.crearChartProgreso();
            this.crearChartPorcentajeExito();
        }
    },
    mounted: function() {
        this.loadData();
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
</style>
