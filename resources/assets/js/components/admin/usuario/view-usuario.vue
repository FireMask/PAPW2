<template>
    <!-- <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-primary">
            <div class="widget-user-image">
                <img class="img-circle" :src="profileImagePath" alt="User Avatar">
            </div>
            <h3 class="widget-user-username">{{ data.nombres + ' ' + data.apellido_paterno + ' ' + data.apellido_materno }}</h3>
            <h5 class="widget-user-desc">{{ data.rol.nombre }}</h5>
        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <li><a href="#">Ventas promedio mensuales<span class="pull-right badge bg-blue">{{ data.estadisticas.promedioMensual }}</span></a></li>
                <li><a href="#">Ventas del mes <span class="pull-right badge bg-aqua">{{ data.estadisticas.ventasDelMes }}</span></a></li>
                <li><a href="#">Ventas totales <span class="pull-right badge bg-green">{{ data.estadisticas.ventasTotales }}</span></a></li>
            </ul>
        </div>
    </div> -->
    <div class="vista-usuario">
        <div class="content">
            <div class="row">
                <div class="col-md-2">
                    <div class="widget-user-image">
                        <img class="img-circle" :src="profileImagePath" alt="User Avatar">
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="widget-user-username">{{ data.nombres + ' ' + data.apellido_paterno + ' ' + data.apellido_materno }}</h2>
                    <h4>{{ data.rol.nombre }}</h4>
                </div>
                <div class="col-md-6">
                    <p class="col-md-5"><strong><i class="fa fa-envelope margin-r-5"></i>Correo</strong></p>
                    <p class="col-md-7">{{ data.correo_usuario }}</p>
                    <p class="col-md-5"><strong><i class="fa fa-calendar margin-r-5"></i>Fecha de nacimiento</strong></p>
                    <p class="col-md-7">{{ data.fecha_nacimiento }}</p>
                    <p class="col-md-5"><strong><i class="fa fa-calendar-check-o margin-r-5"></i>Fecha de registro</strong></p>
                    <p class="col-md-7">{{ data.created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            estadisticas: {
                ventasTotales: 0,
                promedioMensual: 0,
                ventasDelMes: 0
            }
        };
    },
    props: ['data'],
    computed: {
        profileImagePath: function() {
            return '/storage/' + this.data.imagen_perfil;
        },
    }
};
</script>

<style>
    .widget-user-username {
        margin-top: 15px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        height: 33px;
    }
    .vista-usuario {
        border-radius: 5px;
        border-left-color: green;
        border-left-style: solid;
        border-left-width: 10px;
        margin-bottom: 15px;
        min-height: 10px;
        -webkit-box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
        background: rgb(250,250,250);
    }
    @media screen and (max-width: 700px) {
        .vista-usuario h2, .vista-usuario h4 {
            text-align: center;
        }
    }
    .vista-usuario img {
        height: 90px;
        display: block;
        margin: 0 auto;
    }
    .vista-usuario:hover {
        background: rgb(230,230,230);
        border-left-color: darkgreen;
    }
    .vista-usuario .content {
        min-height: 100px;
    }
</style>
