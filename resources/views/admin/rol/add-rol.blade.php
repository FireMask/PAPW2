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
          Nuevo Rol
      </h1>
  </section>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form class="login-form" action="/rol" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nombres">Nombre:</label>
                <input required type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <button type="submit" class="btn btn-default">Registrar</button>
            <div class="form-group">
                <div class="col-md-6" align="left">
                    <a class="btn btn-default" href="/rol">
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
@stop
