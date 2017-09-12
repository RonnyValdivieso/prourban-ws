<?php

error_reporting("E_ALL");
ini_set("display_errors", 1);
if (isset($HTTP_RAW_POST_DATA)) {
    $input = $HTTP_RAW_POST_DATA;
} else {
    $input = implode("\r\n", file('php://input'));
}
require_once('../lib/nusoap.php');
require('../model/model.php');

$server = new soap_server;
$ns = $_SERVER["DOCUMENT_ROOT"] . "/prourban-ws/view/server.php";
$server->configurewsdl('ProurbanWSDL', $ns);

//Seguridad---------------------------------------------

//	Obtiene un usuario
$server->register("Autenticacion",
array('usuario' => 'xsd:string', 'clave' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

//	Lista de usuarios recibe usuario y contraseña para validar logueo

//	Lista de opciones
$server->register("ListaOpciones",
array('rol_id' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

$server->register("ListaOpcionesRol",
array('rol_id' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

$server->register("getOpciones",
array(),
array('respuesta' => 'xsd:string'), $ns);

//	Busca rol
$server->register("BuscarRol",
array('id' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

//	Modifica rol
$server->register("AsignarOpciones",
array('id' => 'xsd:string', 'rol_id' => 'xsd:string', 'opcion_id' => 'xsd:string', 'estado' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

//	Crea rol
$server->register("InsertarRol",
array('descripcion' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);
//	Modifica rol
$server->register("ModificarRol",
array('id' => 'xsd:string', 'descripcion' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);
//	Elimina rol
$server->register("EliminarRol",
array('id' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

//	Lista de Rol
$server->register("ListaRol",
array(),
array('respuesta' => 'xsd:string'), $ns);



$server->register("BuscarUsuario",
array('id' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);

//	Crea rol
$server->register("InsertarUsuario",
array('nombre_usuario' => 'xsd:string','clave' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);
//	Modifica rol
$server->register("ModificarUsuario",
array('id' => 'xsd:string', 'nombre_usuario' => 'xsd:string', 'clave' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);
//	Elimina rol
$server->register("EliminarUsuario",
array('id' => 'xsd:string'),
array('respuesta' => 'xsd:string'), $ns);


$server->register("ListaUsuario",
array(),
array('respuesta' => 'xsd:string'), $ns);

$server->register("ListaPersona",
array(),
array('respuesta' => 'xsd:string'), $ns);

//Seguridad---------------------------------------------


//	PROVEEDOR
$server->register("ListaProveedores",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("InsertarProveedor",
			array('descripcion' => 'xsd:string', 'ruc' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("ModificarProveedor",
			array('id' => 'xsd:string', 'descripcion' => 'xsd:string', 'ruc' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("EliminarProveedor",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("BuscarProveedor",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);


//	CUENTAXPAGAR
$server->register("ListaCuentasxpagar",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("BuscarCuentaxpagar",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("InsertarCuentaxpagar",
			array('descripcion' => 'xsd:string', 'fecha' => 'xsd:string',
				  'total' => 'xsd:string', 'numero_referencia' => 'xsd:string',
				  'proveedor_id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("ModificarCuentaxpagar",
			array('id' => 'xsd:string', 'descripcion' => 'xsd:string',
				'fecha' => 'xsd:string', 'total' => 'xsd:string',
				'numero_referencia' => 'xsd:string', 'proveedor_id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("EliminarCuentaxpagar",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);


//	CUENTAXCOBRAR
$server->register("ListaCuentaxcobrar",
			array('nombrexBuscar' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("BuscarCuentaxcobrar",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("ModificarCuentaxcobrar",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);


//	FACTURA
$server->register("CabeceraFactura",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("DetalleFactura",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("ListaCabeceraFactura",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("PagarFactura",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("GuardarCabeceraFactura",
			array('fecha_factura' => 'xsd:string', 'numero_factura' => 'xsd:string', 'subtotal' => 'xsd:string', 'iva' => 'xsd:string', 'total' => 'xsd:string', 'formapago_id' => 'xsd:string', 'usuario_id' => 'xsd:string' ),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("GuardarDetalleFactura",
			array('valor' => 'xsd:string', 'conceptopago_id' => 'xsd:string', 'factura_id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("GuardarAsiento",
			array('fecha' => 'xsd:string', 'valor' => 'xsd:string', 'conceptoPago' => 'xsd:string', 'factura_id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

//	RESERVA
$server->register("ListaPreReservas",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("PagarReserva",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("BuscarPreReserva",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

// ASIENTOS
$server->register("ListaCuentas",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

$server->register("ListaAsiento",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>
