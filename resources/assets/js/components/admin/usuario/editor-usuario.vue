<template>
    <form class="login-form" enctype="multipart/form-data" action="/usuario" method="POST">
        <input type="hidden" name="_token" :value="csrf_token">
        <div class="row">
            <div class="col-md-4">
                <label for="imagen">Imagen de Perfil:</label>
                <input required type="file" class="form-control input-lg" id="imagen" name="imagen_perfil">
            </div>
            <div class="col-md-8">
                <div class=from-group>
                    <label for="nombres">Nombres:</label>
                    <input required type="text" class="form-control input-lg" id="nombres" name="nombres" :value="nombre">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="apellido_paterno">Apellido paterno:</label>
                            <input required type="text" class="form-control input-lg" id="apellido_paterno" name="apellido_paterno" :value="apellido_paterno">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido_materno">Apellido materno:</label>
                            <input type="text" class="form-control input-lg" id="apellido_materno" name="apellido_materno" :value="apellido_materno">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input required type="email" class="form-control input-lg" id="correo" name="correo_usuario" :value="correo_usuario">
                </div>
                <div class="form-group" v-if="usuario == null">
                    <label for="contra_usuario">Contraseña:</label>
                    <input style="font-size: 24pt; line-height: 0px;" required type="password" class="form-control input-lg" id="contra_usuario" name="contra_usuario">
                </div>
                <div class="form-group row">
                    <div class="col-md-8 col-offset-4">
                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input id="fecha-agregar" type="text" class="form-control input-lg" name="fecha_nacimiento" :value="fecha_nacimiento">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rol">Puesto:</label>
                    <select required class="form-control input-lg" id="rol" name="idRol">
                        <option v-for="rol in roles" :value="rol.idRol">{{ rol.nombre }}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" align="left">
                    <a class="btn btn-default" href="#" v-on:click="cerrar()">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </a>
                </div>
                <div class="col-md-6" align="right">
                    <button type="submit" class="btn btn-primary">{{ textoBoton }}</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    var store = require('./../../../store/store.js');
    export default {
        data: function() {
            return {
                roles: []
            };
        },
        props: ['usuario'],
        computed: {
            csrf_token: function() {
                return store.state.globales.token;
            },
            textoBoton: function() {
                return this.usuario != null ? 'Actualizar' : 'Agregar';
            },
            nombre: function() {
                return this.usuario != null ? this.usuario.nombres : '';
            },
            apellido_paterno: function() {
                return this.usuario != null ? this.usuario.apellido_paterno : '';
            },
            apellido_materno: function() {
                return this.usuario != null ? this.usuario.apellido_materno : '';
            },
            correo_usuario: function() {
                return this.usuario != null ? this.usuario.correo_usuario : '';
            },
            fecha_nacimiento: function() {
                return this.usuario != null ? this.usuario.fecha_nacimiento : '';
            },
            puesto: function() {
                return this.usuario != null ? this.usuario.rol.idRol : 0;
            },
        },
        methods: {
            obtenerRoles: function() {
                this.$http.get('/api/roles/').then(response => {
                    this.roles = response.body;
                    $('select[name="idRol"]').val(this.puesto);
                });
            },
            cerrar: function() {
                this.$emit('cerrar');
            }
        },
        updated: function() {
            $('select[id="rol"]').val(this.puesto);
        },
        mounted: function() {
            this.obtenerRoles();
            $("#fecha-agregar").datepicker();
            $("#imagen").fileinput({
                showUpload: false,
                maxFileCount: 1,
                showCaption: false
            });

            $('input[name="nombres"]').val(this.nombre);
            $('input[name="apellido_paterno"]').val(this.apellido_paterno);
            $('input[name="apellido_materno"]').val(this.apellido_materno);
            $('input[name="correo_usuario"]').val(this.correo_usuario);
            $('input[name="fecha_nacimiento"]').val(this.fecha_nacimiento);
        }
    }
</script>
