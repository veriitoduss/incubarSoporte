<body class="fixed-left">
  <div id="wrapper">
    <div class="topbar">
      <div class="topbar-left" style="background-color:white ;">
        <div class="text-center">
          <a href="<?php echo base_url(); ?>administrador" class="logo-sm"><img src="<?php echo media(); ?>images/logo-pagina.png" height="28"></a>
          <a href="<?php echo base_url(); ?>administrador" class="logo" style="color:black!important"><img src="<?php echo media(); ?>images/logo-pagina.png" height="36"> Admin</a>
        </div>
      </div>
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="">
            <div class="pull-left"> <button type="button" class="button-menu-mobile open-left waves-effect waves-light"> <i class="ion-navicon"></i> </button> <span class="clearfix"></span></div>
            <h4 class="pull-left page-title" style="margin-top:22px"><?php echo $data['vista'] ?></h4>
          </div>
        </div>
      </div>
    </div>
    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
          <ul>
            <li class="has_sub"> <a class="waves-effect"><i class="fa-solid fa-circle-plus"></i> <span> Adiciones </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
              <ul class="list-unstyled">
                <p class="separadoresMenu">Usuarios</p>
                <li><a href="<?php echo base_url(); ?>administrador/agente"><i class="fa-solid fa-user-tie"></i>Agentes</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/rol"><i class="fa-solid fa-user-tag"></i>Roles</a></li>
                <p class="separadoresMenu">Parámetros del Ticket</p>
                <li><a href="<?php echo base_url(); ?>administrador/categoria"><i class="fa-solid fa-list-ol"></i>Categorias</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/cliente"><i class="fa-solid fa-user-large"></i>Clientes</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/estado"><i class="fa-solid fa-temperature-three-quarters"></i>Estados</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/tipo_identificacion"><i class="fa-solid fa-address-card"></i>Tipo identificaciones</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/prioridades"><i class="fa-solid fa-tags"></i>Prioridades</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/proyecto"><i class="fa-solid fa-building"></i>Proyectos</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/requerimiento"><i class="fa-solid fa-list-check"></i>Requerimientos</a></li>
              </ul>
            </li>
            <li> <a href="<?php echo base_url(); ?>lista" class="waves-effect"><i class="fa-solid fa-arrow-rotate-left"></i><span>Volver</span></a></li>
            <li> <a href="<?php base_url(); ?>cerrarSesion" class="waves-effect"><i class="fa-solid fa-right-from-bracket"></i><span>Cerrar sesion</span></a></li>
          </ul>
        </div>
        <!-- <div class="clearfix"></div> -->
      </div>
    </div>