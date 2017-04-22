<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cotizacion #{{ cotizacion.idCotizacion }}</h3>
        </div>
        <div class="box-body">
            <strong><i class="fa fa-user margin-r-5"></i> Vendedor</strong>
            <p class="text-muted">
                {{ cotizacion.usuario.nombres + ' ' + cotizacion.usuario.apellido_paterno + ' ' + cotizacion.usuario.apellido_materno }}
            </p>

            <hr>

            <div class="content-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fa fa-users margin-r-5"></i> Cliente</strong>
                        <p class="text-muted">{{ cotizacion.cliente.nombre_comercial }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <strong><i class="fa fa-tag margin-r-5"></i> Estado</strong>
                            <p class="text-muted"><span :class="claseEstado(cotizacion)">{{ estado(cotizacion) }}</span></p>
                        </div>
                        <div class="col-md-12">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Fecha de expedicion</strong>
                            <p class="text-muted">{{ cotizacion.created_at }}</p>
                        </div>
                        <div class="col-md-12">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> Vigencia</strong>
                            <p class="text-muted">{{ cotizacion.validez }} dias</p>
                        </div>
                        <div class="col-md-12">
                            <strong><i class="fa fa-credit-card margin-r-5"></i> Tipo de pago</strong>
                            <p class="text-muted">{{ cotizacion.pago }}</p>
                        </div>
                        <div class="col-md-12">
                            <strong><i class="fa fa-money margin-r-5"></i> Moneda</strong>
                            <p class="text-muted">{{ cotizacion.moneda.simbolo }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <strong><i class="fa fa-shopping-basket margin-r-5"></i> Detalle</strong>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Codigo</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Iva</th>
                        </tr>
                        <tr v-for="producto in productos">
                            <td>{{ producto.codigo }}</td>
                            <td>{{ producto.modelo }}</td>
                            <td>{{ parseCurrency(producto.precio) }}</td>
                            <td>{{ parseCurrency(producto.precioIva) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td><span class="badge bg-blue">{{ total }}</span></td>
                            <td><span class="badge bg-green">{{ totalConIva }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="footer">
                <a v-if="estado(cotizacion) == 'Pendiente'" v-on:click="aprovar()" class="btn btn-primary btn-lg">Aprovar</a>
                <a v-on:click="cerrar()" class="btn btn-danger btn-lg">Cancelar</a>
            </div>
        </div>
    </div>
</template>

<script>
    var store = require('./../../../store/store.js');
    export default {
        data: function() {
            return {
                productos: []
            }
        },
        props: ['cotizacion'],
        computed: {
            total: function() {
                var total = 0;
                for (var i = 0; i < this.productos.length; i++) {
                    total += parseFloat(this.productos[i].precio);
                }
                return this.parseCurrency(total);
            },
            totalConIva: function() {
                var total = 0;
                for (var i = 0; i < this.productos.length; i++) {
                    total += parseFloat(this.productos[i].precioIva);
                }
                return this.parseCurrency(total);
            }
        },
        methods: {
            loadData: function() {
                this.$http.get('/api/cotizaciones/' + this.cotizacion.idCotizacion).then(response => {
                    this.productos = response.body;
                });
            },
            parseCurrency: function(value) {
                var total = parseFloat(value);
                total.toFixed(this.cotizacion.moneda.presicion);
                total = total.toString();
                var parts = total.split(".");
                parts[0] = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, this.cotizacion.moneda.separador_millares);
                total = parts.join(this.cotizacion.moneda.separador_decimales);
                return total;
            },
            estado: function(cotizacion) {
                return cotizacion.finalizada == 1 ? 'Finalizada' : (cotizacion.aprobada == 1 ? 'Aprobada' : 'Pendiente')
            },
            claseEstado: function(cotizacion) {
                var estado = this.estado(cotizacion);
                switch (estado) {
                    case 'Finalizada': {
                        return 'badge bg-blue';
                        break;
                    }
                    case 'Aprobada': {
                        return 'badge bg-green';
                        break;
                    }
                    case 'Pendiente': {
                        return 'badge bg-red';
                        break;
                    }
                }
            },
            cerrar: function() {
                this.$emit('cerrar');
            },
            aprovar: function() {
                var path = '/cotizacion/' + this.cotizacion.idCotizacion;
                let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('_token', store.state.globales.token);
                formData.append('idCotizacion', this.cotizacion.idCotizacion);
                formData.append('aprobada', 1);
                this.$http.post(path, formData).then(response => {
                    if(response.ok){
                       this.$emit('cerrar');
                    }
                });
            }
        },
        mounted: function() {
            this.loadData();
        }
    }
</script>

<style>

</style>
