<?php
  // require_once "./modelos/listaTicketModelo.php";
  // require_once "./modelos/mainModel.php";
  // $ins_datosTicket = new mainModel();

  // new mainModel();
    $output='';
    if (isset($_POST["export_excel"])) {
    // $datos_ticket = $ins_listaTicket->ejecutar_consulta_simple("SELECT * FROM proyectos WHERE");
    $output.='
    <table>
    <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    </tr>
    <tr>
    <td>w</td>
    <td>w</td>
    <td>w</td>
    </tr>
    </table>
    ';
    header("Content-Type:application/xlsx");
    header("Content-Disposition:attachment; filename=descaraexcel.xls");
    echo $output;
  }

?>