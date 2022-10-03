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
              <li><a href="#">Adiciones</a></li>
              <li class="active">Proyecto</li>
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
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre del cliente</span>
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="identificador_proyecto">Identificador</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el identificador del cliente</span>
                    <input type="text" id="identificador_proyecto" name="identificador_proyecto" class="form-control" id="exampleInputEmail1">
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
                        <a type="button" data-toggle="modal" data-target="#modalEditarProyecto<?php echo $proyecto['id_proyecto']; ?>" style="cursor:pointer"><i style="padding-right:10px" class="fa-solid fa-pen-to-square"></i></a>
                        <div id="modalEditarProyecto<?php echo $proyecto['id_proyecto']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEditarProyectoLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="modalEditarProyectoLabel">Modificar <?php echo $proyecto['nombre_proyecto']; ?></h4>
                              </div>
                              <div class="modal-body">
                                <form action="" method="POST" action="<?php base_url(); ?>MostrarPoryecto/ ?>">
                                <input type="hidden" name="id_proyecto" value="<?php echo $proyecto['id']; ?>">
                                  <div class="form-group" style="display:block;color:black">
                                    <label style="padding-bottom:10px;font-size:15px; display:block" for="nombre_proyecto">Nombre del proyecto</label>
                                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" value="<?php echo $proyecto['nombre_proyecto']; ?>" class="form-control" id="exampleInputEmail1">
                                  </div>
                                  <div class="form-group" style="display:block; margin-top:20px;color:black">
                                    <label style="padding-bottom:10px;font-size:15px;display:block" for="identificador_proyecto">Identificador</label>
                                    <input type="text" id="identificador_proyecto" name="identificador_proyecto" value="<?php echo $proyecto['identificador_proyecto']; ?>" class="form-control" id="exampleInputEmail1">
                                  </div>
                                  <button type="submit" class="btn btn-dark waves-effect waves-light" style="margin-top:20px">Modificar</button>
                                </form>
                              </div>
                              <div class="modal-footer"> <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button></div>
                            </div>
                          </div>
                        </div>
                        <!-- <a href=""><i style="padding-right:10px" class="fa-solid fa-pen-to-square"></i></a> -->
                        <a href=""><i class="fa-solid fa-trash-can"></i></a>
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