@extends('layouts.master')

@section('title', 'Editar')

@section('headers')
  @include('layouts.headers')
@stop

@section('navbar')
  @include('layouts.navbar')
@stop

@section('sidebar')
  @include('layouts.sidebar')
@stop

@section('scripts')
  @include('layouts.scripts')
@stop

@section('content')
    <section class="content-header">
        <h1 style="margin-bottom: 20px;">
            Editar Usuario
        </h1>
    </section>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
                <form class="login-form" enctype="multipart/form-data" action="/usuario/{{ $usuario->idUsuario }}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idUsuario" value="{{ $usuario->idUsuario }}">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-edit-user" src="/storage/{{ $usuario->imagen_perfil }}">
                            <label for="imagen">Imagen de Perfil:</label>
                            <input type="file" class="form-control input-lg" id="imagen" name="imagen_perfil">
                        </div>
                        <div class="col-md-8">
                            <div class=from-group>
                                <label for="nombres">Nombres:</label>
                                <input value="{{ $usuario->nombres }}" required type="text" class="form-control input-lg" id="nombres" name="nombres">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="apellido_paterno">Apellido paterno:</label>
                                    <input value="{{ $usuario->apellido_paterno }}" required type="text" class="form-control input-lg" id="apellido_paterno" name="apellido_paterno">
                                </div>
                                <div class="col-md-6">
                                    <label for="apellido_materno">Apellido materno:</label>
                                    <input value="{{ $usuario->apellido_materno }}" type="text" class="form-control input-lg" id="apellido_materno" name="apellido_materno">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input value="{{ $usuario->correo_usuario }}" required type="email" class="form-control input-lg" id="correo" name="correo_usuario">
                            </div>
                            <div class="form-group">
                                <label for="contra_usuario">Contraseña:</label>
                                <input style="font-size: 24pt; line-height: 0px;" required type="password" class="form-control input-lg" id="contra_usuario" name="contra_usuario">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 col-offset-4">
                                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input id="fecha-agregar" type="text" class="form-control input-lg" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}">
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
                                            <option {{ ($usuario->idRol == $rol->idRol)?'selected':'' }} value="{{ $rol->idRol }}">{{ $rol->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6" align="left">
                                    <a class="btn btn-default" href="/usuario">
                                        <i class="fa fa-arrow-left"></i> Regresar
                                    </a>
                                </div>
                                <div class="col-md-6" align="right">
                                    <button type="submit" class="btn btn-warning">Actualizar</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
