@extends('layouts.master')

@section('title', 'Clientes')

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

@section('Encabezado', 'Clientes')

@section('content')
<div align="right">
    <a class="btn btn-app" href="/cliente/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>ID Cliente</th>
          <th>Nombre</th>
          <th>Nombre Comercial</th>
          <th>Giro</th>
          <th>Dirección</th>
          <th>Código Postal</th>
          <th>País</th>
          <th>Estado</th>
          <th>Municipio</th>
          <th>Correo</th>
          <th>Teléfono Empresa</th>
          <th>Teléfono Personal</th>
          <th>Propecto</th>
          <th>Opciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($clientes as $cli)
    <tr>
        <td>{{ $cli->idCliente }}</td>
        <td>{{ $cli->nombre }}</td>
        <td>{{ $cli->nombre_comercial }}</td>
        <td>{{ $cli->giro }}</td>
        <td>{{ $cli->direccion }}</td>
        <td>{{ $cli->codigo_postal }}</td>
        <td>{{ $cli->pais }}</td>
        <td>{{ $cli->estado }}</td>
        <td>{{ $cli->municipio }}</td>
        <td>{{ $cli->correo }}</td>
        <td>{{ $cli->telefono_empresa }}</td>
        <td>{{ $cli->telefono_personal }}</td>
        <td>{{ $cli->prospecto }}</td>
        <td align="center">
            <form action="/cliente/{{ $cli->idCliente }}/edit" method="GET">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/cliente/{{ $cli->idCliente }}" method="POST">
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
