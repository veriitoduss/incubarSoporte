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
            <li><a href="#ListarAgentes"><span>Clientes</span></a></li>
          </ul>
          <div class="panel panel-primary text-center">
            <div class="seccionesAgentes">
              <section id="AgregarAgente">
                <div class="panel-heading">
                  <h4 class="panel-title">Agregar cliente</h4>
                </div>
                <div class="panel-body">
                  <!-- <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarClientes">
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
                        <span style="display: block; padding-bottom:20px;font-size:12px">Por favor ingrese el nombre del cliente</span>
                        <textarea name="textarea" rows="10" cols="50">Write something here</textarea>
                        <input type="text" id="nombre_cliente[]" required name="nombre_cliente[]" class="form-control" id="exampleInputEmail1">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Agregar</button>
                  </form> -->
                  <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarPrueba">
                    <div class="col-sm-6">
                      <div class="form-group" style="text-align: left;" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="nombre_cliente">Nombre del cliente</label>
                        <span style="display: block; padding-bottom:20px;font-size:12px">Por favor ingrese el nombre del cliente</span>
                        <p><textarea rows="20" name="valores" cols="40"></textarea></p>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Agregar</button>
                  </form>
                </div>
              </section>
              <section id="ListarAgentes">
                <div class="panel-heading">
                  <h4 class="panel-title">Cliente</h4>
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
                            <a href=""><i style="padding-right:10px" class="fa-solid fa-pen-to-square"></i></a>
                            <a href=""><i class="fa-solid fa-trash-can"></i></a>
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