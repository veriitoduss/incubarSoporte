<?php
include "Helpers/sesiones.php";
include "Views/Layouts/Administrador/head.php";
include "Views/Layouts/Administrador/menu.php"; ?>

<div class="content-page">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header-title">
            <ol class="breadcrumb pull-right">
              <li><a href="<?php echo base_url(); ?>administrador"><?php echo $data['administrador'] ?></a></li>
              <li>Adiciones</li>
              <li class="active"><?php echo $data['titulo'] ?></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Proyecto</h4>
            </div>
            <div class="panel-body">
              <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarProyecto">
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="nombre_proyecto">Nombre del proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre del proyecto</span>
                    <input required type="text" id="nombre_proyecto" name="nombre_proyecto" class="form-control" id="exampleInputEmail1">
                    <input type="hidden" name="eliminar" id="eliminar" value="0">
                    <input type="hidden" name="fecha_eliminado" id="fecha_eliminado" value="0">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="identificador_proyecto">Identificador del proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el identificador del proyecto. Recuerde que el identificador es en mayúscula</span>
                    <input required type="text" id="identificador_proyecto" name="identificador_proyecto" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <button type="submit" class="btn btn-dark waves-effect waves-light">Agregar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">Proyectos</h4>
            </div>
            <div class="panel-body">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nombre Proyecto</th>
                    <th>Identificador</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['proyectos'] as $proyecto) { ?>
                    <tr>
                      <td><?php echo $proyecto['nombre_proyecto']; ?></td>
                      <td><?php echo $proyecto['identificador_proyecto']; ?></td>
                      <td style="text-align:center;">
                        <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto<?php echo $proyecto['id_proyecto']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                        <div id="myModalProyecto<?php echo $proyecto['id_proyecto']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalProyectoLabel">Modificar Proyecto</h4>
                                <!-- <?php echo $proyecto['id_proyecto']; ?> -->
                              </div>
                              <form role="form" class="formularioproyecto" method="post" action="<?php base_url(); ?>ModificarProyecto">
                                <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $proyecto['id_proyecto']; ?>">
                                <div class="modal-body">
                                  <div class="text-center" style="margin-top: 10px;">
                                    <label style="display:block" for="nombre_proyecto">Nombre del proyecto</label>
                                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" value="<?php echo $proyecto['nombre_proyecto']; ?>" class="form-control" style="width: 60%;text-align:center;">
                                  </div>
                                  <div class="text-center" style="margin-top: 20px;margin-bottom:20px">
                                    <label style="display:block" for="identificador_proyecto">Identificador</label>
                                    <input type="text" id="identificador_proyecto" name="identificador_proyecto" value="<?php echo $proyecto['identificador_proyecto']; ?>" class="form-control" style="width: 60%;text-align:center;">
                                  </div>
                                </div>
                                <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button><button type="submit" class="botonModalModificar">Modificar</button></div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <a type="button" class="buttonELiminar" data-toggle="modal" data-target="#myModalEliminarProyecto<?php echo $proyecto['id_proyecto']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                        <div id="myModalEliminarProyecto<?php echo $proyecto['id_proyecto']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarProyectoLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <form role="form" class="formularioProyecto" method="post" action="<?php base_url(); ?>EliminarProyecto">
                                <div class="modal-body">
                                  <div class="text-center">
                                    <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                    <h3 style="margin-top: 30px">Estas seguro?</h3>
                                    <h5> de eliminar el proyecto</h5>
                                    <h7><?php echo $proyecto['nombre_proyecto']; ?></h7>
                                    <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $proyecto['id_proyecto']; ?>">
                                    <input type="hidden" name="eliminar" id="eliminar" value="1">

                                    <div style="margin-top: 30px;"><button type="submit" class="botonModalElminarSi">Si</button> <button type="submit" class="botonModalElminarNo" data-dismiss="modal">No</button></div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
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
</div>
<?php
include "Views/Layouts/Administrador/footer.php"; ?>