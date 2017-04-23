<template>
    <div class="content" id="pantallaUsuario">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaUsuarios">
                        <transition name="fade" mode="out-in">
                            <perfil-usuario
                                v-on:cerrar="lista()"
                                v-on:editar="editarUsuario()"
                                v-on:usuarioBorrado="borrarUsuario()"
                                v-if="accion == 'perfil'"
                                :usuario="usuarioSeleccionado"
                            >
                            </perfil-usuario>
                            <lista-usuario
                                v-on:usuario="seleccionado"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                            ></lista-usuario>
                            <editor-usuario
                                :usuario="usuarioSeleccionado"
                                v-if="accion == 'editar' || accion == 'crear'"
                                v-on:cerrar="lista()"
                            ></editor-usuario>
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
                usuarioSeleccionado: null,
                accion: 'buscar'
            };
        },
        methods: {
            seleccionado: function(usuario) {
                this.usuarioSeleccionado = usuario;
                this.accion = 'perfil';
            },
            crear: function() {
                this.accion = 'crear';
            },
            borrarUsuario: function() {
                this.$http.get('/usuario/').then(response => {
                    this.usuarios = response.body;
                });
            },
            editarUsuario: function() {
                this.accion = 'editar';
            },
            lista: function() {
                this.usuarioSeleccionado = null;
                this.accion = 'buscar';
            }
        }
    }
</script>

<style>
    @media screen and (max-width: 700px) {
        #pantallaUsuario div.box-add-edit{
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
