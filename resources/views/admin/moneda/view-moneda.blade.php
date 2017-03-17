@extends('layouts.master')

@section('title', 'Usuarios')

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

@section('Encabezado', 'Usuarios')

@section('content')
<div align="right">
    <a class="btn btn-app" href="/moneda/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>ID Moneda</th>
          <th>Nombre</th>
          <th>Simbolo</th>
          <th>Presicion</th>
          <th>Separador de Millares</th>
          <th>Separador de Decimales</th>
          <th>Código</th>
          <th>Opciones</th>
      </tr>
  </thead>
  <tbody align="center">
    @foreach($monedas as $mon)
    <tr>
        <td>{{ $mon->idMoneda }}</td>
        <td>{{ $mon->nombre }}</td>
        <td>{{ $mon->simbolo }}</td>
        <td>{{ $mon->presicion }}</td>
        <td>{{ $mon->separador_millares }}</td>
        <td>{{ $mon->separador_decimales }}</td>
        <td>{{ $mon->codigo }}</td>
        <td align="center">
            <form action="/moneda/{{ $mon->idMoneda }}/edit" method="GET">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/moneda/{{ $mon->idMoneda }}" method="POST">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop
