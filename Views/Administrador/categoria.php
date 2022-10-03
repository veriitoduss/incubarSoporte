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
              <li class="active">Categoria</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Categoria</h4>
            </div>
            <div class="panel-body">
              <form role="form" class="formularioPrioridad" id="formularioAgente" method="post" action="<?php base_url(); ?>AgregarCategoria">
                <div class="form-group" style="text-align: left;" style="text-align: left;">
                  <label style="padding-bottom:10px;font-size:15px" for="nombre_categoria">Nombre de la categoria</label>
                  <span style="display: block; padding-bottom:20px;font-size:12px">Inserte el nombre de la categoría. Por favor, asegúrese de que el nombre de la categoría que está ingresando no debe existir ya.</span>
                  <input type="text" id="nombre_categoria" name="nombre_categoria" class="form-control" id="exampleInputEmail1">
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
              <h4 class="panel-title">Roles</h4>
            </div>
            <div class="panel-body">
              <?php
              foreach ($data['categorias'] as $categoria) { ?>
                <div class="col-md-5 listarContenedor" style="margin-left: 25px">
                  <!-- <div class="panel-body"> -->
                  <scan style="padding:2px;padding-left:10px;"><?php echo $categoria['nombre_categoria']; ?></scan>
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
        <!-- <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Categorias</h4>
            </div>
            <div class="panel-body">
              <div style="display: grid;grid-template-columns:33.33% 33.33% 33.33%;grid-gap: 5px;">
                <?php
                foreach ($data['categorias'] as $categoria) { ?>
                  <div style="display: flex; background-color:green; border-radius:8px;padding: 5px 0 0 20px;margin-right:5px;color:white">
                    <div>
                      <p><?php echo $categoria['nombre_categoria']; ?></p>
                    </div>
                    <div style="margin-left:auto;padding-right:20px">
                      <a href="" style="color:white;margin-right:10px"><i class="fa-solid fa-pen-to-square"></i></a>
                      <a href="" style="color:white"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
<?php
include "Views/Layouts/Administrador/footer.php"; ?>