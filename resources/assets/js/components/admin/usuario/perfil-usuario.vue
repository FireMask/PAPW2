<template>
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
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="http://davidreyes.tk/img/views/me2.jpg" alt="User profile picture">

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
                        <p class="text-muted"> pendiente </p>

                        <hr>

                        <strong><i class="fa fa-users margin-r-5"></i> Clientes</strong>
                        <ul>
                            <li v-for="cliente in clientes">{{ cliente.nombre_comercial }}</li>
                        </ul>
                        <hr>

                        <strong><i class="fa fa-bar-chart margin-r-5"></i> Estadisticas</strong>
                        <canvas id="estadisticas">grafica de ventas</canvas>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
var Chart = require('chartjs');
export default {
    data () {
        return {
            showModal: false,
            clientes: []
        };
    },
    props: ['usuario'],
    computed: {
        fechaContratacion: function() {
            var fecha = this.usuario.created_at;
            fecha = fecha.split(' ');
            return fecha[0];
        }
    },
    methods: {
        editar: function() {
            this.showModal = false;
        },
        borrar: function() {
            this.showModal = false;
        },
        loadData: function () {
            $.get('/api/usuarios/' + this.usuario.idUsuario + '/clientes', function (response) {
                this.clientes = response.clientes;
            }.bind(this));
        },
        crearChart: function() {
            var ctx = document.getElementById("estadisticas");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [
                        {
                            type: 'line',
                            label: 'Ventas',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: "rgba(0,166,90,0.2)",
                            borderColor: "rgba(0,166,90,1)"
                        },
                        {
                            type: 'line',
                            label: 'Cotizaciones',
                            data: [5, 16, 10, 50, 20, 30],
                            backgroundColor: "rgba(0,192,240,0.2)",
                            borderColor: "rgba(0,192,240,1)"
                        }
                    ]
                }
            });
        }
    },
    created: function() {
        this.loadData();
    },
    mounted: function() {
        this.crearChart();
    },
    beforeUpdate: function() {
        this.loadData();
    }
};
</script>

<style>
    #estadisticas {
        width: 100%;
        height: 300px;
    }
</style>
