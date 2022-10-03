// alert('enlazando')
const frm =document.querySelector('#formularioLogin')
const usuario_agente =document.querySelector('#usuario_agente')
const contrasena_agente =document.querySelector('#contrasena_agente')
document.addEventListener("DOMContentLoaded", function(){
  frm.addEventListener('submit',function (e) {
    e.preventDefault();
    if (usuario_agente.value =='' || contrasena_agente =='') {
      alert('todos los campos son requeridos');
    } else {
      
    }
  })
});