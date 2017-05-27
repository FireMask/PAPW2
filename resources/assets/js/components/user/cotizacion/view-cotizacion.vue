<template>
    <div class="vista-cliente" :class="estado" >
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{ cotizacion.cliente.nombre_comercial }}</h2>
                    <h4>{{ cotizacion.created_at | fecha }}</h4>
                    <h4>{{ estado }}</h4>
                </div>
                <div class="col-md-8">
                    <p class="col-md-4"><strong><i class="fa fa-money margin-r-5"></i>Monto</strong></p>
                    <p class="col-md-8">{{ montoTotal }} {{ cotizacion.moneda.simbolo }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-calendar margin-r-5"></i>Fecha limite</strong></p>
                    <p class="col-md-8">{{ fechaLimite }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-credit-card margin-r-5"></i>Tipo de pago</strong></p>
                    <p class="col-md-8">{{ cotizacion.pago }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-user margin-r-5"></i>Vendedor</strong></p>
                    <p class="col-md-8">{{ cotizacion.usuario.nombres }} {{ cotizacion.usuario.apellido_paterno }} {{ cotizacion.usuario.apellido_materno }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {

            };
        },
        filters: {
            fecha: function(value) {
                if (!value) return '';
                var fecha = value.split(' ');
                return fecha[0];
            }
        },
        computed: {
            estado: function() {
                return this.cotizacion.finalizada == 1 ? 'finalizada' : (this.cotizacion.aprobada == 1 ? 'Aprobada' : 'Pendiente');
            },
            montoTotal: function() {
                var total = this.cotizacion.total;
                total.toFixed(this.cotizacion.moneda.presicion);
                total = total.toString();
                var parts = total.split(".");
                parts[0] = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, this.cotizacion.moneda.separador_millares);
                total = parts.join(this.cotizacion.moneda.separador_decimales);
                return total;
            },
            fechaLimite: function() {
                var fecha = this.cotizacion.created_at;
                fecha = fecha.split(' ')[0];
                fecha = fecha.split('-');
                var date = new Date();
                date.setFullYear(fecha[0], fecha[1], fecha[2]);
                date.setDate(date.getDate() + parseInt(this.cotizacion.validez));
                var finalDate = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                return finalDate;
            }
        },
        props: ['cotizacion']
    };
</script>

<style>
    .vista-cliente {
        border-radius: 5px;
        border-left-style: solid;
        border-left-width: 10px;
        margin-bottom: 15px;
        min-height: 10px;
        -webkit-box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
        background: rgb(250,250,250);
    }
    .vista-cliente:hover {
        background: rgb(230,230,230);
    }
    .vista-cliente .content {
        min-height: 100px;
    }
    .aprovada {
        border-left-color: green;
    }
    .aprovada:hover {
        border-left-color: darkgreen;
    }
    .pendiente {
        border-left-color: red;
    }
    .pendiente:hover {
        border-left-color: darkred;
    }
    .finalizada {
        border-left-color: steelblue;
    }
    .finalizada:hover {
        border-left-color: #386991;
    }
</style>
