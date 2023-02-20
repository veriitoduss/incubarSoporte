<body class="fixed-left">
  <div id="wrapper">
    <div class="topbar">
      <div class="topbar-left" style="background-color:white ;">
        <div class="text-center">
          <a href="<?php echo SERVERURL; ?>adminIndex/" class="logo-sm"><img src="<?php echo SERVERURL; ?>assets/images/logo-pagina.png" height="28"></a>
          <a href="<?php echo SERVERURL; ?>adminIndex/" class="logo" style="text-decoration: none;color:black!important"><img src="<?php echo SERVERURL; ?>assets/images/logo-pagina.png" height="36"> Admin</a>
          <!-- <a href="<?php echo SERVERURL; ?>adminIndex/" class="logo" style="text-decoration: none;color:black!important"><img src="<?php echo SERVERURL; ?>assets/images/logo-pagina.png" height="36"> <?php echo $_SESSION['usuario_ihs']; ?></a> -->
        </div>
      </div>
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="">
            <div class="pull-left"> <button type="button" class="button-menu-mobile open-left waves-effect waves-light" style="margin-left:-590px"> <i class="ion-navicon"></i> </button> <span class="clearfix"></span></div>
            <h4 class="pull-left page-title" style="margin-top:22px"></h4>
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
                <p class="separadoresMenu">USUARIOS</p>
                <li><a href="<?php echo SERVERURL; ?>adminRoles/"><i class="fa-solid fa-user-tag"></i>Roles</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminAgente/"><i class="fa-solid fa-user-tie"></i>Agentes</a></li>
                <p class="separadoresMenu">PARÁMETROS DEL TICKET</p>
                <li><a href="<?php echo SERVERURL; ?>adminCategoria/"><i class="fa-solid fa-list-ol"></i>Categorias</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminProyecto/"><i class="fa-solid fa-building"></i>Proyectos</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminCliente/"><i class="fa-solid fa-user-large"></i>Clientes</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminEstado/"><i class="fa-solid fa-temperature-three-quarters"></i>Estados</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminIdentificacion/"><i class="fa-solid fa-address-card"></i>Tipo identificaciones</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminPrioridad/"><i class="fa-solid fa-tags"></i>Prioridades</a></li>
                <li><a href="<?php echo SERVERURL; ?>adminRequerimiento/"><i class="fa-solid fa-list-check"></i>Requerimientos</a></li>
              </ul>
            </li>
            <li> <a href="<?php echo SERVERURL; ?>listaTicket/" class="waves-effect"><i class="fa-solid fa-arrow-rotate-left"></i><span>Volver</span></a></li>
            <li> <a href="cerrarSesion" class="waves-effect btn-exit-system" id="botonListaTicketAmarillo"><i class="fa-solid fa-right-from-bracket"></i><span>Cerrar sesion</span></a></li>
          </ul>
        </div>
        <!-- <div class="clearfix"></div> -->
      </div>
    </div>