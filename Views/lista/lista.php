<?php

include "Helpers/sesiones.php";
include "Views/Layouts/Soporte/head.php";
include "Views/Layouts/Soporte/header.php";
?>
<?php
// print_r($_SESSION["nombre_agente"]);
// print_r($_SESSION["id_agente"]);
// print_r($_SESSION["correo_agente"]);
// print_r($_SESSION["id_rol"]); 
?>

<head>
  <link href="<?php echo media(); ?>plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo media(); ?>plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo media(); ?>plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo media(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo media(); ?>css/icons.css" rel="stylesheet" type="text/css">
  <link href="<?php echo media(); ?>css/style.css" rel="stylesheet" type="text/css">

</head>
<div class="cuerpo" style="background-color:white !important">
  <div style="width: 100%">
    <div class="contenedorBotones" style="display: flex">
      <div>
        <a href="<?php base_url(); ?>tickets" style="background-color: #f9bf00 !important;"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>
        <!-- <div class=" text-center"> -->
        <!-- <a href="<?php base_url(); ?>tickets" style="background-color:white;color:#01562C"><i class="fa-solid fa-user-gear"></i>Configuracion Agente</a> -->
        <a type="button" style="background-color:white;color:#01562C" class="" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-user-gear"></i>Configuracion Agente</a>
        <!-- </div> -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel" style="color:#01562C">Configuracion Agente</h4>
              </div>
              <div class="modal-body">
                <p class="firma">firma</p>
                <div style="border:1px solid #969899;padding:15px;border-radius:2px">
                  <p>
                    <?php
                    print_r($_SESSION["nombre_agente"]); ?>
                    </p>
                  <p>Agente</p>
                  <p>MESA DE AYUDA</p>
                  <p>INCUBARHUILA</p>
                </div>
              </div>
              <div class="modal-footer"> <button type="button" class="botonCerrarModalLista" data-dismiss="modal">Cerrar</button>
              <button type="button" class="botonGuardarModalLista">Guardar ajustes</button></div>
            </div>
          </div>
        </div>
        <!-- <a href="<?php base_url(); ?>tickets" style="background-color:white;color:#01562C"><i class="fa-solid fa-user-gear"></i>Configuracion Agente</a> -->
        <a href="<?php base_url(); ?>tickets" style="background-color:white;color:#01562C"><i class="fa-solid fa-retweet"></i>Restablecer filtros</a>
        <a href="<?php base_url(); ?>tickets" style="background-color:white;color:#01562C"><i class="fa-solid fa-download"></i>Descargar Listas</a>
        <a href="<?php base_url(); ?>administrador" style="background-color:white;color:#01562C"><i class="fa-solid fa-user-shield"></i>Admin</a>
      </div>
      <div style="margin-left:auto;padding-right:20px">
        <a href="<?php base_url(); ?>home/cerrarSesion" style="background-color: #f9bf00 !important;"><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <div class="panel panel-primary" style="box-shadow: none">
          <div class="panel-body">
            <div class="row">
              <div class="text-left contenedorFiltros">
                <div class="panel-heading">
                  <h4 class="tituloFiltro">
                    <p><a href=""><i class="fa-solid fa-filter"></i> Filtros</a></p>
                  </h4>
                </div>
                <div class="panel-body">
                  <div class="contenidoFiltro">
                    <p><a href="">Todos los tickets</a></p>
                    <p><a href="">No resuelto</a></p>
                    <p><a href="">Mio</a></p>
                    <p><a href="">Eliminado</a></p>
                    <p><a href="">sin asignar</a></p>
                    <p><a href="">Cerrado</a></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="text-left contenedorFiltros" style="margin-top:20px">
                <div class="panel-heading">
                  <h4 class="tituloFiltro">
                    <p><a href=""><i class="fa-solid fa-filter"></i> Filtros guardados</a></p>
                  </h4>
                </div>
                <div class="panel-body">
                  <div class="contenidoFiltro">
                    <p><a href="">No se han encontrado filtros!</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-10">
        <div class="panel panel-primary" style="box-shadow: none">
          <div class="panel-body" style="margin-top:40px">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Numero ticket</th>
                  <th>Nombre(s) y Apellido(s)</th>
                  <th>Asunto</th>
                  <th>Fecha de Creacion</th>
                  <th>estado</th>
                  <th>Fecha cierre</th>
                  <th>Categoria</th>
                  <th>Prioridad</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data['tickets'] as $ticket) { ?>
                  <tr>
                    <td><?php echo $ticket['numero_ticket']; ?></td>
                    <td><?php echo $ticket['nombre_apellido_usuario']; ?></td>
                    <td><?php echo $ticket['asunto']; ?></td>
                    <td><?php echo $ticket['fecha_creacion_ticket']; ?></td>
                    <td><?php echo $ticket['estado']; ?></td>
                    <td><?php echo $ticket['fecha_respuesta']; ?></td>
                    <td><?php echo $ticket['nombre_categoria']; ?></td>
                    <td><?php echo $ticket['nombre_prioridad']; ?></td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php include "Views/Layouts/Soporte/footer.php"; ?>