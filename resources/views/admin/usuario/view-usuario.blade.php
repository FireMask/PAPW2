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
    <a class="btn btn-app" href="/usuario/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<div id="listaUsuarios">
    <div class="content">
        <div class="row">
            <form class="form-horizontal col-md-6">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="correo">Buscar:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" v-on:keyup="mostrarPagina();" v-model="busqueda">
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div v-for="usuario in usuariosMostrados">
                <div class="col-md-6">
                    <view-usuario :data="usuario"></view-usuario>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                <button style="min-width: 15%;" class="btn btn-app" v-on:click="paginaAnterior();">
                    <i class="fa fa-arrow-left"></i>
                </button>
            </div>
            <div class="col-xs-8" align="center">
                <button style="min-width: 15%;" v-for="n in fin" class="btn btn-app" v-on:click="pagina(n + inicio - 1);" align="center">
                    <span>@{{ n + inicio }}</span>
                </button>
            </div>
            <div class="col-xs-2">
                <button style="min-width: 15%;" class="btn btn-app" v-on:click="paginaSiguiente();">
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
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
            <form action="/usuario/{{ $emp->idUsuario }}/edit" method="GET">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-sm btn-warning">Editar</button>
            </form>
            <form action="/usuario/{{ $emp->idUsuario }}" method="POST">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table> -->
@stop
