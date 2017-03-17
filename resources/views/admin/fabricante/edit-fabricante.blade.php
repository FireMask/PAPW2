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
          Editar de Proveedor
      </h1>
  </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="login-form" action="/fabricante/{{ $fabricante->idFabricante }}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idProveedor" value="{{ $fabricante->idFabricante }}">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input required type="text" value="{{ $fabricante->nombre }}" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group" align="center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@stop
