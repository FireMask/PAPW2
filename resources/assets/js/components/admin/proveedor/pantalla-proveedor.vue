<template>
    <div class="content" id="pantallaProveedor">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaProveedor">
                        <transition name="fade" mode="out-in">
                            <!-- <perfil-proveedor
                                v-on:cerrar="lista()"
                                v-on:editar="editar()"
                                v-on:usuarioBorrado="borrar()"
                                v-if="accion == 'perfil'"
                                :cliente="seleccionado"
                            >
                            </perfil-proveedor> -->
                            <lista-proveedor
                                v-on:seleccionado="seleccionado"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                            ></lista-proveedor>
                            <!-- <editor-proveedor
                                :cliente="seleccionado"
                                v-if="accion == 'editar' || accion == 'crear'"
                                v-on:cerrar="lista()"
                            ></editor-proveedor> -->
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
            seleccionado: function(seleccion) {
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
        #pantallaProveedor div.box-add-edit{
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
