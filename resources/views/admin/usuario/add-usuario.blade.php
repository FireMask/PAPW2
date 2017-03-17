@extends('layouts.master')

@section('title', 'Registro')

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
          Registro de empleado
      </h1>
  </section>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form class="login-form" action="/usuario" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input required type="text" class="form-control" id="nombres" name="nombres">
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido paterno:</label>
                <input required type="text" class="form-control" id="apellido_paterno" name="apellido_paterno">
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido materno:</label>
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input required type="email" class="form-control" id="correo" name="correo_usuario">
            </div>
            <div class="form-group">
                <label for="contra_usuario">Contraseña:</label>
                <input required type="password" class="form-control" id="contra_usuario" name="contra_usuario">
            </div>
            <div class="form-group">
                <label for="rol">Puesto:</label>
                <select required class="form-control" id="rol" name="rol">
                    @if ($roles->count())
                        @foreach($roles as $rol)
                             <option value="{{ $rol->idRol }}">{{ $rol->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-default">Registrar</button>
            <div align="right">
                <a class="btn btn-default" href="/usuario">
                    <i class="fa fa-back"></i> Regresar
                </a>
            </span>
        </form>
    </div>
</div>
@stop
