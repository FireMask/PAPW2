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
          Editar de Empresa
      </h1>
  </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="login-form" action="/empresa/{{ $empresa->idEmpresa }}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idEmpresa" value="{{ $empresa->idEmpresa }}">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input required type="text" value="{{ $empresa->nombre }}" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="propietario">Propietario:</label>
                    <input required type="text" value="{{ $empresa->propietario }}" class="form-control" id="propietario" name="propietario">
                </div>
                <div class="form-group">
                    <label for="actividad_economica">Actividad Economica:</label>
                    <input type="text" value="{{ $empresa->actividad_economica }}" class="form-control" id="actividad_economica" name="actividad_economica">
                </div>
                <div class="form-group">
                    <label for="numero_registro">Numero de Registro:</label>
                    <input required type="text" value="{{ $empresa->numero_registro }}" class="form-control" id="numero_registro" name="numero_registro">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input required type="text" value="{{ $empresa->direccion }}" class="form-control" id="direccion" name="direccion">
                </div>
				<div class="form-group">
                    <label for="iva">Impuesto al Valor Agregado:</label>
                    <input required type="text" value="{{ $empresa->iva }}" class="form-control" id="iva" name="iva">
                </div>
				<div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input required type="text" value="{{ $empresa->telefono }}" class="form-control" id="telefono" name="telefono">
                </div>
				<div class="form-group">
                    <label for="logo">Logo:</label>
                    <input required type="text" value="{{ $empresa->logo }}" class="form-control" id="logo" name="logo">
                </div>
				<div class="form-group">
					<label for="correoPrincipal">Correo:</label>
					<input required type="email" value="{{ $empresa->correoPrincipal }}" class="form-control" id="correoPrincipal" name="correoPrincipal">
				</div>
                <div class="form-group">
                    <label for="moneda">Moenda por Defecto:</label>
                    <select class="form-control" id="moneda" name="idMoneda">
                        @if ($monedas->count())
                            @foreach($monedas as $mon)
                                 <option {{ $empresa->moneda->idMoneda == $mon->idMoneda ? 'selected' : '' }} value="{{ $mon->idMoneda }}">{{ $mon->nombre }}</option>
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
