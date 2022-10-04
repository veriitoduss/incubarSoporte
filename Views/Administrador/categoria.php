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
              <li class="active">Categoría</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Categoría</h4>
            </div>
            <div class="panel-body">
              <form role="form" class="formulariocategoria" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarCategoria">
                <div class="form-group" style="text-align: left;" style="text-align: left;">
                  <label style="padding-bottom:10px;font-size:15px" for="nombre_categoria">Nombre de la categoría</label>
                  <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre de la categoría. Por favor, Asegúrese que el nombre de la categoría que está ingresando no exista.</span>
                  <input required type="text" id="nombre_categoria" name="nombre_categoria" class="form-control">
                  <input type="hidden" name="eliminar" id="eliminar" value="0">
                  <input type="hidden" name="fecha_eliminado" id="fecha_eliminado" value="0">

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
              <h4 class="panel-title">Categorías</h4>
            </div>
            <div class="panel-body">
              <?php
              foreach ($data['categorias'] as $categoria) { ?>
                <div class="col-md-5 listarContenedor" style="margin-left: 25px">
                  <scan style="padding:2px;padding-left:10px;"><?php echo $categoria['nombre_categoria']; ?></scan>
                  <div style="margin-left:auto;padding-right:20px">
                    <a type="button" data-toggle="modal" style="color:white;margin-right:10px;padding-top:5px;cursor:pointer" data-target="#myModalCategoria<?php echo $categoria['id_categoria']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                    <div id="myModalCategoria<?php echo $categoria['id_categoria']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalCategoriaLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalCategoriaLabel">Modificar Categoria</h4>
                            <!-- <?php echo $categoria['id_categoria']; ?> -->
                          </div>
                          <form role="form" class="formulariocategoria" method="post" action="<?php base_url(); ?>ModificarCategoria">
                            <input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
                            <div class="modal-body">
                              <div class="text-center" style="margin-top: 10px;">
                                <label style="display:block;color:black" for="nombre_categoria">Nombre de la categoria</label>
                                <input type="text" id="nombre_categoria" name="nombre_categoria" value="<?php echo $categoria['nombre_categoria']; ?>" class="form-control" style="width: 60%;text-align:center;margin:auto">
                              </div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button><button type="submit" class="botonModalModificar">Modificar</button></div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <a type="button" style="color:white;cursor:pointer" data-toggle="modal" data-target="#myModalEliminarCategoria<?php echo $categoria['id_categoria']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                    <div id="myModalEliminarCategoria<?php echo $categoria['id_categoria']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarCategoriaLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <form role="form" class="formulariocategoria" id="formularioAgente" method="post" action="<?php base_url(); ?>Eliminarcategoria">
                            <div class="modal-body">
                              <div class="text-center">
                                <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                <h3 style="margin-top: 30px">Estas seguro?</h3>
                                <h5> de eliminar la categoria</h5>
                                <h7 style="color:black"><?php echo $categoria['nombre_categoria']; ?></h7>
                                <input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
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