<template>
    <div class="vista-fabricante">
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <h4 style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ fabricante.nombre }}
                    </h4>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="fa fa-calendar margin-r-5"></i>Fecha de registro</strong></p>
                    <p>{{ fabricante.created_at | fecha }}</p>
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
        props: ['fabricante']
    };
</script>

<style>
    .vista-fabricante {
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
    .vista-fabricante:hover {
        background: rgb(230,230,230);
        border-left-color: darkgreen;
    }
    .vista-fabricante .content {
        min-height: 10px;
    }
</style>
