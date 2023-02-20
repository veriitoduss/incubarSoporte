<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($peticionAjax) {
  require_once "../modelos/ticketModelo.php";
  require '../PhpMailer/Exception.php';
  require '../PhpMailer/PHPMailer.php';
  require '../PhpMailer/SMTP.php';
} else {
  require_once "./modelos/ticketModelo.php";
  require './PhpMailer/Exception.php';
  require './PhpMailer/PHPMailer.php';
  require './PhpMailer/SMTP.php';
}

class ticketControlador extends ticketModelo
{
  /*--------- Agregar ticket ---------*/
  public function agregar_ticket_controlador()
  {
    // llamado de datos
    $nombre_apellido_usuario = mainModel::limpiar_cadena($_POST['nombre_apellido_usuario']);
    $numero_identificacion_usuario = mainModel::limpiar_cadena($_POST['numero_identificacion_usuario']);
    $celular_usuario = mainModel::limpiar_cadena($_POST['celular_usuario']);
    $correo_usuario = mainModel::limpiar_cadena($_POST['correo_usuario']);
    $asunto = $_POST['asunto'];
    $descripcion = $_POST['descripcion'];
    //------------------------------INICIO guardar archivo en la bd------------------------------//
    $nombre_file = $_FILES['archivo_adjunto_ticket']['name'];
    $nombre_file = str_replace(' ', '', $nombre_file);
    $direccion = "https://www.incubarhuila.co/ticketSoporte/assets/images/archivos/";
    $archivo_adjunto_ticket = $direccion . basename($nombre_file);
    // tipo de archivo que se va a guardar
    $type = strtolower(pathinfo($nombre_file, PATHINFO_EXTENSION));
    //------------------------------FIN guardar archivo en la bd------------------------------//
    $fecha_creacion_ticket = (date("Y-m-d H:i:s"));
    $id_tipo_identificacion = mainModel::limpiar_cadena($_POST['id_tipo_identificacion']);
    $id_cliente = mainModel::limpiar_cadena($_POST['id_cliente_add']);
    $id_tipo_requerimiento = mainModel::limpiar_cadena($_POST['id_tipo_requerimiento']);
    $id_estado = 4;
    $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_add']);
    $id_categoria = 1;
    $id_prioridad = 1;
    $eliminar = 0;
    $id_agente = 2;
    //------------------------------valor maximo del archivo------------------------------//
    $maxsize = 5242880;
    //------------------------------Inicio creacion del id------------------------------//
    $correlativoID = mainModel::ejecutar_consulta_simple("SELECT id_ticket FROM tickets");
    $correlativoID = ($correlativoID->rowCount()) + 1;
    $id_ticket = $correlativoID;
    //------------------------------Fin creacion del id------------------------------//
    //--------------consulta para el identificador del proyecto seleccionado--------------//
    $identificadorProyecto = mainModel::ejecutar_consulta_simple("SELECT identificador_proyecto FROM proyectos WHERE id_proyecto=$id_proyecto");
    //--------------consulta para contar lo ticket creados del proyecto--------------//
    $correlativo = mainModel::ejecutar_consulta_simple("SELECT id_ticket FROM tickets WHERE id_proyecto=$id_proyecto");
    $correlativo = ($correlativo->rowCount()) + 1;
    //--------------asginacion a varible del identificador--------------//
    foreach ($identificadorProyecto as $identificacionDelProyecto) {
      $identidadProyecto = $identificacionDelProyecto['identificador_proyecto'];
    }
    //------------------asignacion del numero y el codigo al numero de ticket------------------//
    $numero_ticket = $identidadProyecto . '-' . $correlativo;
    //------- Inicio validacion que el valor sea numerico del numero de identificacion-------//
    if (mainModel::verificar_Datos("[0-9]{1,20}", $numero_identificacion_usuario)) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "El número de identificación no coincide con el formato solicitado",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    //------- Fin validacion que el valor sea numerico del numero de identificacion-------//
    //------- Inicio validacion del numero celular que se de 10 digitos-------//
    if (mainModel::verificar_Datos("[0-9]{1,10}", $celular_usuario)) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "El número de celular no coincide con el formato solicitado",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    //------- Fin validacion del numero celular que se de 10 digitos-------//
    //------- Inicio validacion de existencia del archivo a guardar-------//
    if ($nombre_file == " " || $nombre_file == "" || $nombre_file == false) {
      $archivo_adjunto_ticket = " ";
      //------- Fin validacion de existencia del archivo a guardar-------//
    } else {
      //------- Inicio  validacion del tipo de archivo que se va a subir-------//
      if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif" || $type == "pdf" || $type == "doc" || $type == "docx" || $type == "ppt" || $type == "pptx" || $type == "pps" || $type == "ppsx" || $type == "odt" || $type == "xls" || $type == "xlsx" || $type == "mp3" || $type == "m4a" || $type == "ogg" || $type == "wav" || $type == "mp4" || $type == "m4v" || $type == "mov" || $type == "wmv" || $type == "avi" || $type == "mpg" || $type == "ogv" || $type == "3gp" || $type == "3g2" || $type == "zip" || $type == "eml" || $type == "rar" || $type == "7z") {
        //------- Inicio  validacion del tamaño de archivo que se va a subir-------//
        if (($_FILES['archivo_adjunto_ticket']['size'] >= $maxsize) || ($_FILES["archivo_adjunto_ticket"]["size"] == 0)) {
          $alerta =
            [
              "Alerta" => "simple",
              "Icon" => "error",
              "Titulo" => "Ocurrió un error inesperado",
              "Texto" => "El archivo es mayor a 5 Megabyte",
              "Tipo" => "error"
            ];
          echo json_encode($alerta);
          exit();
        }
        //------- Fin  validacion del tamaño de archivo que se va a subir-------//
      } else {
        $alerta =
          [
            "Alerta" => "simple",
            "Icon" => "error",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El tipo de archivo no coincide con el formato solicitado",
            "Tipo" => "error"
          ];
        echo json_encode($alerta);
        exit();
      }
      //------- Fin  validacion del tipo de archivo que se va a subir-------//
    }
    //------- Inicio validacion de checkbox-------//
    if (isset($_REQUEST['envioFormulario'])) {
      $datos_ticket_registro =
        [
          "id_ticket" => $id_ticket,
          "numero_ticket" => $numero_ticket,
          "nombre_apellido_usuario" => $nombre_apellido_usuario,
          "numero_identificacion_usuario" => $numero_identificacion_usuario,
          "celular_usuario" => $celular_usuario,
          "correo_usuario" => $correo_usuario,
          "asunto" => $asunto,
          "descripcion" => $descripcion,
          "archivo_adjunto_ticket" => $archivo_adjunto_ticket,
          "fecha_creacion_ticket" => $fecha_creacion_ticket,
          "id_tipo_identificacion" => $id_tipo_identificacion,
          "id_cliente" => $id_cliente,
          "id_tipo_requerimiento" => $id_tipo_requerimiento,
          "id_estado" => $id_estado,
          "id_proyecto" => $id_proyecto,
          "id_categoria" => $id_categoria,
          "id_prioridad" => $id_prioridad,
          "id_agente" => $id_agente,
          "eliminar" => $eliminar,
        ];
      // ticketModelo::agregar_adiciones_ticket_modelo($id_ticket);
      $agregar_ticket = ticketModelo::agregar_ticket_modelo($datos_ticket_registro);
      //------- Inicio validacion del agregar-------//
      if ($agregar_ticket->rowCount() == 1) {
        ticketModelo::agregar_adiciones_ticket_modelo($id_ticket);
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
          //Server settings
          $mail->SMTPDebug = 0;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          // $mail->Host       = 'correo.incubarhuila.co';                     //Set the SMTP server to send through
          // $mail->Host       = 'mail.incubarhuila.org';                     //Set the SMTP server to send through
          // $mail->Host       = 'mail.incubarhuila.co';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'mesadeayuda@incubarhuila.co';                     //SMTP username
          // $mail->Username   = 'webmaster@incubarhuila.co';                     //SMTP username
          // $mail->Password   = ')@@FTN-JDzRI';                               //SMTP password
          $mail->Password   = '210722@incubarHuila';                               //SMTP password
          $mail->SMTPSecure = 'tls';            //el tls es con 587
          $mail->Port       = 587;
          // $mail->SMTPSecure = 'ssl';       //el ssl es con 465
          // $mail->Port       = 465;

          //Recipients
          $mail->setFrom('mesadeayuda@incubarhuila.co', 'Incubarhuila');
          $mail->addAddress($correo_usuario);     //Add a recipient
          $mail->addAddress('mesadeayuda@incubarhuila.co');     //Add a recipient
          // $mail->addBCC('webmaster@incubarhuila.co');
          // $mail->addAddress('juancamilosoftware@juancamilosoftware.com');     //Add a recipient
          $mail->addBCC('mesadeayuda@incubarhuila.co');
          // $mail->addBCC('info@incubarhuila.co');
          $mail->addBCC('veanmi_12@hotmail.com');
          // $mail->addBCC('info@incubarhuila.org');
          // // $mail->addBCC('info@incubarhuila.co');
          // $mail->addBCC('mesadeayuda@incubarhuila.co');

          //Content
          $mail->CharSet = "UTF-8";
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Ticket # ' . $numero_ticket . ', Confirmacion de Creacion de Ticket - Mesa de Ayuda de Incubarhuila';
          // $mail->Subject = '[Ticket # ' . $numero_ticket . '] Confirmacion de Creacion de Ticket - Mesa de Ayuda de Incubarhuila';
          $mail->Body    = '
    <html>
        <body>
        <p>Estimado(a) ' . $nombre_apellido_usuario . ',</p>
        <br>
        <br>
        <p>Respetuosamente le confirmo que se requerimiento ha sido recibido bajo el ticket <b>#' . $numero_ticket . '</b>, el cual será atendido por uno de nuestros agentes de la Mesa de Ayuda.</p>
        <br>
        <p>La descripción de su ticket es la siguiente:</p>
        <br>
        <p>Inicio " </p>
        <br>
        <p><b>' . $descripcion . '</b></p>
        <br>
        <p>" Fin</p>
        <br>
        <br>
        <p>Para consultar el estado y detalles adicionales del ticket podrá ingresar al siguiente enlace:   </p>
        <br>
        <a href="' . SERVERURL . 'creacionTicketUsuario/' . mainModel::encryption($id_ticket) . '/">' . SERVERURL . 'ticketUsuario/' . mainModel::encryption($id_ticket) . '/</a>
        <br>
        <br>
        <p>Usted recibirá una notificación al correo electrónico ' . $correo_usuario . ' Su ticket será atendido, procesado y solucionado de acuerdo a la prioridad del mismo.</p>
        <br>
        <p>Por favor, en caso de que la notificación por correo electronico no aparezca en la bandeja de entrada, por favor revisar la bandeja de Correo No Deseado o Spam.</p>
        <br>
        <p>Por último, le recordamos que se puede comunicar con la Mesa de Ayuda por medio de las líneas 018000930158 y 3224685815, al correo electrónico mesadeayuda@incubarhuila.co y/o la plataforma https://www.incubarhuila.co/ticketSoporte/, en donde podrán radicar sus requerimientos asociados al servicio de conectividad a internet.</p>
        <br>
        <p>Agradecemos de antemano la atención prestada.</p>
        <p>Atentamente,</p>
        <br>
        <br>
        <br>
        <p><b>INCUBADORA DE EMPRESAS DE INNOVACIÓN Y BASE TECNOLÓGICA DEL HUILA</b></p>
        <p>NIT. 813.009.224-3</p>
        <p>Carrera 4 No. 22-11 Oficina A10 – A11 – Recinto Ferial “La Vorágine”</p>
        <p>Web: www.incubarhuila.co – E-mail: info@incubarhuila.co – Celular: 322 468 58 15</p>
        <p>Neiva – Huila - Colombia</p>
        </body>
        </html>
    ';

          $mail->send();
          $mensajeAEnviados=$mail->Body;
          $asunto=$mail->Subject;
          //The first line connects to your inbox over port 143
          $mbox = imap_open("{mail.incubarhuila.co:143/notls}INBOX", "mesadeayuda@incubarhuila.co", "210722@incubarHuila");
          // $mbox = imap_open("{imap.gmail.co:143/notls}INBOX", "mesadeayuda@incubarhuila.co", "210722@incubarHuila");
          // antesitos de las 7 cambie el gmail
          // a las 7 cambie por imap
          // a las 7:10 se envio con el cambio de solo el correo con el mismo host
          // $mbox = imap_open("{mail.incubarhuila.co:143/notls}INBOX", "webmaster@incubarhuila.co", ")@@FTN-JDzRI");
          //imap_append() appends a string to a mailbox. In this example your SENT folder.
          // Notice the 'r' format for the date function, which formats the date correctly for messaging.
          imap_append(
            $mbox,
            "{imap.gmail.co:143/notls}INBOX.Sent",
            "Content-type: text/html; charset=utf-8".
            "From: mesadeayuda@incubarhuila.co\r\n" .
              "From: mesadeayuda@incubarhuila.co\r\n" .
              "To: " . $correo_usuario . "\r\n" .
              "Subject: " . $asunto . "\r\n" .
              "Date: " . date("r", strtotime("now")) . "\r\n" .
              "\r\n" .
              $mensajeAEnviados .
              "\r\n"
          );

          // close mail connection.
          imap_close($mbox);

        } catch (Exception $e) {
          // echo "hubo un error: {$mail->ErrorInfo}";
        }

        $alerta =
          [
            "Alerta" => "recargar",
            "Icon" => "success",
            "Titulo" => "Ticket registrado",
            "Texto" => "Los datos del ticket han sido registrados",
            "Tipo" => "success"
          ];
      } else {
        $alerta =
          [
            "Alerta" => "simple",
            "Icon" => "info",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto" => "No se ha podido registrar ticket",
            "Tipo" => "error"
          ];
      }
      echo json_encode($alerta);
      //------- Fin validacion del agregar-------//
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "Es necesario autorizar el tratamiento de datos personales",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    //------- Fin validacion de checkbox-------//
  }

  /*--------- mostrar datos tipo identificacion ---------*/
  public function mostrar_datosIdentificacion_controlador()
  {
    $mostrarDatosIdentificacion = "";
    $consulta = "SELECT * FROM tipo_identificaciones WHERE eliminar = 0 ORDER BY tipo_identificacion ASC";
    $conexion = mainModel::conectar();
    $datosIdentificacion = $conexion->query($consulta);
    $datosIdentificacion = $datosIdentificacion->fetchAll();
    $mostrarDatosIdentificacion .= '<select style="font-size:13px" name="id_tipo_identificacion" id="id_tipo_identificacion" require>
      <option value="" selected></option>';
    foreach ($datosIdentificacion as $identificacion) {
      $mostrarDatosIdentificacion .= '<option style="font-size:13px" value="';
      // valor
      $mostrarDatosIdentificacion .= $identificacion['id_tipo_identificacion'] . '">';
      // valor
      $mostrarDatosIdentificacion .= $identificacion['tipo_identificacion'] . '</option>';
    }
    $mostrarDatosIdentificacion .= '</select>';
    return $mostrarDatosIdentificacion;
  }
  /*--------- mostrar datos proyectos ---------*/
  public function mostrar_datosProyecto_controlador()
  {
    $mostrarDatosProyecto = "";
    $consulta = "SELECT * FROM proyectos WHERE eliminar = 0 ORDER BY nombre_proyecto ASC";
    $conexion = mainModel::conectar();
    $datosProyecto = $conexion->query($consulta);
    $datosProyecto = $datosProyecto->fetchAll();
    $mostrarDatosProyecto .= '<select style="font-size:13px" name="id_proyecto_add" id="id_proyecto_add" require>
      <option style="font-size:13px" value="" selected></option>';
    foreach ($datosProyecto as $Proyecto) {
      $mostrarDatosProyecto .= '<option style="font-size:13px" value="';
      // valor
      $mostrarDatosProyecto .= $Proyecto['id_proyecto'] . '">';
      // valor
      $mostrarDatosProyecto .= $Proyecto['nombre_proyecto'] . '</option>';
    }
    $mostrarDatosProyecto .= '</select>';
    return $mostrarDatosProyecto;
  }
  /*--------- mostrar datos tipo requerimiento ---------*/
  public function mostrar_datosRequerimiento_controlador()
  {
    $mostrarDatosRequerimiento = "";
    $consulta = "SELECT * FROM tipo_requerimientos WHERE eliminar=0 ORDER BY tipo_requerimiento ASC";
    $conexion = mainModel::conectar();
    $datosRequerimiento = $conexion->query($consulta);
    $datosRequerimiento = $datosRequerimiento->fetchAll();
    $mostrarDatosRequerimiento .= '<select style="font-size:13px" name="id_tipo_requerimiento" id="id_tipo_requerimiento" require>
      <option value="" selected></option>';
    foreach ($datosRequerimiento as $Requerimiento) {
      $mostrarDatosRequerimiento .= '<option style="font-size:13px" value="';
      // valor
      $mostrarDatosRequerimiento .= $Requerimiento['id_tipo_requerimiento'] . '">';
      // valor
      $mostrarDatosRequerimiento .= $Requerimiento['tipo_requerimiento'] . '</option>';
    }
    $mostrarDatosRequerimiento .= '</select>';
    return $mostrarDatosRequerimiento;
  }
  /*--------- mostrar datos clientes por proyecto ---------*/
  public function mostrar_clientes_controlador()
  {
    $consulta = "SELECT * FROM clientes WHERE eliminar = 0 ORDER BY nombre_cliente ASC";
    $conexion = mainModel::conectar();
    $datosCliente = $conexion->query($consulta);
    $datosCliente = $datosCliente->fetchAll();
    $mostrarDatosCliente = "";
    $mostrarDatosCliente .= '
    <select style="font-size:13px" name="id_cliente_add" id="id_cliente_add" require>
    <option style="font-size:13px"></option>';
    foreach ($datosCliente as $cliente) {
      $mostrarDatosCliente .= '
        <option style="font-size:13px" value="' . $cliente['id_cliente'] . '">' . $cliente['nombre_cliente'] . '</option>';
    }
    $mostrarDatosCliente .= '
</select>
';
    return $mostrarDatosCliente;
  }
}
