<template>
    <div class="content" id="pantallaCliente">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaClientes">
                        <transition name="fade" mode="out-in">
                            <div class="" v-if="accion == 'opciones'">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="btn btn-default boton-principal" v-on:click="crear()">
                                            <img class="icon icons8-Add-User-Male" width="64" height="64" src="data:image/png;base64,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">
                                            <label for="">Agregar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn btn-default boton-principal" v-on:click="lista()">
                                            <img class="icon icons8-User-Group-Man-Man" width="64" height="64" src="data:image/png;base64,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">
                                            <label for="">Lista</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn btn-default boton-principal" v-on:click="editar()">
                                            <img class="icon icons8-Edit-User-Male" width="64" height="64" src="data:image/png;base64,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">
                                            <label for="">Editar</label>
                                        </div>
                                    </div>
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
