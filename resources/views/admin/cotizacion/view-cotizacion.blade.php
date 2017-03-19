@extends('layouts.master')

@section('title', 'Cotizacion')

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

@section('Encabezado', 'Cotizacion')

@section('content')
<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
      <tr>
		  <td>idCotizacion</td>
	      <td>Usuario</td>
	      <td>Cliente</td>
	      <td>Moneda</td>
	      <td>Validez</td>
	      <td>Pago</td>
	      <td>Total</td>
	      <td>Aprovada</td>
	      <td>Finalizada</td>
		  <td>Opciones</td>
      </tr>
  </thead>
  <tbody>
    <tr>
        <td>{{ $cotizacion->idCotizacion }}</td>
        <td>{{ $cotizacion->usuario->nombre }}</td>
        <td>{{ $cotizacion->actividad_economica }}</td>
        <td>{{ $cotizacion->numero_registro }}</td>
        <td>{{ $cotizacion->direccion }}</td>
        <td>{{ $cotizacion->iva }}</td>
		<td>{{ $cotizacion->telefono }}</td>
		<td>{{ $cotizacion->moneda->nombre }}</td>
		<td>{{ $cotizacion->correoPrincipal }}</td>
		<td>{{ $cotizacion->logo }}</td>
    </tr>
  </tbody>
</table>
@stop
