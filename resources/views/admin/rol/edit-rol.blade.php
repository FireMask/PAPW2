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
            Editar Rol
        </h1>
    </section>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
                <form class="login-form" action="/rol/{{ $rol->idRol }}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idRol" value="{{ $rol->idRol }}">
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input required type="text" value="{{ $rol->nombre }}" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="row">
                        <div class="col-md-6" align="left">
                            <a class="btn btn-default" href="/rol">
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
