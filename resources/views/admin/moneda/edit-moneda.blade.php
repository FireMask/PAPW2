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
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
                <form class="login-form" action="/moneda/{{ $moneda->idMoneda }}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idMoneda" value="{{ $moneda->idMoneda }}">
                    <div class="form-group">
                        <label for="nombres">Nombre:</label>
                        <input required type="text" value="{{ $moneda->nombre }}" class="form-control" id="nombres" name="nombres">
                    </div>
                    <div class="form-group">
                        <label for="simbolo">Simbolo:</label>
                        <input required type="text" value="{{ $moneda->simbolo }}" class="form-control" id="simbolo" name="simbolo">
                    </div>
                    <div class="form-group">
                        <label for="presicion">Presicion:</label>
                        <input type="text" value="{{ $moneda->presicion }}" class="form-control" id="presicion" name="presicion">
                    </div>
                    <div class="form-group">
                        <label for="separador_millares">Separador de Millares:</label>
                        <input required type="text" value="{{ $moneda->separador_millares }}" class="form-control" id="separador_millares" name="separador_millares">
                    </div>
                    <div class="form-group">
                        <label for="separador_decimales">Separador de Decimales:</label>
                        <input required type="text" value="{{ $moneda->separador_decimales }}" class="form-control" id="separador_decimales" name="separador_decimales">
                    </div>
                    <div class="form-group">
                        <label for="codigo">Código:</label>
                        <input required type="text" value="{{ $moneda->codigo }}" class="form-control" id="codigo" name="codigo">
                    </div>
                    <div class="row">
                        <div class="col-md-6" align="left">
                            <a class="btn btn-default" href="/moneda">
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
