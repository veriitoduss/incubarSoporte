$(document).ready(function(){
  $('#proyecto').change(function(){
    recargaLista();
  });
})
function recargaLista(){
  $.ajax({
    type:"POST",
    url:"<?php echo SERVERURL; ?>controladores/ticketControlador.php",
    data:"id_proyecto="+$('#proyecto').val(),
    success:function(r){
      $('#selectCliente').html(r);
    }
  });
}