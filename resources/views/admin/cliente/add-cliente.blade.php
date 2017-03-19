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
          Registro de Cliente
      </h1>
  </section>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form class="login-form" action="/cliente" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input required type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="nombre_comercial">Nombre Comercial:</label>
                <input required type="text" class="form-control" id="nombre_comercial" name="nombre_comercial">
            </div>
            <div class="form-group">
                <label for="giro">Giro:</label>
                <input required type="text" class="form-control" id="giro" name="giro">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input required type="text" class="form-control" id="direccion" name="direccion">
            </div>
            <div class="form-group">
                <label for="codigo_postal">Código Postal:</label>
                <input required type="text" class="form-control" id="codigo_postal" name="codigo_postal">
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input required type="text" class="form-control" id="pais" name="pais">
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input required type="text" class="form-control" id="estado" name="estado">
            </div>
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input required type="text" class="form-control" id="municipio" name="municipio">
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input required type="email" class="form-control" id="correo" name="correo">
            </div>
            <div class="form-group">
                <label for="telefono_empresa">Telefono Empresa:</label>
                <input required type="text" class="form-control" id="telefono_empresa" name="telefono_empresa">
            </div>
            <div class="form-group">
                <label for="telefono_personal">Telefono Personal:</label>
                <input required type="text" class="form-control" id="telefono_personal" name="telefono_personal">
            </div>
            <div id="prospect" class="form-group">
                <label for="prospecto">Prospecto:</label>
                <input type="checkbox" id="prospecto" name="prospecto">
            </div>
            <div class="form-group">
                <div class="col-md-6" align="left">
                    <a class="btn btn-default" href="/usuario">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </a>
                </div>
                <div class="col-md-6" align="right">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
