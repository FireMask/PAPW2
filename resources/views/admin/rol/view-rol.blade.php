@extends('layouts.master')

@section('title', 'Roles')

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

@section('Encabezado', 'Roles')

@section('content')
<div align="right">
    <a class="btn btn-app" href="/rol/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>ID Rol</th>
		  <th>Nombre</th>
          <th>Opciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($roles as $rol)
    <tr>
        <td>{{ $rol->idRol }}</td>
		<td>{{ $rol->nombre }}</td>
        <td align="center">
            <form action="/rol/{{ $rol->idRol }}/edit" method="GET">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/rol/{{ $rol->idRol }}" method="POST">
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
