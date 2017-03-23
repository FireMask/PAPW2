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
            Editar Moneda
        </h1>
    </section>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="login-form" action="/producto/{{ $producto->idProducto }}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idProducto" value="{{ $producto->idProducto }}">
                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input required type="text" value="{{ $producto->codigo }}" class="form-control" id="codigo" name="codigo">
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input required type="text" value="{{ $producto->modelo }}" class="form-control" id="modelo" name="modelo">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" value="{{ $producto->descripcion }}" class="form-control" id="descripcion" name="descripcion">
                </div>
                <div class="form-group">
                    <label for="idFabricante">Fabricante:</label>
                    <select class="form-control" id="idFabricante" name="idFabricante">
                        @if ($fabricantes->count())
                            @foreach($fabricantes as $fab)
                                <option {{ $producto->idFabricante == $fab->idFabricante ? 'selected' : '' }} value="{{ $fab->idFabricante }}">{{ $fab->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="idProveedor">Proveedor:</label>
                    <select class="form-control" id="idProveedor" name="idProveedor">
                        @if ($proveedores->count())
                            @foreach($proveedores as $prov)
                                <option {{ $producto->idProveedor == $prov->idProveedor ? 'selected' : '' }} value="{{ $prov->idProveedor }}">{{ $prov->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input required type="number" step="0.01" value="{{ $producto->precio }}" class="form-control" id="precio" name="precio">
                </div>
                <div class="form-group">
                    <div class="col-md-6" align="left">
                        <a class="btn btn-default" href="/producto">
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
@stop
