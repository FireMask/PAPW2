@extends('layouts.master')

@section('title', 'Empresa')

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

@section('Encabezado', 'Empresa')

@section('content')
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
		  <td>Nombre</td>
	      <td>Propietario</td>
	      <td>Acividad Economica</td>
	      <td>Numero Registro</td>
	      <td>Direccion</td>
	      <td>IVA</td>
	      <td>Teléfono</td>
	      <td>Moneda Defecto</td>
	      <td>Correo Principal</td>
		  <td>Logo</td>
      </tr>
  </thead>
  <tbody>
    <tr>
        <td>{{ $emp->nombre }}</td>
        <td>{{ $emp->propietario }}</td>
        <td>{{ $emp->actividad_economica }}</td>
        <td>{{ $emp->numero_registro }}</td>
        <td>{{ $emp->direccion }}</td>
        <td>{{ $emp->iva }}</td>
		<td>{{ $emp->telefono }}</td>
		<td>{{ $emp->moneda->nombre }}</td>
		<td>{{ $emp->correoPrincipal }}</td>
		<td>{{ $emp->logo }}</td>
    </tr>
  </tbody>
</table>
@stop
