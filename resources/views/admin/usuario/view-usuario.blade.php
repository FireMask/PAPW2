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
@stop
