<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
// if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
include "./vistas/inc/headAdmin.php";
include "./vistas/inc/menuAdmin.php";
require_once "./controladores/agenteControlador.php";
$ins_Agente = new agenteControlador();
// } else {
// echo $lc->forzar_cierre_sesion_controlador();
// exit();
// }
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
              <li class="active"><a href="<?php echo SERVERURL; ?>adminAgente/" style="color:black">Agentes</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
            <h4 class="panel-title">Agregar agente soporte</h4>
            </div>
            <div class="panel-body">
            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/agenteAjax.php" id="formularioAgente" method="POST" data-form="save" autocomplete="off">
                    <div class="col-sm-4">
                      <div class="form-group" style="text-align: left;" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="nombre_agente">Nombre(s) y Apellido(s) del agente</label>
                        <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor ingrese el nombre(s) y apellido(s) del agente</span>
                        <input required type="text" id="nombre_agente"  name="nombre_agente" class="form-control" id="exampleInputEmail1">

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group" style="text-align: left;">
                        <div class="form-group" style="text-align: left;" style="text-align: left;">
                          <label style="padding-bottom:10px;font-size:15px" for="correo_agente">Correo electrónico</label>
                          <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor ingrese el correo electrónico</span>
                          <input required type="email" id="correo_agente" name="correo_agente" class="form-control" id="exampleInputEmail1">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group" style="text-align: left;">
                        <label style="padding-bottom:10px;font-size:15px" for="id_rol">Rol</label>
                        <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor seleccionar el rol</span>
                        <?php
                        echo $ins_Agente->mostrar_datosRoles_input_controlador();
                        ?>
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
              <h4 class="panel-title">Agentes de soporte</h4>
            </div>
            <?php
            echo $ins_Agente->mostrar_datosAgentes_controlador($pagina[1], $pagina[0])
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