@extends('layouts.master')

@section('title', 'Proveedores')

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

@section('Encabezado', 'Proveedores')

@section('content')
<div align="right">
    <a class="btn btn-app" href="/proveedor/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>ID Proveedor</th>
		  <th>Nombre</th>
          <th>Opciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($proveedores as $prov)
    <tr>
        <td>{{ $prov->idProveedor }}</td>
		<td>{{ $prov->nombre }}</td>
        <td align="center">
            <form action="/proveedor/{{ $prov->idProveedor }}/edit" method="GET">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/proveedor/{{ $prov->idProveedor }}" method="POST">
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
