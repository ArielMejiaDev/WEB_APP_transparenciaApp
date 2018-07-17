<?php
class DatosUsuarioController{
	//funcion que develvera los datos a mostrar del usuario
	public function getDatosUsuarioController(){
		$respuesta = DatosUsuarioModel::getDatosUsuarioModel($_SESSION['usuario'],"usuarios");
		return $respuesta;
	}
}