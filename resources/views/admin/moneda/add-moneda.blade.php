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
          Registro de Moneda
      </h1>
  </section>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form class="login-form" action="/moneda" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input required type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="simbolo">Simbolo:</label>
                <input required type="text" class="form-control" id="simbolo" name="simbolo">
            </div>
            <div class="form-group">
                <label for="presicion">Presicion:</label>
                <input required type="text" class="form-control" id="presicion" name="presicion">
            </div>
            <div class="form-group">
                <label for="separador_millares">Separador de Millares:</label>
                <input required type="text" class="form-control" id="separador_millares" name="separador_millares">
            </div>
			<div class="form-group">
                <label for="separador_decimales">Separador de Decimales:</label>
                <input required type="text" class="form-control" id="separador_decimales" name="separador_decimales">
            </div>
            <div class="form-group">
				<label for="codigo">Código:</label>
                <input required type="text" class="form-control" id="codigo" name="codigo">
            </div>
            <button type="submit" class="btn btn-default">Registrar</button>
            <div align="right">
                <a class="btn btn-default" href="/moneda">
                    <i class="fa fa-back"></i> Regresar
                </a>
            </span>
        </form>
    </div>
</div>
@stop
