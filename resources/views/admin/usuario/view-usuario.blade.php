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

<passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default box-add-edit">
            <div id="pantallaUsuarios">
                <perfil-usuario v-if="usuarioSeleccionado != null" :usuario="usuarioSeleccionado"></perfil-usuario>
                <lista-usuario v-on:usuario="seleccionado"></lista-usuario>
            </div>
        </div>
    </div>
</div>
@stop
