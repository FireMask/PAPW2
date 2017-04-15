<template>
    <div class="vista-moneda">
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{ moneda.nombre }}</h2>
                    <h4>{{ moneda.simbolo }}</h4>
                </div>
                <div class="col-md-8">
                    <p class="col-md-4"><strong><i class="fa fa-crosshairs margin-r-5"></i>Presicion</strong></p>
                    <p class="col-md-8">{{ moneda.presicion }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-hashtag margin-r-5"></i>Millares</strong></p>
                    <p class="col-md-8">{{ moneda.separador_millares !== ' ' ? moneda.separador_millares : 'espacio' }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-balance-scale margin-r-5"></i>Decimales</strong></p>
                    <p class="col-md-8">{{ moneda.separador_decimales }}</p>
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
        props: ['moneda']
    };
</script>

<style>
    .vista-moneda {
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
    .vista-moneda:hover {
        background: rgb(230,230,230);
        border-left-color: darkgreen;
    }
    .vista-moneda .content {
        min-height: 100px;
    }
</style>
