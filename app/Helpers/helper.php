<?php 

/*
|--------------------------------------------------------------------------
| Custom Helper
|--------------------------------------------------------------------------
|
| Funciones globales del sistema.
|
*/

use Illuminate\Support\Facades\DB;

function userPaises(){
	$paises=DB::table('users')->select('pais')->distinct()->get();
	$data=array();
	foreach ($paises as $pais => $value) {
		$data[$value->pais]=null;
	}
	return json_encode($data);
}

function userEstados(){
	$estados=DB::table('users')->select('estado')->distinct()->get();
	$data=array();
	foreach ($estados as $estado => $value) {
		$data[$value->estado]=null;
	}
	return json_encode($data);
}

function userMunicipios(){
	$municipios=DB::table('users')->select('municipio')->distinct()->get();
	$data=array();
	foreach ($municipios as $municipio => $value) {
		$data[$value->municipio]=null;
	}
	return json_encode($data);
}

function userBancos(){
	$bancos = DB::table('users')->select('banco')->distinct()->get();
	$data = array();
	foreach ($bancos as $banco => $value) {
		$data[$value->banco] = null;
	}
	return json_encode($data);
}

function claveBancaria($estado,$id,$tipo){
	$prefijo = 0;
	$posfijo = 0;
	switch ($estado) {
		case "Aguascalientes":
		$clave = "AG";
		$prefijo = 17;
		break;
		case "Baja California":
		$clave="BC";
		$prefijo = 23;
		break;
		case "Baja California Sur":
		$clave="BS";
		$prefijo = 22;
		break;
		case "Campeche":
		$clave="CC";
		$prefijo = 33;
		break;
		case "Chiapas":
		$clave="CS";
		$prefijo = 32;
		break;
		case "Chihuahua":
		$clave="CH";
		$prefijo = 38;
		break;
		case "Coahuila":
		$clave="CL";
		$prefijo = 33;
		break;
		case "Colima":
		$clave="CM";
		$prefijo = 34;
		break;
		case "Distrito Federal":
		$clave="DF";
		$prefijo = 46;
		break;
		case "Durango":
		$clave="DR";
		$prefijo = 49;
		break;
		case "Guanajuato":
		$clave="GN";
		$prefijo = 75;
		break;
		case "Guerrero":
		$clave="GR";
		$prefijo = 79;
		break;
		case "Hidalgo":
		$clave="HD";
		$prefijo = 84;
		break;
		case "Jalisco":
		$clave="JL";
		$prefijo = 13;
		break;
		case "Mexico":
		case "México":
		$clave="MX";
		$prefijo = 47;
		break;
		case "Michoacan":
		case "Michoacán":
		$clave="MC";
		$prefijo = 43;
		break;
		case "Morelos":
		$clave="MR";
		$prefijo = 49;
		break;
		case "Nayarit":
		$clave="NY";
		$prefijo = 58;
		break;
		case "Nuevo Leon":
		case "Nuevo León":
		$clave="NL";
		$prefijo = 53;
		break;
		case "Oaxaca":
		$clave="OX";
		$prefijo = 67;
		break;
		case "Puebla":
		$clave="PB";
		$prefijo = 72;
		break;
		case "Queretaro":
		case "Querétaro":
		$clave="QU";
		$prefijo = 84;
		break;
		case "Quintana Roo":
		$clave="QR";
		$prefijo = 89;
		break;
		case "San Luis Potosi":
		case "San Luis Potosí":
		$clave="SL";
		$prefijo = 23;
		break;
		case "Sinaloa":
		$clave="SN";
		$prefijo = 25;
		break;
		case "Sonora":
		$clave="SR";
		$prefijo = 29;
		break;
		case "Tabasco":
		$clave="TB";
		$prefijo = 32;
		break;
		case "Tamaulipas":
		$clave="TM";
		$prefijo = 34;
		break;
		case "Tlaxcala":
		$clave="TX";
		$prefijo = 37;
		break;
		case "Veracruz":
		$clave="VR";
		$prefijo = 59;
		break;
		case "Yucatan":
		case "Yucatán":
		$clave="YC";
		$prefijo = 83;
		break;
		case "Zacatecas":
		$clave="ZC";
		$prefijo = 93;
		break;
		default:
		$clave="EX";
		$prefijo = 57;
		break;
	}
	switch ($tipo) {
        case "D"://medico
        $posfijo = 4;
        break;
        case "P"://paciente
        $posfijo = 7;
        break;
        case "A"://administrador
        $posfijo = 9;
        break;
        case "S"://administrador sucursal
        $posfijo = 2;
        break;
    }
    $num="";
    for($x=0; $x < 6-strlen($id); $x++){
    	$clave = $clave."0";
    	$num = $num."0";
    }      
    $clave = $clave.$id;
    $referencia = $prefijo.$num.$id.$posfijo;
    $ref = str_split ($referencia);
    $alg = str_split ("212121212");
    $mult = array();
    $ver = 0; 
    for ($x = 0; $x < 9; $x++){
    	$mult[$x] = $ref[$x] * $alg[$x];
    	if ($mult[$x] > 9){
    		$dig = str_split($mult[$x]);
    		$mult[$x] = $dig[0] + $dig[1];
    	}
    	$ver += $mult[$x];
    }
    $Y = fmod($ver, 10);
    if($Y>0)
    	$Y=10-$Y;
    $clave = $clave.$tipo.$Y;
    return $clave;
}

?>