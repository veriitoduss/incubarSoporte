<script>
  let btn_salir=document.querySelector(".btn-exit-system");
  btn_salir.addEventListener('click', function(e){
    e.preventDefault();
    Swal.fire
    ({
      icon: 'question',
      title: 'Quiere cerrar sesion?',
      text: 'La session se cerrara',
      type: 'question',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonColor: '#3085d6',
      confirmButtonText:'Aceptar',
      cancelButtonText:'Cancelar'
    }).then((result) =>
    {
      if (result.value)
      {
        let url='<?php echo SERVERURL;?>ajax/loginAjax.php';
        let token='<?php echo $lc->encryption($_SESSION['token_ihs']);?>';
        let agente='<?php echo $lc->encryption($_SESSION['usuario_ihs']);?>';
        let datos = new FormData();
        datos.append("token",token);
        datos.append("agente",agente);

        fetch(url,{
          method:'POST',
          body:datos
        })
        .then(respuesta=> respuesta.json())
        .then(respuesta => {
          return alertas_ajax(respuesta);
        });
      }
    });
  });
  // alert("hola");
</script>