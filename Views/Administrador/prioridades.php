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
              <li class="active">Prioridad</li>
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
                    <input type="text" id="nombre_prioridad" name="nombre_prioridad" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="exampleInputPassword1">Proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:12px">Porfavor seleccion el proyecto relacionado</span>
                    <select class="form-control" name="id_proyecto" id="id_proyecto">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "Views/Layouts/Administrador/footer.php"; ?>