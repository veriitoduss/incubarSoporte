<body class="fixed-left">
  <div id="wrapper">
    <div class="topbar">
      <div class="topbar-left" style="background-color:white ;">
        <div class="text-center">
          <a href="<?php echo base_url(); ?>administrador" class="logo-sm"><img src="<?php echo media(); ?>images/logo-pagina.png" height="28"></a>
          <a href="<?php echo base_url(); ?>administrador" class="logo" style="color:black!important"><img src="<?php echo media(); ?>images/logo-pagina.png" height="36" > Admin</a>
        </div>
      </div>
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="">
            <div class="pull-left"> <button type="button" class="button-menu-mobile open-left waves-effect waves-light"> <i class="ion-navicon"></i> </button> <span class="clearfix"></span></div>
            <h4 class="pull-left page-title" style="margin-top:22px"><?php echo $data['vista'] ?></h4>
            <!-- <form class="navbar-form pull-left" role="search">
              <div class="form-group"> <input type="text" class="form-control search-bar" placeholder="Search..."></div> <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
            </form> -->
            <!-- <ul class="nav navbar-nav navbar-right pull-right">
              <li class="dropdown hidden-xs">
                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger">3</span> </a>
                <ul class="dropdown-menu dropdown-menu-lg">
                  <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                  <li class="list-group">
                    <a href="javascript:void(0);" class="list-group-item">
                      <div class="media">
                        <div class="media-heading">Your order is placed</div>
                        <p class="m-0"> <small>Dummy text of the printing and typesetting
                            industry.</small></p>
                      </div>
                    </a>
                    <a href="javascript:void(0);" class="list-group-item">
                      <div class="media">
                        <div class="media-body clearfix">
                          <div class="media-heading">New Message received</div>
                          <p class="m-0"> <small>You have 87 unread messages</small></p>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0);" class="list-group-item">
                      <div class="media">
                        <div class="media-body clearfix">
                          <div class="media-heading">Your item is shipped.</div>
                          <p class="m-0"> <small>It is a long established fact that a reader
                              will</small></p>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0);" class="list-group-item"> <small class="text-primary">See all notifications</small> </a>
                  </li>
                </ul>
              </li>
              <li class="hidden-xs"> <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-crosshairs"></i></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0)"> Profile</a></li>
                  <li><a href="javascript:void(0)"><span class="badge badge-success pull-right">5</span> Settings </a></li>
                  <li><a href="javascript:void(0)"> Lock screen</a></li>
                  <li class="divider"></li>
                  <li><a href="javascript:void(0)"> Logout</a></li>
                </ul>
              </li>
            </ul> -->
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
                <li><a href="<?php echo base_url(); ?>administrador/rol"><i class="fa-solid fa-user-tag"></i>Roles</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/agente"><i class="fa-solid fa-user-tie"></i>Agentes</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/categoria"><i class="fa-solid fa-list-ol"></i>Categorias</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/proyecto"><i class="fa-solid fa-building"></i>Proyectos</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/cliente"><i class="fa-solid fa-user-large"></i>Clientes</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/prioridades"><i class="fa-solid fa-tags"></i>Prioridades</a></li>
              </ul>
            </li>
            <li> <a href="<?php echo base_url(); ?>lista" class="waves-effect"><i class="fa-solid fa-arrow-rotate-left"></i><span>Volver</span></a></li>
            <li> <a href="<?php base_url(); ?>cerrarSesion" class="waves-effect"><i class="fa-solid fa-right-from-bracket"></i><span>Cerrar sesion</span></a></li>
          </ul>
        </div>
        <!-- <div class="clearfix"></div> -->
      </div>
    </div>