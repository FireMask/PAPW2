@extends('layouts.master')

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
  <section class="content-header">
      <h1>
          Usuarios
      </h1>
  </section>
@stop

@section('content')
<table id="table_id" class="table table-striped table-bordered dataTable order-column" cellspacing="0" width="100%">
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
        <td>
          <td>
            <form action="/usuario/{{ $emp->idUsuario }}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
            </form>
          </td>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop
