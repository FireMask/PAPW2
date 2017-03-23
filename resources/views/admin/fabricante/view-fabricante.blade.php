@extends('layouts.master')

@section('title', 'Fabricantes')

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

@section('Encabezado', 'Fabricantes')

@section('content')
<div align="right">
    <a class="btn btn-app" href="/fabricante/create">
        <i class="fa fa-plus"></i> Agregar
    </a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default box-add-edit">
            <table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>ID Proveedor</th>
                      <th>Nombre</th>
                      <th>Opciones</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($fabricantes as $fabs)
                <tr>
                    <td>{{ $fabs->idFabricante }}</td>
                    <td>{{ $fabs->nombre }}</td>
                    <td align="center">
                        <a href="/fabricante/{{ $fabs->idFabricante }}/edit">
                            <span class="fa fa-pencil"></span> Editar
                        </a>
                        <form id="borrarsito" action="/fabricante/{{ $fabs->idFabricante }}" method="POST">
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
            </table>
        </div>
    </div>
</div>
@stop
