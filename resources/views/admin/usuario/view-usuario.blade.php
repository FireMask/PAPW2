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

<div id="pantallaUsuarios">
    <perfil-usuario v-if="usuarioSeleccionado != null" :usuario="usuarioSeleccionado"></perfil-usuario>
    <lista-usuario v-on:usuario="seleccionado"></lista-usuario>
</div>

<!-- <table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
            <a href="/usuario/{{ $emp->idUsuario }}/edit">
                <span class="fa fa-pencil"></span> Editar
            </a>
            <form id="borrarsito" action="/usuario/{{ $emp->idUsuario }}" method="POST">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="javascript:{}" onclick="document.getElementById('borrarsito').submit();">
                    <span class="fa fa-trash"></span> Eliminar
                </a>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table> -->
@stop
