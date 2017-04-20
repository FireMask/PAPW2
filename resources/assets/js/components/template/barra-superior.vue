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
                            <img src="/js/dist/AdminLTE/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="/js/dist/AdminLTE/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    Andres Lira
                                    <small>Empleado</small>
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
        methods: {
            inicio: function() {
                store.commit('setPage', 'inicio');
            }
        }
    }
</script>
