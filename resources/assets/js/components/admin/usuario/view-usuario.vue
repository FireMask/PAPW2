<template>
    <div class="box box-widget widget-user-2">
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
    methods: {
        loadData: function () {
            this.$http.get('/api/usuarios/' + this.data.idUsuario + '/estadisticas').then(response => {
                this.estadisticas = response.body;
            });
        }
    },
    computed: {
        profileImagePath: function() {
            return '/storage/' + this.data.imagen_perfil;
        },
    },
    mounted: function() {
        // this.loadData();
    }
};
</script>

<style>
    .widget-user-username {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        height: 30px;
    }
</style>
