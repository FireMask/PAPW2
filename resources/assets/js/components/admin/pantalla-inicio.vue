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
                <!-- <div class="row"> -->
                    <div class="box box-default box-add-edit">
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-red">
                                    10 Feb. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-aqua"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-green">
                                    3 Jan. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                <!-- </div> -->
            </div>

            <div class="col-md-4" id="notificaciones">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                            <span class="label label-danger">UI Design</span>
                            <span class="label label-success">Coding</span>
                            <span class="label label-info">Javascript</span>
                            <span class="label label-warning">PHP</span>
                            <span class="label label-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
                datos: {}
            };
        },
        computed: {

        },
        methods: {
            loadData: function() {
                this.$http.get('/api/inicio/').then(response => {
                    this.datos = response.body;
                    this.crearCharts();
                });
            },
            getColor: function(value){
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
    #ventas-cotizaciones {
        /*position: absolute;
        top: 50%;
        transform: translateY(-50%);*/
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
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>
