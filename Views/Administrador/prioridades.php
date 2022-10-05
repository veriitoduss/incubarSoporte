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
              <h4 class="panel-title">Agregar Prioridad</h4>
            </div>
            <div class="panel-body">
              <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarPrioridad">
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="nombre_prioridad">Nombre de la prioridad</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre de la prioridad</span>
                    <input required type="text" id="nombre_prioridad" name="nombre_prioridad" class="form-control" id="exampleInputEmail1">
                    <input type="hidden" name="eliminar" id="eliminar" value="0">
                    <input type="hidden" name="fecha_eliminado" id="fecha_eliminado" value="0">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="exampleInputPassword1">Proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Por favor seleccione el proyecto relacionado</span>
                    <select required class="form-control" name="id_proyecto" id="id_proyecto">
                      <option></option>
                      <?php
                      foreach ($data['proyectos'] as $proyecto) { ?>
                        <option value="<?php echo $proyecto['id_proyecto']; ?>"><?php echo $proyecto['nombre_proyecto']; ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>
                  <!-- <div class="form-group"> <label for="exampleInputPassword1">Password</label> <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div> -->
                  <!-- <div id="sparkline1" style="margin: 0 -21px -22px -22px;"></div> -->
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
              <h4 class="panel-title">Prioridades</h4>
            </div>
            <div class="panel-body">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nombre Prioridad</th>
                    <th>Proyecto</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['prioridades'] as $prioridad) { ?>
                    <tr>
                      <td><?php echo $prioridad['nombre_prioridad']; ?> </td>
                      <td><?php echo $prioridad['nombre_proyecto']; ?></td>
                      <td style="text-align:center">
                        <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalPrioridades<?php echo $prioridad['id_prioridad']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                        <div id="myModalPrioridades<?php echo $prioridad['id_prioridad']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalPrioridadesLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalPrioridadesLabel">Modificar Prioridad</h4>
                                <!-- <?php echo $prioridad['id_prioridad']; ?> -->
                              </div>
                              <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>ModificarPrioridad">
                                <input type="hidden" name="id_prioridad" id="id_prioridad" value="<?php echo $prioridad['id_prioridad']; ?>">
                                <div class="modal-body">
                                  <div class="text-center" style="margin-top: 10px;">
                                    <label style="display:block" for="nombre_prioridad">Nombre de la prioridad</label>
                                    <input type="text" id="nombre_prioridad" name="nombre_prioridad" value="<?php echo $prioridad['nombre_prioridad']; ?>" class="form-control" style="width: 80%;">
                                  </div>
                                  <div class="text-center" style="margin-top: 20px;margin-bottom:20px">
                                    <label for="id_proyecto" style="display:block">Proyecto</label>
                                    <select class="form-control" name="id_proyecto" id="id_proyecto" style="width: 80%;">
                                      <option value="<?php echo $prioridad['id_proyecto']; ?>"><?php echo $prioridad['nombre_proyecto']; ?></option>
                                      <?php
                                      foreach ($data['proyectos'] as $proyecto) { ?>
                                        <option value="<?php echo $proyecto['id_proyecto']; ?>"><?php echo $proyecto['nombre_proyecto']; ?></option>
                                      <?php }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button><button type="submit" class="botonModalModificar">Modificar</button></div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <a type="button" class="buttonELiminar" data-toggle="modal" data-target="#myModalEliminarPrioridad<?php echo $prioridad['id_prioridad']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                        <div id="myModalEliminarPrioridad<?php echo $prioridad['id_prioridad']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarPrioridadLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>EliminarPrioridad">
                                <div class="modal-body">
                                  <div class="text-center">
                                    <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                    <h3 style="margin-top: 30px">Estas seguro?</h3>
                                    <h5> de eliminar</h5>
                                    <h7><?php echo $prioridad['nombre_prioridad']; ?></h7>
                                    <input type="hidden" name="id_prioridad" id="id_prioridad" value="<?php echo $prioridad['id_prioridad']; ?>">
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