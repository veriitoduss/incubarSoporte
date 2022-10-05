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
          <ul class="agentesAdmin">
            <li><a href="#AgregarAgente"><span>Agregar</span></a></li>
            <li><a href="#ListarAgentes"><span>Clientes</span></a></li>
          </ul>
          <div class="panel panel-primary text-center">
            <div class="seccionesAgentes">
              <section id="AgregarAgente">
                <div class="panel-heading">
                  <h4 class="panel-title">Agregar cliente</h4>
                </div>
                <div class="panel-body">
                  <form role="form" class="formulariocliente" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarClientes">
                    <div class="col-sm-6">
                      <div class="form-group" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="id_proyecto">Proyecto</label>
                        <span style="display: block; padding-bottom:20px;font-size:12px">Por favor seleccione el proyecto relacionado</span>
                        <select class="form-control" name="id_proyecto[]" id="id_proyecto[]" require>
                          <option></option>
                          <?php
                          foreach ($data['proyectos'] as $proyecto) { ?>
                            <option value="<?php echo $proyecto['id_proyecto']; ?>"><?php echo $proyecto['nombre_proyecto']; ?></option>
                          <?php }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group" style="text-align: left;" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="nombre_cliente">Nombre del cliente</label>
                        <span style="display: block; padding-bottom:20px;font-size:12px">Por favor ingrese cliente(s). La nueva opción debería comenzar en la nueva línea.</span>
                        <p><textarea name="nombre_cliente" cols="90" required class="form-control"></textarea></p>
                        <input type="hidden" name="eliminar" id="eliminar" value="0">
                        <input type="hidden" name="fecha_eliminado" id="fecha_eliminado" value="0">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Agregar</button>
                  </form>
                </div>
              </section>
              <section id="ListarAgentes">
                <div class="panel-heading">
                  <h4 class="panel-title">Clientes</h4>
                </div>
                <div class="panel-body">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Cliente</th>
                        <th>Proyecto</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($data['cliente'] as $Clientes) { ?>
                        <tr>
                          <td><?php echo $Clientes['nombre_cliente']; ?></td>
                          <td><?php echo $Clientes['nombre_proyecto']; ?></td>
                          <td style="text-align:center;">
                            <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalclientees<?php echo $Clientes['id_cliente']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                            <div id="myModalclientees<?php echo $Clientes['id_cliente']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalclienteesLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalclienteesLabel">Modificar cliente</h4>
                                    <!-- <?php echo $Clientes['id_cliente']; ?> -->
                                  </div>
                                  <form role="form" class="formulariocliente" id="formularioAgente" method="post" action="<?php base_url(); ?>ModificarCliente">
                                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $Clientes['id_cliente']; ?>">
                                    <div class="modal-body">
                                      <div class="text-center" style="margin-top: 10px;">
                                        <label style="display:block" for="nombre_cliente">Nombre del cliente</label>
                                        <input type="text" id="nombre_cliente" name="nombre_cliente" value="<?php echo $Clientes['nombre_cliente']; ?>" class="form-control" style="width: 80%;">
                                        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $Clientes['id_cliente']; ?>">

                                      </div>
                                      <div class="text-center" style="margin-top: 20px;margin-bottom:20px">
                                        <label for="id_proyecto" style="display:block">Proyecto</label>
                                        <select class="form-control" name="id_proyecto" id="id_proyecto" style="width: 80%;">
                                          <option value="<?php echo $Clientes['id_proyecto']; ?>"><?php echo $Clientes['nombre_proyecto']; ?></option>
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

                            <!-- <a href=""><i class="fa-solid fa-trash-can"></i></a> -->
                            <a type="button" class="buttonELiminar" data-toggle="modal" data-target="#myModalEliminarcliente<?php echo $Clientes['id_cliente']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                            <div id="myModalEliminarcliente<?php echo $Clientes['id_cliente']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarclienteLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <form role="form" class="formulariocliente" id="formularioAgente" method="post" action="<?php base_url(); ?>EliminarCliente">
                                    <div class="modal-body">
                                      <div class="text-center">
                                        <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                        <h3 style="margin-top: 30px">Estas seguro?</h3>
                                        <h5> de eliminar el cliente</h5>
                                        <h7><?php echo $Clientes['nombre_cliente']; ?></h7>
                                        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $Clientes['id_cliente']; ?>">
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
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "Views/Layouts/Administrador/footer.php"; ?>
<script>
  $('ul.agentesAdmin li a:first').addClass('agenteActivo');
  $('.seccionesAgentes section').hide();
  $('.seccionesAgentes section:first').show();
  $('ul.agentesAdmin li a').click(function() {
    $('ul.agentesAdmin li a').removeClass('agenteActivo');
    $(this).addClass('agenteActivo');
    $('.seccionesAgentes section').hide();

    var activeTab = $(this).attr('href');
    $(activeTab).show();
    return false;
  });
</script>