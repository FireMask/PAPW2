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
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th>ID Usuario</th>
          <th>Nombres</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Opciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($users as $emp)
    <tr>
        <td>{{ $emp->idUsuario }}</td>
        <td>{{ $emp->nombres }}</td>
        <td>{{ $emp->apellido_paterno }}</td>
        <td>{{ $emp->apellido_materno }}</td>
        <td>{{ $emp->correo_usuario }}</td>
        <td>{{ $emp->rol->nombre }}</td>
        <td align="center">
            <form action="/usuario/{{ $emp->idUsuario }}/edit" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/usuario/{{ $emp->idUsuario }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop
