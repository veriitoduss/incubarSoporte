<?php
function base_url()
{
  return BASE_URL;
}
function media()
{
  return BASE_URL."Assets/";
}

function strClean($strCadena)
{
  $string= preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
  $string=trim($string);
  $string=stripslashes($string);
  $string=str_ireplace("<script>","",$string);
  $string=str_ireplace("</script>","",$string);
  $string=str_ireplace("<script src>","",$string);
  $string=str_ireplace("<script type=>","",$string);
  $string=str_ireplace("SELECT * FROM","",$string);
  $string=str_ireplace("DELETE FROM","",$string);
  $string=str_ireplace("INSERT INTO","",$string);
  $string=str_ireplace("SELECT COUNT(*)","",$string);
  $string=str_ireplace("DROP TABLE","",$string);
  $string=str_ireplace("OR '1' ='1'","",$string);
  $string=str_ireplace('OR "1" ="1"',"",$string);
  $string=str_ireplace('OR ´1´ =´1´',"",$string);
  $string=str_ireplace("is NULL; --","",$string);
  $string=str_ireplace("LIKE '","",$string);
  $string=str_ireplace('LIKE "',"",$string);
  $string=str_ireplace("LIKE ´","",$string);
  $string=str_ireplace("OR 'a'='a","",$string);
  $string=str_ireplace('OR "a"="a',"",$string);
  $string=str_ireplace("OR ´a´=´a","",$string);
  $string=str_ireplace("--","",$string);
  $string=str_ireplace("^","",$string);
  $string=str_ireplace("[","",$string);
  $string=str_ireplace("]","",$string);
  $string=str_ireplace("==","",$string);
  return $string;
}
?>