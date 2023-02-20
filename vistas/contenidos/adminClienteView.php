<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
include "./vistas/inc/headAdmin.php";
include "./vistas/inc/menuAdmin.php";
require_once "./controladores/clienteControlador.php";
$ins_cliente = new clienteControlador();
} else {
echo $lc->forzar_cierre_sesion_controlador();
exit();
}
?>
<div class="content-page">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header-title">
            <ol class="breadcrumb pull-right">
              <li><a href="<?php echo SERVERURL; ?>adminIndex/" style="color:black">Admin</a></li>
              <li style="cursor: pointer;color:black">Adiciones</li>
              <li class="active"><a href="<?php echo SERVERURL; ?>adminCliente/" style="color:black">Clientes</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar cliente</h4>
            </div>
            <div class="panel-body">
              <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" id="formularioCLiente" method="POST" data-form="save" autocomplete="off">
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label for="id_proyecto" style="padding-bottom:10px;font-size:15px" for="id_proyecto">Proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor seleccione el proyecto relacionado</span>
                    <select class="form-control" name="id_proyecto[]" id="id_proyecto[]" required>
                      <?php
                      echo $ins_cliente->mostrar_datosproyectoCliente_input_controlador();
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="nombre_cliente">Nombre del cliente</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor ingrese cliente(s). La nueva opción debería comenzar en la nueva línea.</span>
                    <p><textarea name="nombre_cliente" cols="90" required class="form-control"></textarea></p>
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
              <h4 class="panel-title">Clientes</h4>
            </div>
            <?php
            echo $ins_cliente->mostrar_datosclientes_controlador($pagina[1], $pagina[0])
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "./vistas/inc/footerAdmin.php";
?>