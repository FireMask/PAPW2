<template>
    <div class="content" id="pantallaInicio">
        <div id="pantallaInicio" class="row" >
            
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
