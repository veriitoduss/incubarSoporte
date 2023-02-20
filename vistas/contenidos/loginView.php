<div class="bg-img" style="background: url(<?php echo SERVERURL; ?>assets/images/oficina.jpg)">
  <div class="content-login">
    <form action="" method="POST" autocomplete="off">
      <h1>Soporte</h1>
      <span class="spanForm">Ingrese sus credenciales</span>
      <div class="field space">
        <span class="fa fa-user"></span>
        <input type="text" placeholder="Nombre de usuario o correo electrónico" name="usuario_agente" id="usuario_agente" required>
      </div>
      <div class="field">
        <span class="fa fa-lock"></span>
        <input type="password" placeholder="Contraseña" class="password" name="contrasena_agente" id="contrasena_agente" required>
        <span class="ver"> VER </span>
      </div>
      <div class="pass">
        <div class="checkPass">
          <input type="checkbox" name="my-checkbox" id="opt-in">
          <label for="opt-in">recuerdame</label>
        </div>
        <div class="olvidarContraseñaPass">
          <a href="<?php echo SERVERURL; ?>restorePassword/">Has olvidado tu contraseña?</a>
        </div>
      </div>
      <div class="field" id="buttones">
        <button type="submit" id="btnEnviarLogin">Ingresar</button>
        <button class="Invitado" name="btnFormularioTicket" id="btnFormularioTicket" href="<?php echo SERVERURL; ?>formularioTicket/"><a href="<?php echo SERVERURL; ?>formularioTicket/">Continuar como invitado</a></button>
      </div>
    </form>
  </div>
</div>
<?php
if (isset($_POST['usuario_agente']) && ($_POST['contrasena_agente'])) {
  require_once "./controladores/loginControlador.php";

  $ins_login = new loginControlador();
  $ins_login->iniciar_sesion_controlador(); 
}
?>
<script>
  const pass_field= document.querySelector('.password');
  const ver_btn= document.querySelector('.ver');
  ver_btn.addEventListener('click',function(){
    if (pass_field.type === "password") {
      pass_field.type="text";
      pass_field.style.color="#3498db";
    }else{
      pass_field.type="password";
      pass_field.style.color="#222";
    }
  });
</script>