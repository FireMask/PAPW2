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
          Registro de Producto
      </h1>
  </section>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form class="login-form" action="/producto" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input required type="text" class="form-control" id="codigo" name="codigo">
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input required type="text" class="form-control" id="modelo" name="modelo">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input required type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
                <label for="idFabricante">Fabricante:</label>
                <select required class="form-control" id="idFabricante" name="idFabricante">
                    <option>Seleccionar...</option>
                    @if ($fabricantes->count())
                        @foreach($fabricantes as $fab)
                            <option value="{{ $fab->idFabricante }}">{{ $fab->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="idProveedor">Proveedor:</label>
                <select required class="form-control" id="idProveedor" name="idProveedor">
                    <option>Seleccionar...</option>
                    @if ($proveedores->count())
                        @foreach($proveedores as $prov)
                            <option value="{{ $prov->idProveedor }}">{{ $prov->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input required type="text" class="form-control" id="precio" name="precio">
            </div>
            <button type="submit" class="btn btn-default">Registrar</button>
            <div align="right">
                <a class="btn btn-default" href="/producto">
                    <i class="fa fa-back"></i> Regresar
                </a>
            </div>
        </form>
    </div>
</div>
@stop
