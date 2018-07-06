<?php
class DashboardController{
	// imprime el numero de usuarios
	public function contarUsuariosController()
	{
		$respuesta = DashboardModel::contarUsuariosModel("usuarios");
		echo $respuesta['total'];
	}
	//IMPRIME EL NUMERO DE DOCUMENTOS PUBLICADOS
	public function contarDocsPublicadosController()
	{
		$respuesta = DashboardModel::contarDocsPublicadosModel('documentos');
		echo $respuesta['total'];
	}
	//IMPRIME EL NUMERO DE DOCUMENTOS APROBADOS
	public function contarDocsAprobadosController()
	{
		$respuesta = DashboardModel::contarDocsAprobadosModel('documentos');
		echo $respuesta['total'];
	}
	//IMPRIME EL NUMERO DE DOCUMENTOS RECHAZADOS
	public function contarDocsRechazadosController()
	{
		$respuesta = DashboardModel::contarDocsRechazadosModel('documentos');
		echo $respuesta['total'];
	}
}