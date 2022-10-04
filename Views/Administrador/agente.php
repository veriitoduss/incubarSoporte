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
              <li class="active">Agente</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="agentesAdmin">
            <li><a href="#AgregarAgente"><span>Agregar</span></a></li>
            <li><a href="#ListarAgentes"><span>Agentes</span></a></li>
          </ul>
          <div class="panel panel-primary text-center">
            <div class="seccionesAgentes">
              <section id="AgregarAgente">
                <div class="panel-heading">
                  <h4 class="panel-title">Agregar agente soporte</h4>
                </div>
                <div class="panel-body">
                  <form role="form" class="formularioagente" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarAgentes">
                    <div class="col-sm-4">
                      <div class="form-group" style="text-align: left;" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="nombre_agente">Nombre(s) y Apellidos(s) del agente</label>
                        <span style="display: block; padding-bottom:20px;font-size:12px">Por favor ingrese su nombre(s) y apellido(s) del agente</span>
                        <input type="text" id="nombre_agente" require name="nombre_agente" class="form-control" id="exampleInputEmail1">
                        <input type="hidden" name="eliminar" id="eliminar" value="0">
                        <input type="hidden" name="fecha_eliminado" id="fecha_eliminado" value="0">

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group" style="text-align: left;">
                        <div class="form-group" style="text-align: left;" style="text-align: left;">
                          <label style="padding-bottom:10px;font-size:15px" for="correo_agente">Correo electronico</label>
                          <span style="display: block; padding-bottom:20px;font-size:12px">Porfavor ingrese el correo electronico</span>
                          <input type="email" id="correo_agente" require name="correo_agente" class="form-control" id="exampleInputEmail1">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="id_rol">Rol</label>
                        <span style="display: block; padding-bottom:20px;font-size:12px">Por favor seleccionar el rol</span>
                        <select class="form-control" name="id_rol" id="id_rol" require>
                          <option></option>
                          <?php
                          foreach ($data['roles'] as $rol) { ?>
                            <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['nombre_rol']; ?></option>
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
              </section>
              <section id="ListarAgentes">
                <div class="panel-heading">
                  <h4 class="panel-title">Agentes de soporte</h4>
                </div>
                <div class="panel-body">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nombre Agente</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($data['agentes'] as $agente) { ?>
                        <tr>
                          <td><?php echo $agente['nombre_agente']; ?></td>
                          <td><?php echo $agente['correo_agente']; ?></td>
                          <td><?php echo $agente['usuario_agente']; ?></td>
                          <td><?php echo $agente['nombre_rol']; ?></td>
                          <td style="text-align:center;">
                            <!-- <a href=""><i style="padding-right:10px" class="fa-solid fa-pen-to-square"></i></a> -->
                            <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalagentees<?php echo $agente['id_agente']; ?>"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                            <div id="myModalagentees<?php echo $agente['id_agente']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalagenteesLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalagenteesLabel">Modificar agente</h4>
                                    <!-- <?php echo $agente['id_agente']; ?> -->
                                  </div>
                                  <form role="form" class="formularioagente" id="formularioAgente" method="post" action="<?php base_url(); ?>ModificarAgente">
                                    <input type="hidden" name="id_agente" id="id_agente" value="<?php echo $agente['id_agente']; ?>">
                                    <div class="modal-body">
                                      <div class="text-center" style="margin-top: 10px;">
                                        <label style="display:block" for="nombre_agente">Nombre del agente</label>
                                        <input type="text" id="nombre_agente" name="nombre_agente" value="<?php echo $agente['nombre_agente']; ?>" class="form-control" style="width: 80%;text-align:center">
                                      </div>
                                      <div class="text-center" style="margin-top: 20px;">
                                        <label style="display:block" for="correo_agente">Correo del agente</label>
                                        <input type="text" id="correo_agente" name="correo_agente" value="<?php echo $agente['correo_agente']; ?>" class="form-control" style="width: 80%;text-align:center">
                                      </div>
                                      <div class="text-center" style="margin-top: 20px;margin-bottom:20px">
                                        <label for="id_rol" style="display:block">Rol</label>
                                        <select class="form-control" name="id_rol" id="id_rol" style="width: 80%;text-align:center">
                                          <option value="<?php echo $agente['id_rol']; ?>"><?php echo $agente['nombre_rol']; ?></option>
                                          <?php
                                          foreach ($data['roles'] as $rol) { ?>
                                            <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['nombre_rol']; ?></option>
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
                            <a type="button" class="buttonELiminar" data-toggle="modal" data-target="#myModalEliminarAgente<?php echo $agente['id_agente']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                            <div id="myModalEliminarAgente<?php echo $agente['id_agente']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEliminarAgenteLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <form role="form" class="formularioagente" id="formularioAgente" method="post" action="<?php base_url(); ?>EliminarAgente">
                                    <div class="modal-body">
                                      <div class="text-center">
                                        <i class="fa fa-exclamation-circle" style="color:#F9BF00;font-size:80px"></i>
                                        <h3 style="margin-top: 30px">Estas seguro?</h3>
                                        <h5> de eliminar el agente</h5>
                                        <h7><?php echo $agente['nombre_agente']; ?></h7>
                                        <input type="hidden" name="id_agente" id="id_agente" value="<?php echo $agente['id_agente']; ?>">
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