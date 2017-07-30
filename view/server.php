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
$ns = $_SERVER["DOCUMENT_ROOT"] . "/server/view/server.php";
$server->configurewsdl('ProurbanWSDL', $ns);


//Obtiene un usuario
$server->register("Autenticacion",
			array('usuario' => 'xsd:string','clave' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

//Lista de usuarios recibe usuario y contraseña para validar logueo
$server->register("CargaMenu",
			array('usuario_id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

//Lista de proveedores
$server->register("ListaProveedores",
			array(),
			array('respuesta' => 'xsd:string'), $ns);

// agregar proveedor
$server->register("insertarProveedor",
			array('descripcion' => 'xsd:string','ruc' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

// modificar proveedor
$server->register("modificarProveedor",
			array('descripcion' => 'xsd:string','ruc' => 'xsd:string','id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

// eliminar  proveedor
$server->register("eliminarProveedor",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

// buscar  proveedor
$server->register("buscarProveedor",
			array('id' => 'xsd:string'),
			array('respuesta' => 'xsd:string'), $ns);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
