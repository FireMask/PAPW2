<template>
    <div class="vista-producto">
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{ producto.modelo }}</h2>
                    <h4>{{ producto.codigo }}</h4>
                    <h4>{{ producto.fabricante.nombre }}</h4>
                </div>
                <div class="col-md-8">
                    <p class="col-md-4"><strong><i class="fa fa-truck margin-r-5"></i>Proveedor</strong></p>
                    <p class="col-md-8">{{ producto.proveedor.nombre }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-money margin-r-5"></i>Precio</strong></p>
                    <p class="col-md-8">${{ producto.precio | dinero }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-book margin-r-5"></i>Descripcion</strong></p>
                    <p class="col-md-8">{{ producto.descripcion }}</p>
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
            },
            dinero: function(value) {
                var numero = parseInt(value);
                numero = numero.toFixed(2);
                return numero;
            }
        },
        props: ['producto']
    };
</script>

<style>
    .vista-producto {
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
    .vista-producto:hover {
        background: rgb(230,230,230);
        border-left-color: darkgreen;
    }
    .vista-producto .content {
        min-height: 10px;
    }
</style>
