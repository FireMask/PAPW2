<template>
    <div class="content" id="pantallaCliente">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaClientes">
                        <transition name="fade" mode="out-in">
                            <!-- <perfil-cliente
                                v-on:cerrar="lista()"
                                v-on:editar="editar()"
                                v-on:usuarioBorrado="borrar()"
                                v-if="accion == 'perfil'"
                                :cliente="seleccionado"
                            >
                            </perfil-cliente> -->
                            <lista-cliente-user
                                v-on:seleccionado="seleccionar"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                            ></lista-cliente-user>
                            <!-- <editor-cliente
                                :cliente="seleccionado"
                                v-if="accion == 'editar' || accion == 'crear'"
                                v-on:cerrar="lista()"
                            ></editor-cliente> -->
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
                accion: 'buscar'
            };
        },
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
