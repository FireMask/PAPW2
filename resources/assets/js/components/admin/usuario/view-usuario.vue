<template>
    <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-primary">
            <div class="widget-user-image">
                <img class="img-circle" src="http://davidreyes.tk/img/views/me2.jpg" alt="User Avatar">
            </div>
            <h3 class="widget-user-username">{{ data.nombres + ' ' + data.apellido_paterno + ' ' + data.apellido_materno }}</h3>
            <h5 class="widget-user-desc">{{ data.rol.nombre }}</h5>
        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <li><a href="#">Ventas promedio mensuales<span class="pull-right badge bg-blue">{{ estadisticas.promedioMensual }}</span></a></li>
                <li><a href="#">Ventas del mes <span class="pull-right badge bg-aqua">{{ estadisticas.ventasDelMes }}</span></a></li>
                <li><a href="#">Ventas totales <span class="pull-right badge bg-green">{{ estadisticas.ventasTotales }}</span></a></li>
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
            $.get('/api/usuarios/' + this.data.idUsuario + '/estadisticas', function (response) {
                this.estadisticas = response;
            }.bind(this));
        }
    },
    mounted: function() {
        this.loadData();
    },
    beforeUpdate: function() {
        this.loadData();
    }
};
</script>

<style>

</style>
