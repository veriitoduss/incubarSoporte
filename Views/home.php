<?php
// genera claves encriptadas
// echo password_hash('admin', PASSWORD_DEFAULT);exit;
include "Layouts/Soporte/head.php";
include "Layouts/Soporte/header.php"; ?>
<div class="cuerpo">
  <form method="post" action="<?php base_url(); ?>home/validar" class="formularioLogin" id="formularioLogin">
    <h1>Ingrese sus credenciales</h1>
    <input type="text" placeholder="Nombre de usuario o correo electrónico" name="usuario_agente" value="" id="usuario_agente">
    <input type="password" placeholder="Contraseña" name="contrasena_agente" id="contrasena_agente" value="" required>
    <div class="formCkeck">
      <div class="formCkeckContainer">
        <input type="checkbox" name="my-checkbox" id="opt-in">
        <label for="opt-in">recuerdame</label>
      </div>
      <div class="formCkeckOlvidarContraseña">
        <label>Has olvidado tu contraseña?</label>
      </div>
    </div>
    <div class="botonesLogin">
      <input type="submit" name="btnIniciarSesion" id="btnIniciarSesion" class="Login" value="Iniciar sesíon">

      <button class="Invitado" href="<?php echo base_url(); ?>tickets"><a href="<?php echo base_url(); ?>tickets">Continuar como invitado</a></button>
    </div>
  </form>
</div>

<?php include "Layouts/Soporte/footer.php"; ?>