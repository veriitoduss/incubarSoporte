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
      <form method="post" action="<?php base_url(); ?>AgregarRol">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-primary text-center">
              <div class="panel-heading">
                <h4 class="panel-title">Agregar Rol</h4>
              </div>
              <div class="panel-body">
                <div class="form-group" style="text-align: left;" style="text-align: left;">
                  <label style="padding-bottom:10px;font-size:15px" for="nombre_rol">Nombre del rol</label>
                  <span style="display: block; padding-bottom:20px;font-size:12px">Por favor ingrese el nombre del rol</span>
                  <input type="text" id="nombre_rol" name="nombre_rol" class="form-control" id="exampleInputEmail1">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-primary text-center">
              <div class="panel-heading">
                <h4 class="panel-title">Roles</h4>
              </div>
              <div class="panel-body">
                <?php
                foreach ($data['roles'] as $rol) { ?>
                  <div class="col-sm-5 listarContenedor">
                    <!-- <div class="panel-body"> -->
                    <scan style="padding:2px;padding-left:10px"><?php echo $rol['nombre_rol']; ?></scan>
                    <div style="margin-left:auto;padding-right:20px">
                      <a href="" style="color:white;margin-right:10px;padding-top:5px"><i class="fa-solid fa-pen-to-square"></i></a>
                      <a href="" style="color:white;"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                    <!-- </div> -->
                  </div>
                <?php }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-primary text-center">
              <div class="panel-heading">
                <h4 class="panel-title">Permisos por Rol</h4>
              </div>
              <div class="panel-body" style="margin: -25px">
                <?php
                foreach ($data['permisos'] as $permiso) { ?>
                  <div class="col-md-4">
                    <div class="container" style="width: 300px;">
                      <label class="option_item" title="<?php echo $permiso['permiso']; ?>">
                        <input type="checkbox" class="checkbox" value="<?php echo $permiso['id_permiso']; ?>" name="id_permiso[]" id="id_permiso" style="opacity: 0;">
                        <div class="option_inner">
                          <div class="tickmark"></div>
                          <div class="name"><?php echo $permiso['descripcion_permiso']; ?></div>
                        </div>
                      </label>
                    </div>
                  </div>
                <?php }
                ?>
              </div>
              <button type="submit" class="btn btn-dark waves-effect waves-light" style="margin-bottom:25px;margin-top:20px">Agregar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
include "Views/Layouts/Administrador/footer.php"; ?>