<template>
    <div class="row" id="pantallaProducto">
        <div class="col-md-12">
            <div class="box box-default box-add-edit">
                <div id="pantallaProducto">
                    <transition name="fade" mode="out-in">
                        <!-- <perfil-producto
                            v-on:cerrar="lista()"
                            v-on:editar="editar()"
                            v-on:usuarioBorrado="borrar()"
                            v-if="accion == 'perfil'"
                            :cliente="seleccionado"
                        >
                        </perfil-producto> -->
                        <lista-producto
                            v-on:seleccionado="selected"
                            v-on:crear="crear()"
                            v-if="accion == 'buscar'"
                        ></lista-producto>
                        <editor-producto
                            :producto="seleccionado"
                            v-if="accion == 'editar' || accion == 'crear'"
                            v-on:lista="lista()"
                        ></editor-producto>
                    </transition>
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
            selected: function(seleccion) {
                this.seleccionado = seleccion;
                this.accion = 'editar';
            },
            crear: function() {
                this.accion = 'crear';
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
        #pantallaProducto div.box-add-edit{
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
