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
              <li class="active">requerimiento</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Requerimiento</h4>
            </div>
            <div class="panel-body">
              <form role="form" class="formularioRequerimiento" method="post" action="<?php base_url(); ?>AgregarRequerimiento">
                <div class="col-sm-12">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="tipo_requerimiento">Nombre del requerimiento</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre del requerimiento</span>
                    <input required type="text" id="tipo_requerimiento" name="tipo_requerimiento" class="form-control" id="exampleInputEmail1">
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
              <h4 class="panel-title">Tipo Requerimiento</h4>
            </div>
            <div class="panel-body">
              <?php
              foreach ($data['requerimientos'] as $requerimiento) { ?>
                <div class="col-md-5 listarContenedor" style="margin-left: 25px">
                  <scan style="padding:2px;padding-left:10px;"><?php echo $requerimiento['tipo_requerimiento']; ?></scan>
                  <div style="margin-left:auto;padding-right:20px">
                    <a type="button" data-toggle="modal" style="color:white;margin-right:10px;padding-top:5px;cursor:pointer" data-target="#myModalrequerimiento<?php echo $requerimiento['id_tipo_requerimiento']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                    <div id="myModalrequerimiento<?php echo $requerimiento['id_tipo_requerimiento']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalrequerimientoLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalrequerimientoLabel">Modificar tipo de requerimiento</h4>
                            <!-- <?php echo $requerimiento['id_tipo_requerimiento']; ?> -->
                          </div>
                          <form role="form" class="formulariorequerimiento" method="post" action="<?php base_url(); ?>ModificarRequerimiento">
                            <input type="hidden" name="id_tipo_requerimiento" id="id_tipo_requerimiento" value="<?php echo $requerimiento['id_tipo_requerimiento']; ?>">
                            <div class="modal-body">
                              <div class="text-center" style="margin-top: 10px;">
                                <label style="display:block;color:black" for="tipo_requerimiento">Nombre del requerimiento</label>
                                <input type="text" id="tipo_requerimiento" name="tipo_requerimiento" value="<?php echo $requerimiento['tipo_requerimiento']; ?>" class="form-control" style="width: 60%;text-align:center;margin:auto">
                              </div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button><button type="submit" class="botonModalModificar">Modificar</button></div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <a type="button" style="color:white;cursor:pointer" data-toggle="modal" data-target="#myModalEliminarrequerimiento<?php echo $requerimiento['id_tipo_requerimiento']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                    <div id="myModalEliminarrequerimiento<?php echo $requerimiento['id_tipo_requerimiento']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarrequerimientoLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <form role="form" class="formulariorequerimiento" id="formularioAgente" method="post" action="<?php base_url(); ?>EliminarRequerimiento">
                            <div class="modal-body">
                              <div class="text-center">
                                <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                <h3 style="margin-top: 30px">Estas seguro?</h3>
                                <h5> de eliminar el requerimiento</h5>
                                <h7 style="color:black"><?php echo $requerimiento['tipo_requerimiento']; ?></h7>
                                <input type="hidden" name="id_tipo_requerimiento" id="id_tipo_requerimiento" value="<?php echo $requerimiento['id_tipo_requerimiento']; ?>">
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