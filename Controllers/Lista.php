<?php
class Lista extends Controllers{
  public function __construct()
  {
    parent::__construct();
  }
  public function lista()
  {
    $data['tickets']=$this->model->getTicketsLista();
    $data['tag_page']="lista";
    $this->views->getView($this,"lista",$data);
  }
  public function lista2()
  {
    $data['tickets']=$this->model->getTicketsLista();
    $data['tag_page']="lista";
    $this->views->getView($this,"lista2",$data);
  }


}
?>