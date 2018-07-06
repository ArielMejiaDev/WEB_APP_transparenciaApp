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
	//IMPRIME UN LISTADO DE LOS ULTIMOS 5 DOCUMENTOS SUBIDOS AL SERVIDOR
	public function docsSubidosRecientesController()
	{
		$respuesta = DashboardModel::docsSubidosRecientesModel('usuarios','documentos');
		foreach ($respuesta as $key => $value)
		{
			if ($value['status']==1)
			{
				$labelStatus = '<td class="text-warning">Pendiente</td>';
			}elseif ($value['status']==2){
				$labelStatus = '<td class="text-warning">Aprobado</td>';
			}elseif ($value['status']==3){
				$labelStatus = '<td class="text-primary">Publicado</td>';
			}elseif ($value['status']==4){
				$labelStatus = '<td class="text-danger">Rechazado</td>';
			}elseif ($value['status']==5){
				$labelStatus = '<td class="text-danger">Extemporaneo</td>';
			}
			echo '<tr>
				<td>'.$value['nombres'].' '.$value['apellidos'].'</td>
				<td class="number">'.$value['n_doc'].'</td>
				<td>'.$value['fecha_doc'].'</td>
				'.$labelStatus.'
				<td class="actions"><a href="#" class="icon"><i class="mdi mdi-plus-circle-o"></i></a></td>
			</tr>';
		}
	}
	//IMPRIME EL TOTAL DE ARCHIVOS EN EL SERVIDOR
	public function totalDocsServidorController()
	{
		$respuesta = DashboardModel::totalDocsServidorModel('documentos');
		return $respuesta['total'];
	}
	//IMPRIME LA TABLA DE VITACORA
	public function listarVitacoraController()
	{
		$respuesta = DashboardModel::listarVitacoraModel('usuarios', 'vitacora');
		foreach ($respuesta as $key => $value) {
			echo '<tr>
				<td class="user-avatar"> <img src="'.$value['foto'].'" alt="Avatar"><small style="font-size:9px">'.$value['nombres'].' '.$value['apellidos'].'</small></td>
				<td>'.$value['desc_actividad'].'</td>
				<td>'.$value['hora'].'</td>
				<td class="actions"><a href="#" class="icon"><i class="mdi mdi-assignment-account"></i></a></td>
			</tr>';
		}
	}
}