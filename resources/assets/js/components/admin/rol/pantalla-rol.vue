<template>
    <div class="content" id="pantallaRol">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaRol">
                        <transition name="fade" mode="out-in">
                            <lista-rol
                                v-on:seleccionado="seleccionar"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                            ></lista-rol>
                            <editor-rol
                                :rol="seleccionado"
                                v-if="accion == 'editar' || accion == 'crear'"
                                v-on:cerrar="lista()"
                            ></editor-rol>
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
                this.accion = 'editar';
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
        #pantallaRol div.box-add-edit{
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
