<template>
    <div class="sidebar-container">
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img :src="profileImagePath" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ usuario.nombres +' '+ usuario.apellido_paterno }}</p> <!--UserName-->
                        <a href=""><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <div v-if="usuario.idRol == 1"> <!-- Menu del administrador -->
                    <ul class="sidebar-menu">
                        <li class="header"></li>
                        <li class="treeview">
                            <a href="#" v-on:click="inicio()"><i class="fa fa-home"></i> <span>Inicio</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('cotizaciones')"><i class="fa fa-file-text"></i> <span>Cotizaciones</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('clientes')"><i class="fa fa-users"></i> <span>Clientes</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('productos')"><i class="fa fa-shopping-basket"></i> <span>Productos</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('usuarios')"><i class="fa fa-user"></i> <span>Usuarios</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('monedas')"><i class="fa fa-money"></i> <span>Monedas</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('roles')"><i class="fa fa-tags"></i> <span>Roles</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('proveedores')"><i class="fa fa-truck"></i> <span>Proveedores</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('fabricantes')"><i class="fa fa-wrench"></i> <span>Fabricantes</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('empresa')"><i class="fa fa-gear"></i> <span>Empresa</span></a>
                        </li>
                    </ul>
                </div>
                <div v-else>    <!-- Menu del usuario -->
                    <ul class="sidebar-menu">
                        <li class="header"></li>
                        <li class="treeview">
                            <a href="#" v-on:click="inicio()"><i class="fa fa-home"></i> <span>Inicio</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('clientes')"><i class="fa fa-users"></i> <span>Clientes</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#" v-on:click="cambiarPagina('cotizaciones')"><i class="fa fa-file-text"></i> <span>Cotizaciones</span></a>
                        </li>
                    </ul>
                </div>
            </section>
        </aside>

        <aside class="control-sidebar control-sidebar-dark">
            <div class="tab-content">
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Configuración</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <i class="menu-icon fa fa-gear bg-red"></i>
                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Configurar</h4>
                                    <p>Datos de la empresa</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>
</template>

<script>
    var store = require('./../../store/store.js');
    export default {
        data() {
            return {
                datos: null
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
            cambiarPagina: function(pagina) {
                store.commit('setPage', pagina);
            },
            inicio: function() {
                store.commit('setPage', 'inicio');
            }
        },
        mounted: function() {
            console.log(this.usuario);
        }
    }
</script>

<style>
    .sidebar-container {
        /*height: 100%;*/
    }
</style>
