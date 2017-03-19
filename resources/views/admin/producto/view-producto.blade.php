@extends('layouts.master')

@section('title', 'Productos')

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

@section('Encabezado', 'Productos')

@section('content')
<div align="right">
    <a class="btn btn-app" href="/producto/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<table id="table_id" class="table table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>ID Producto</th>
          <th>Código</th>
          <th>Modelo</th>
          <th>Descripción</th>
          <th>Fabricante</th>
          <th>Proveedor</th>
          <th>Precio</th>
          <th>Opciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($productos as $pro)
    <tr>
        <td>{{ $pro->idProducto }}</td>
        <td>{{ $pro->codigo }}</td>
        <td>{{ $pro->modelo }}</td>
        <td>{{ $pro->descripcion }}</td>
        <td>{{ $pro->fabricante->nombre }}</td>
        <td>{{ $pro->proveedor->nombre }}</td>
        <td>{{ $pro->precio }}</td>
        <td align="center">
            <form action="/producto/{{ $pro->idProducto }}/edit" method="GET">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/producto/{{ $pro->idProducto }}" method="POST">
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
