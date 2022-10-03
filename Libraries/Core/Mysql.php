<?php
  class Mysql extends conexion
  {
    private $conexion;
    private $strquery;
    private $arrvalues;
    function __construct()
    {
      $this->conexion=new conexion;
      $this->conexion=$this->conexion->conect();
    }

    public function insert(string $query, array $arrvalues)
    {
      $this->strquery=$query;
      $this->arrvalues=$arrvalues;
      $insert =$this->conexion->prepare($this->strquery);
      $resinsert =$insert->execute($this->arrvalues);
      if ($resinsert) {
        $lastInsert=$this->conexion->lastInsertId();
      } else {
        $lastInsert=0;
      }
        return $lastInsert;
    }

    public function select(string $query)
    {
      $this->strquery=$query;
      $result=$this->conexion->prepare($this->strquery);
      $result->execute();
      $data=$result->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

    public function select_all(string $query)
    {
      $this->strquery=$query;
      $result=$this->conexion->prepare($this->strquery);
      $result->execute();
      $data=$result->fetchall(PDO::FETCH_ASSOC);
      return $data;
    }

    public function update(string $query, array $arrvalues)
    {
      $this->strquery=$query;
      $this->arrvalues=$arrvalues;
      $update =$this->conexion->prepare($this->strquery);
      $resExecute =$update->execute($this->arrvalues);
      return $resExecute;
    }

    public function delete(string $query)
    {
      $this->strquery=$query;
      $result=$this->conexion->prepare($this->strquery);
      $result->execute();
      return $result;
    }
  }
?>