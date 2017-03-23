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
            Editar Proveedor
        </h1>
    </section>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="login-form" action="/proveedor/{{ $proveedor->idProveedor }}" method="POST">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idProveedor" value="{{ $proveedor->idProveedor }}">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input required type="text" value="{{ $proveedor->nombre }}" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                    <div class="col-md-6" align="left">
                        <a class="btn btn-default" href="/proveedor">
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
