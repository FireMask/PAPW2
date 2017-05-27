<template>
    <div class="content" id="pantallaCliente">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaClientes">
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
                            <detalle-cliente-user
                                v-on:cerrar="lista()"
                                v-on:editar="editar()"
                                v-on:usuarioBorrado="borrar()"
                                v-if="accion == 'perfil'"
                                :cliente="seleccionado"
                            ></detalle-cliente-user>
                            <lista-cliente-user
                                v-on:seleccionado="seleccionar"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                                :idUser="usuarioid"
                            ></lista-cliente-user>
                            <add-cliente-user
                                :cliente="seleccionado"
                                :idUser="usuarioid"
                                v-if="accion == 'editar' || accion == 'crear'"
                                v-on:cerrar="opciones()"
                            ></add-cliente-user>
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
            opciones: function() {
                this.accion = 'opciones';
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
        #pantallaCliente div.box-add-edit{
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
