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
            Editar Cliente
        </h1>
    </section>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
                    <form class="login-form" action="/cliente/{{ $cliente->idCliente}}" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idCliente" value="{{ $cliente->idCliente }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input required type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}">
                        </div>
                        <div class="form-group">
                            <label for="nombre_comercial">Nombre Comercial:</label>
                            <input required type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" value="{{ $cliente->nombre_comercial }}">
                        </div>
                        <div class="form-group">
                            <label for="giro">Giro:</label>
                            <input required type="text" class="form-control" id="giro" name="giro" value="{{ $cliente->giro }}">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input required type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}">
                        </div>
                        <div class="form-group">
                            <label for="codigo_postal">Código Postal:</label>
                            <input required type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{ $cliente->codigo_postal }}">
                        </div>
                        <div class="form-group">
                            <label for="pais">País:</label>
                            <input required type="text" class="form-control" id="pais" name="pais" value="{{ $cliente->pais }}">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input required type="text" class="form-control" id="estado" name="estado" value="{{ $cliente->estado }}">
                        </div>
                        <div class="form-group">
                            <label for="municipio">Municipio:</label>
                            <input required type="text" class="form-control" id="municipio" name="municipio" value="{{ $cliente->municipio }}">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $cliente->correo }}">
                        </div>
                        <div class="form-group">
                            <label for="telefono_empresa">Telefono Empresa:</label>
                            <input required type="text" class="form-control" id="telefono_empresa" name="telefono_empresa" value="{{ $cliente->telefono_empresa }}">
                        </div>
                        <div class="form-group">
                            <label for="telefono_personal">Telefono Personal:</label>
                            <input required type="text" class="form-control" id="telefono_personal" name="telefono_personal" value="{{ $cliente->telefono_personal }}">
                        </div>
                        <div id="prospect" class="form-group">
                            <label for="prospecto">Prospecto:</label>
                            <input type="checkbox" id="prospecto" name="prospecto" {{ $cliente->prospecto ? "checked" : ""}}>
                        </div>
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <a class="btn btn-default" href="/cliente">
                                    <i class="fa fa-arrow-left"></i> Regresar
                                </a>
                            </div>
                            <div class="col-md-6" align="right">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@stop
