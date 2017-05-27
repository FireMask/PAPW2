<template>
    <div class="content" id="pantallaCotizaciones">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaCotizaciones">
                        <transition name="fade" mode="out-in">
                            <div class="" v-if="accion == 'opciones'">
                                <div class="btn btn-default" v-on:click="crear()">
                                    Agregar
                                </div>
                                <div class="btn btn-default" v-on:click="lista()">
                                    Lista
                                </div>
                                <div class="btn btn-default" v-on:click="editar()">
                                    Editar
                                </div>
                            </div>
                            <detalle-cotizacion-user
                                v-on:cerrar="lista()"
                                v-on:editar="editar()"
                                v-if="accion == 'perfil'"
                                :cotizacion="seleccionado"
                            ></detalle-cotizacion-user>
                            <lista-cotizacion-user
                                v-on:seleccionado="seleccionar"
                                v-on:cerrar="accion = 'opciones'"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                                :idUser="usuarioid"
                            ></lista-cotizacion-user>
                            <add-cotizacion-user
                                v-if="accion == 'crear'"
                            ></add-cotizacion-user>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                seleccionado: null,
                accion: 'opciones'
            };
        },
        computed:{
            idUsuario: function(){
                return this.idUsuario;
            }
        },
        props: ['usuarioid'],
        methods: {
            seleccionar: function(seleccion) {
                this.seleccionado = seleccion;
                this.accion = 'perfil';
            },
            crear: function() {
                this.accion = 'crear';
            },
            editar: function() {
                this.accion = 'editar';
            },
            lista: function() {
                this.seleccionado = null;
                this.accion = 'buscar';
            }
        }
    }
</script>

<style>
    @media screen and (max-width: 700px) {
        #pantallaCotizaciones div.box-add-edit{
            padding: 0;
        }
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>
