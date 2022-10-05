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
              <h4 class="panel-title">Agregar Estado</h4>
            </div>
            <div class="panel-body">
              <form role="form" class="formularioestado" method="post" action="<?php base_url(); ?>AgregarEstado">
                <div class="col-sm-12">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="estado">Nombre del Estado</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre del estado</span>
                    <input required type="text" id="estado" name="estado" class="form-control" id="exampleInputEmail1">
                    <input type="hidden" name="eliminar" id="eliminar" value="0">
                    <input type="hidden" name="fecha_eliminado" id="fecha_eliminado" value="0">
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
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Estados</h4>
            </div>
            <div class="panel-body">
              <?php
              foreach ($data['estados'] as $estado) { ?>
                <div class="col-md-5 listarContenedor" style="margin-left: 25px">
                  <scan style="padding:2px;padding-left:10px;"><?php echo $estado['estado']; ?></scan>
                  <div style="margin-left:auto;padding-right:20px">
                    <a type="button" data-toggle="modal" style="color:white;margin-right:10px;padding-top:5px;cursor:pointer" data-target="#myModalEstado<?php echo $estado['id_estado']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                    <div id="myModalEstado<?php echo $estado['id_estado']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEstadoLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalEstadoLabel">Modificar Estados</h4>
                            <!-- <?php echo $estado['id_estado']; ?> -->
                          </div>
                          <form role="form" class="formularioestado" method="post" action="<?php base_url(); ?>ModificarEstado">
                            <input type="hidden" name="id_estado" id="id_estado" value="<?php echo $estado['id_estado']; ?>">
                            <div class="modal-body">
                              <div class="text-center" style="margin-top: 10px;">
                                <label style="display:block;color:black" for="estado">Nombre del Estado</label>
                                <input type="text" id="estado" name="estado" value="<?php echo $estado['estado']; ?>" class="form-control" style="width: 60%;text-align:center;margin:auto">
                              </div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button><button type="submit" class="botonModalModificar">Modificar</button></div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <a type="button" style="color:white;cursor:pointer" data-toggle="modal" data-target="#myModalEliminarEstado<?php echo $estado['id_estado']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                    <div id="myModalEliminarEstado<?php echo $estado['id_estado']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarEstadoLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <form role="form" class="formularioEstado" id="formularioAgente" method="post" action="<?php base_url(); ?>EliminarEstado">
                            <div class="modal-body">
                              <div class="text-center">
                                <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                <h3 style="margin-top: 30px">Estas seguro?</h3>
                                <h5> de eliminar el Estado</h5>
                                <h7 style="color:black"><?php echo $estado['estado']; ?></h7>
                                <input type="hidden" name="id_estado" id="id_estado" value="<?php echo $estado['id_estado']; ?>">
                                <input type="hidden" name="eliminar" id="eliminar" value="1">

                                <div style="margin-top: 30px;"><button type="submit" class="botonModalElminarSi">Si</button> <button type="submit" class="botonModalElminarNo" data-dismiss="modal">No</button></div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "Views/Layouts/Administrador/footer.php"; ?>