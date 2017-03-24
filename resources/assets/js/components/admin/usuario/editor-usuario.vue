<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-default box-add-edit">
                    <form class="login-form" enctype="multipart/form-data" action="/usuario" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="imagen">Imagen de Perfil:</label>
                                <input required type="file" class="form-control input-lg" id="imagen" name="imagen_perfil">
                            </div>
                            <div class="col-md-8">
                                <div class=from-group>
                                    <label for="nombres">Nombres:</label>
                                    <input required type="text" class="form-control input-lg" id="nombres" name="nombres">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="apellido_paterno">Apellido paterno:</label>
                                            <input required type="text" class="form-control input-lg" id="apellido_paterno" name="apellido_paterno">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="apellido_materno">Apellido materno:</label>
                                            <input type="text" class="form-control input-lg" id="apellido_materno" name="apellido_materno">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo:</label>
                                    <input required type="email" class="form-control input-lg" id="correo" name="correo_usuario">
                                </div>
                                <div class="form-group">
                                    <label for="contra_usuario">Contraseña:</label>
                                    <input style="font-size: 24pt; line-height: 0px;" required type="password" class="form-control input-lg" id="contra_usuario" name="contra_usuario">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 col-offset-4">
                                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input id="fecha-agregar" type="text" class="form-control input-lg" name="fecha_nacimiento">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rol">Puesto:</label>
                                    <select required class="form-control input-lg" id="rol" name="idRol">
                                        @if ($roles->count())
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->idRol }}">{{ $rol->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" align="left">
                                    <a class="btn btn-default" href="/usuario">
                                        <i class="fa fa-arrow-left"></i> Regresar
                                    </a>
                                </div>
                                <div class="col-md-6" align="right">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
