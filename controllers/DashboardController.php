<?php
class DashboardController{
	// imprime el numero de usuarios
	public function contarUsuariosController(){
		$respuesta = DashboardModel::contarUsuariosModel("usuarios");
		echo $respuesta['total'];
	}
}