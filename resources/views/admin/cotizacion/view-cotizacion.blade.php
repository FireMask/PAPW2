@extends('layouts.master')

@section('title', 'Cotizaión')

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
@stop

@section('Encabezado', 'Cotización')

@section('content')
    @if(count($cotizaciones) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="box box-default box-add-edit">
            <table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Usuario</th>
                      <th>Cliente</th>
                      <th>Moneda</th>
                      <th>Validez</th>
                      <th>Pago</th>
                      <th>Total $</th>
                      <th>Aprobada</th>
                      <th>Finalizada</th>
                      <th>Opciones</th>
                  </tr>
              </thead>
              <tbody align="center">
              @foreach($cotizaciones as $coti)
                <tr>
                    <td>{{ $coti->idCotizacion }}</td>
                    <td>{{ $coti->usuario->nombres.$coti->usuario->apellido_paterno }}</td>
                    <td>{{ $coti->cliente->nombre }}</td>
                    <td>{{ $coti->moneda->simbolo }}</td>
                    <td>{{ $coti->validez }}</td>
                    <td>{{ $coti->pago }}</td>
                    <td>${{ $coti->total }}</td>
                    <td>
                        @if($coti->aprobada)
                            <span style="color: green; font-size: 14pt;" class='fa fa-check'></span>
                        @else
                            <span style="color: red; font-size: 14pt;" class='fa fa-remove'></span>
                        @endif
                    </td>
                    <td>
                        @if($coti->finalizada)
                            <span style="color: green; font-size: 14pt;" class='fa fa-check'></span>
                        @else
                            <span style="color: red; font-size: 14pt;" class='fa fa-remove'></span>
                        @endif
                    </td>
                    <td align="center">
                        <form id="aborrarsito{{ $coti->idCotizacion }}" action="/cotizacion/{{ $coti->idCotizacion }}" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="idCotizacion" type="hidden" value="{{ $coti->idCotizacion }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="aprobada" value="1">
                            <a href="javascript:{}" onclick="document.getElementById('aborrarsito{{ $coti->idCotizacion }}').submit();">
                                <span class="fa fa-check"></span> Aprobar
                            </a>
                        </form>
                        <form id=bborrarsito{{ $coti->idCotizacion }}" action="/cotizacion/{{ $coti->idCotizacion }}" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="idCotizacion" type="hidden" value="{{ $coti->idCotizacion }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="aprobada" value="0">
                            <a href="javascript:{}" onclick="document.getElementById('bborrarsito{{ $coti->idCotizacion }}').submit();">
                                <span class="fa fa-times"></span> Rechazar
                            </a>
                        </form>
                    </td>
                </tr>
              @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
    @else
        <div class="alert alert-dismissible alert-info">
            <strong><span class="fa fa-exclamation-triangle"></span> INFORMACIÓN: </strong> No hay cotizaciones pendientes.
        </div>
    @endif
@stop
