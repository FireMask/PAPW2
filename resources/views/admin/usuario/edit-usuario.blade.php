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

@section('content-header')
  <section class="content-header">
      <h1>
          Editar de empleado
      </h1>
  </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="login-form" action="/usuario/{{ $usuario->idUsuario }}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idUsuario" value="{{ $usuario->idUsuario }}">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input required type="text" value="{{ $usuario->nombres }}" class="form-control" id="nombres" name="nombres">
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apellido paterno:</label>
                    <input required type="text" value="{{ $usuario->apellido_paterno }}" class="form-control" id="apellido_paterno" name="apellido_paterno">
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido materno:</label>
                    <input type="text" value="{{ $usuario->apellido_materno }}" class="form-control" id="apellido_materno" name="apellido_materno">
                </div>
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input required type="email" value="{{ $usuario->correo_usuario }}" class="form-control" id="correo_usuario" name="correo_usuario">
                </div>
                <div class="form-group">
                    <label for="contra_usuario">Contraseña:</label>
                    <input required type="password" class="form-control" id="contra_usuario" name="contra_usuario">
                </div>
                <div class="form-group">
                    <label for="rol">Puesto:</label>
                    <select class="form-control" id="rol" name="idRol">
                        @if ($roles->count())
                            @foreach($roles as $rol)
                                 <option {{ $usuario->idRol == $rol->idRol ? 'selected' : '' }} value="{{ $rol->idRol }}">{{ $rol->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group" align="center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@stop
