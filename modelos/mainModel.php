<?php
if ($peticionAjax) {
  require_once "../config/SERVER.php";
} else {
  require_once "./config/SERVER.php";
}

class mainModel
{
  /*--------- funcion para conectar a la DB ---------*/
  protected static function conectar()
  {
    $conexion = new PDO(SGBD, USER, PASS);
    $conexion->exec("SET CHARACTER SET latin1");
    return $conexion;
  }

  /*--------- funcion para ejecutar consultas simples ---------*/
  protected static function ejecutar_consulta_simple($consulta)
  {
    $sql = self::conectar()->prepare($consulta);
    $sql->execute();
    return $sql;
  }

  /*--------- encriptar cadenas ---------*/
  public function encryption($cadena)
  {
    $output = FALSE;
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_encrypt($cadena, METHOD, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
  }

  /*--------- desencriptar cadenas ---------*/
  protected static function decryption($cadena)
  {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_decrypt(base64_decode($cadena), METHOD, $key, 0, $iv);
    return $output;
  }

  /*--------- funcion generar codigos aleatorios ---------*/
  protected static function generar_codigo_aleatorio($letra, $longitud, $numero)
  {
    for ($i = 1; $i < $longitud; $i++) {
      $aleatorio = rand(0, 9);
      $letra .= $aleatorio;
    }
    return $letra . "-" . $numero;
  }

  /*--------- funcion limpiar cadenas ---------*/
  protected static function limpiar_cadena($cadena)
  {
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
    $cadena = str_ireplace("SELECT COUNT(*)", "", $cadena);
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("<?", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace("<", "", $cadena);
    $cadena = str_ireplace(">", "", $cadena);
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);
    $cadena = str_ireplace("::", "", $cadena);
    $cadena = str_ireplace("OR '1' ='1'", "", $cadena);
    $cadena = str_ireplace('OR "1" ="1"', "", $cadena);
    $cadena = str_ireplace('OR ´1´ =´1´', "", $cadena);
    $cadena = str_ireplace("is NULL; --", "", $cadena);
    $cadena = str_ireplace("LIKE '", "", $cadena);
    $cadena = str_ireplace('LIKE "', "", $cadena);
    $cadena = str_ireplace("LIKE ´", "", $cadena);
    $cadena = str_ireplace("OR 'a'='a", "", $cadena);
    $cadena = str_ireplace('OR "a"="a', "", $cadena);
    $cadena = str_ireplace("OR ´a´=´a", "", $cadena);
    $cadena = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $cadena);
    $cadena = stripslashes($cadena);
    $cadena = trim($cadena);
    return $cadena;
  }

  /*--------- funcion veritifcar datos ---------*/
  protected static function verificar_Datos($filtro,$cadena)
  {
    if (preg_match("/^".$filtro."$/",$cadena)) {
      return false;
    }else {
      return true;
    }
  }


}
