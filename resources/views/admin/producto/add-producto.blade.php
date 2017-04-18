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

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
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
                    <div class="row">
                        <div class="col-md-6" align="left">
                            <a class="btn btn-default" href="/producto">
                                <i class="fa fa-arrow-left"></i> Regresar
                            </a>
                        </div>
                        <div class="col-md-6" align="right">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
