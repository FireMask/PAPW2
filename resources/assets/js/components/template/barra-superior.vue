<template>
    <header class="main-header">
        <a href="#" class="logo" v-on:click="inicio()">
            <span class="logo-mini"><b>C</b>L</span>
            <span class="logo-lg"><b>CRM</b>Lite</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img :src="profileImagePath" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ usuario.nombres + ' ' + usuario.apellido_paterno }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img :src="profileImagePath" class="img-circle" alt="User Image">
                                <p>
                                    {{ usuario.nombres + ' ' + usuario.apellido_paterno }}
                                    <small v-if="usuario.idRol == 1">Administrador</small>
                                    <small v-else>Empleado</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-danger btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
    var store = require('./../../store/store.js');
    export default {
        data() {
            return {

            };
        },
        props:[
            'usuario'
        ],
        computed:{
            profileImagePath: function() {
                return '/storage/' + this.usuario.imagen_perfil;
            }
        },
        methods: {
            inicio: function() {
                store.commit('setPage', 'inicio');
            }
        },
        mounted:function(){
            store.commit('setId', this.usuario.idUsuario);
        }
    }
</script>
