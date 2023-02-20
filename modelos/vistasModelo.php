<?php
	class vistasModelo{

		/*--------- Modelo obtener vistas ---------*/
		protected static function obtener_vistas_modelo($vistas){
			$listaBlanca=["formularioTickets","formularioTicket","restorePassword","listaTicket","adminIndex","adminAgente","adminCategoria","adminCliente","adminRoles","adminIdentificacion","adminPrioridad","adminProyecto","adminRequerimiento","adminEstado","respuestaTicket","ticketUsuario","creacionTicketUsuario"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenidos/".$vistas."View.php")){
					$contenido="./vistas/contenidos/".$vistas."View.php";
				}else{
					$contenido="404";
				}
			}elseif($vistas=="login" || $vistas=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}