<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class apiController extends Controller
{
	public function getUsers(){
		$usuarios = Usuario::with('rol')->get();
		return response()->json(['usuarios' => $usuarios]);
	}

	public function getUserStadistics($id){
		$promedioMensual = DB::select('call PromedioDeVentasMensualUsuario(?)',array($id));
		$ventasTotales = DB::table('cotizacion')
			->where([
			    ['idUsuario', '=', (string)$id],
			    ['finalizada', '=', '1']
			])
			->count();
		$ventasDelMes = DB::table('cotizacion')
			->select(DB::raw('MONTH(IF(updated_at is null, created_at, updated_at)) mes, YEAR(IF(updated_at is null, created_at, updated_at)) ano, COUNT(*) ventas'))
			->where([
			    ['idUsuario', '=', (string)$id],
			    ['finalizada', '=', '1']
			])
			->groupBy(DB::raw('YEAR(IF(updated_at is null, created_at, updated_at)), MONTH(IF(updated_at is null, created_at, updated_at))'))
			->havingRaw('ano = YEAR(CURDATE()) and mes = MONTH(CURDATE())')
			->get();
		return response()->json([
			'ventasDelMes' => (sizeof($ventasDelMes) > 0 ? $ventasDelMes[0]->ventas : 0),
			'promedioMensual' => ($promedioMensual[0]->promedioMensual != null ? $promedioMensual[0]->promedioMensual : 0),
			'ventasTotales' => $ventasTotales
		]);
	}

	public function getUserClients($id){
		$clientes = DB::table('cliente')
			->join('usuario_cliente','usuario_cliente.idCliente','=','cliente.idCliente')
			->select('cliente.*')
			->where('usuario_cliente.idUsuario','=',(string)$id)
			->get();
		return response()->json(['clientes' => $clientes]);
	}
}
