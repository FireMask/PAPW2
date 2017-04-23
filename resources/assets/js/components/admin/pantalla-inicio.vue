<template>
    <div class="content" id="pantallaInicio">
        <div id="pantallaInicio" class="row" >
            <div id="estadisticasEmpresa">
                <div class="row">
                    <div class="col-md-7">
                        <div class="col-md-6">
                            <div id="progresoMensual"></div>
                            <strong><i class="fa fa-line-chart margin-r-5"></i> Progreso mensual</strong>
                        </div>
                        <div class="col-md-6">
                            <div id="PorcentajeExito"></div>
                            <strong><i class="fa fa-dashboard margin-r-5"></i> Porcentaje de exito en ventas</strong>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <canvas id="ventas-cotizaciones">grafica de ventas y cotizaciones</canvas>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="col-md-8" id="historico">
                <div class="timeline-title">
                    <p>Actividad reciente</p>
                </div>
                <div class="box box-default box-add-edit">
                    <ul class="timeline timeline-inverse">
                        <template v-for="fecha in fechas">
                            <li :id="fecha.fecha | fecha" class="time-label">
                                <span class="bg-blue">
                                    {{ fecha.fecha | fecha }}
                                </span>
                            </li>
                            <template v-for="actividad in fecha.eventos">
                                <li>
                                    <i :class="getClass(actividad.evento)"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            {{ actividad.fecha | hora }}
                                        </span>
                                        <h3 class="timeline-header">
                                            <a href="#">{{ actividad.responsable }}</a>
                                            {{ actividad.evento }}
                                        </h3>
                                        <div class="timeline-body">
                                            {{ actividad.descripcion }}
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </template>
                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4" id="notificaciones">
                <div class="">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vendedores destacados</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div v-for="vendedor in datos.mejoresVendedores" class="vendedor row">
                            <div class="col-xs-4" style="height: 100%;">
                                <img class="img-circle" :src="'/storage/' + vendedor.imagen_perfil" alt="imagen de perfil">
                            </div>
                            <div class="col-xs-8">
                                <div class="col-md-12">
                                    <strong><i class="fa fa-user margin-r-5"></i> Nombre</strong>
                                    <p class="text-muted">{{ vendedor.nombres + ' ' + vendedor.apellido_paterno + ' ' + vendedor.apellido_materno }}</p>
                                </div>
                                <div class="col-md-12">
                                    <strong><i class="fa fa-pie-chart margin-r-5"></i> Promedio de ventas</strong>
                                    <span class="label label-success">{{ vendedor.promedio }}%</span>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var Chart = require('chartjs');
    var ProgressBar = require('progressbar');
    export default {
        data: function() {
            return {
                datos: {},
                fechas: []
            };
        },
        computed: { },
        filters: {
            fecha: function(value) {
                if (!value) return '';
                var fecha = value.split(' ');
                return fecha[0];
            },
            hora: function(value) {
                if (!value) return '';
                var fecha = value.split(' ');
                return fecha[1];
            }
        },
        methods: {
            loadData: function() {
                this.$http.get('/inicio/').then(response => {
                    this.datos = response.body;
                    this.ordenarFechas();
                    this.crearCharts();
                });
            },
            ordenarFechas: function() {
                var contador = 0;
                this.fechas[contador] = {
                    fecha: this.datos.actividadReciente[0].fecha,
                    eventos: []
                };
                for (var i = 0; i < this.datos.actividadReciente.length; i++) {
                    if (this.fechas[contador].fecha.split(' ')[0] != this.datos.actividadReciente[i].fecha.split(' ')[0]) {
                        contador++;
                        this.fechas[contador] = {
                            fecha: this.datos.actividadReciente[i].fecha,
                            eventos: []
                        };
                    }
                    this.fechas[contador].eventos.unshift(this.datos.actividadReciente[i]);
                }
            },
            getClass: function(value) {
                switch (value) {
                    case 'nuevo cliente': {
                        return 'fa fa-users bg-green'
                        break;
                    }
                    case 'nuevo usuario': {
                        return 'fa fa-user bg-green'
                        break;
                    }
                    case 'nueva cotizacion': {
                        return 'fa fa-file-text bg-green'
                        break;
                    }
                    case 'venta finalizada': {
                        return 'fa fa-file-text bg-red'
                        break;
                    }
                    case 'cotizacion aprobada': {
                        return 'fa fa-file-text bg-yellow'
                        break;
                    }
                }
            },
            getColor: function(value) {
                //value from 0 to 1
                var hue=((value)*120).toString(10);
                return ["hsl(",hue,",70%,50%)"].join("");
            },
            crearChartVentasCotizaciones: function() {
                var ctx = document.getElementById("ventas-cotizaciones");
                var meses = new Array(6);
                var ventas = [];
                var cotizaciones = [];
                var nombresMeses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                var ultimoMes = this.datos.ventas[0] != null ? this.datos.ventas[0].mes  - 1 : (function() { var d = new Date(); return d.getMonth() }());
                for (var i = 0; i < 6; i++) {
                    if (ultimoMes < 0) {
                        meses[i] = nombresMeses[12 + ultimoMes];
                    } else {
                        meses[i] = nombresMeses[ultimoMes];
                    }
                    ventas[i] = this.datos.ventas[i] != null ? this.datos.ventas[i].ventas : 0;
                    cotizaciones[i] = this.datos.cotizaciones[i] != null ? this.datos.cotizaciones[i].cotizaciones : 0;
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
                        legend: {
                            fontColor: "rgba(170,170,170,1)",
                            labels: {
                                fontColor: "rgba(170,170,170,1)"
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    stepSize: 200,
                                    fontColor: "rgba(170,170,170,1)"
                                },
                                gridLines:{
                                    color:"rgba(170,170,170,1)",
                                    zeroLineColor:"rgba(170,170,170,1)"
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: "rgba(170,170,170,1)"
                                },
                                gridLines:{
                                    color:"rgba(170,170,170,1)",
                                    zeroLineColor:"rgba(170,170,170,1)"
                                }
                            }]
                        }
                    }
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
                progressBar.animate(this.datos.progresoMensual / 100);
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
                progressBar.animate(this.datos.porcentajeExito / 100);
            },
            crearCharts: function() {
                this.crearChartVentasCotizaciones();
                this.crearChartPorcentajeExito();
                this.crearChartProgreso();
            }
        },
        mounted: function() {
            this.loadData();
        }
    }
</script>

<style>
    @media screen and (max-width: 700px) {
        #pantallaInicio div.box-add-edit{
            padding: 0;
        }
    }
    #estadisticasEmpresa {
        min-height: 230px;
        background: rgb(70,90,110);
        margin-bottom: 30px;
        color: rgba(170,170,170,1);
    }
    #estadisticasEmpresa strong {
        display: block;
        text-align: center;
    }
    #estadisticasEmpresa > div > div{
        margin: 20px 0;
    }
    #progresoMensual, #PorcentajeExito {
        height: 200px;
    }
    #historico .timeline-title {
        height: 40px;
        background: cornflowerblue;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        color: white;
    }
    #historico .timeline-title p {
        font-size: 20px;
        padding: 5px 0;
        text-align: center;
    }
    #historico .box {
        border-top: none;
        height: 500px;
        overflow-y: scroll;
    }
    #notificaciones .vendedor {
        height: 140px;
        margin-bottom: 20px;
        padding: 15px 10px;
    }
    #notificaciones .vendedor img {
        height: 90px;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    #notificaciones hr {
        margin-top: 33px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>
