<template>
    <div class="vista-cliente">
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{ cliente.nombre_comercial }}</h2>
                    <h4>{{ cliente.nombre }}</h4>
                    <h4>{{ cliente.giro }}</h4>
                </div>
                <div class="col-md-8">
                    <p class="col-md-4"><strong><i class="fa fa-envelope margin-r-5"></i>Correo</strong></p>
                    <p class="col-md-8">{{ cliente.correo }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-phone margin-r-5"></i>Tel. personal</strong></p>
                    <p class="col-md-8">{{ cliente.telefono_personal }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-industry margin-r-5"></i>Tel. empresa</strong></p>
                    <p class="col-md-8">{{ cliente.telefono_empresa }}</p>
                    <p class="col-md-4"><strong><i class="fa fa-map-marker margin-r-5"></i>Dirección</strong></p>
                    <p class="col-md-8">{{ cliente.direccion }}, {{ cliente.municipio }} CP. {{ cliente.codigo_postal }}, {{ cliente.estado }}, {{ cliente.pais }}</p>
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
        props: ['cliente']
    };
</script>

<style>
    .vista-cliente {
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
    .vista-cliente:hover {
        background: rgb(230,230,230);
        border-left-color: darkgreen;
    }
    .vista-cliente .content {
        min-height: 100px;
    }
</style>
