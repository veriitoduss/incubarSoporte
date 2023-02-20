const formularios_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e)
{
  e.preventDefault();
  let data = new FormData(this);
  let method = this.getAttribute("method");
  let action = this.getAttribute("action");
  let tipo = this.getAttribute("data-form");

  let encabezados = new Headers();
  let config =
  {
    method: method,
    headers: encabezados,
    mode: 'cors',
    cache: 'no-cache',
    body: data
  }
  let texto_alerta;
  if (tipo==="save")
  {
    texto_alerta="Los datos se guardarán en el sistema";
  }else if (tipo==="delete")
  {
    texto_alerta="Los datos serán eliminados";
  }else if (tipo==="update")
  {
    texto_alerta="Los datos serán actualizados";
  }else if (tipo==="search")
  {
    texto_alerta="Se eliminará el termino de búsqueda y tendrá que escribir uno nuevo";
  }else if (tipo==="administradorTicket")
  {
    texto_alerta="Desea eliminar los datos seleccionados?";
  }else
  {
    texto_alerta="Quieres realizar la operación solicitada?";
  }
  Swal.fire
    ({
      icon: 'question',
      title: 'Esta seguro?',
      text: texto_alerta,
      type: 'question',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonColor: '#198754',
      confirmButtonText:'Aceptar',
      cancelButtonText:'Cancelar'
    }).then((result) =>
    {
      if (result.value)
      {
        fetch(action,config)
        .then(respuesta=> respuesta.json())
        .then(respuesta => {
          return alertas_ajax(respuesta);
        });
      }
    });
}

formularios_ajax.forEach(formularios=>
{
  formularios.addEventListener("submit",enviar_formulario_ajax);
});
function alertas_ajax(alerta)
{
  if (alerta.Alerta==="simple")
  {
    Swal.fire
    ({
      // icon: 'success',
      icon: alerta.Icon,
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText:'Aceptar',
      // cancelButtonText:,
    });
  }else if (alerta.Alerta==="recargar")
  {
    Swal.fire
    ({
      icon: alerta.Icon,
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText:'Aceptar',
    }).then((result) =>
    {
      if (result.value)
      {
        location.reload();
      }
    });
  }else if (alerta.Alerta==="limpiar")
  {
    Swal.fire
    ({
      icon: alerta.Icon,
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText:'Aceptar',
    }).then((result) =>
    {
      if (result.value)
      {
        document.querySelector(".FormularioAjax").reset;
      }
    });
  }else if (alerta.Alerta==="redireccionar")
  {
    window.location.href=alerta.URL;
  }
}