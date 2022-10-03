<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <link href="<?php echo base_url(); ?>assets/css/fontawesome-free-6.2.0-web/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo-pagina.ico" />
  <link href="<?php echo base_url(); ?>assets/css/diseño.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
  <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
  <script>
    (function(i, s, o, g, r, a, m) {
      i["GoogleAnalyticsObject"] = r;
      (i[r] =
        i[r] ||
        function() {
          (i[r].q = i[r].q || []).push(arguments);
        }),
      (i[r].l = 1 * new Date());
      (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m);
    })(
      window,
      document,
      "script",
      "../../www.google-analytics.com/analytics.js",
      "ga"
    );
    ga("create", "UA-86308552-1", "auto");
    ga("send", "pageview");
  </script>
  <title><?php echo $data['tag_page'] ?></title>
</head>

<body>
  <header>
    <div class="LogoEncubarhuila">
      <a href="http://www.incubarhuila.co/" title="Incubarhuila"><img src="<?php echo media(); ?>images/logo.png"></a>
    </div>
    <nav>
      <a href="http://www.incubarhuila.co/" class="nav link">Inicio</a>
      <a href="#" class="nav link">Conócenos</a>
      <a href="https://www.incubarhuila.co/oferta/" class="nav link">Oferta</a>
      <a href="https://www.incubarhuila.co/actualidad/" class="nav link">Actualidad</a>
      <a href="https://www.incubarhuila.co/huila-emprende/" class="nav link">Huila Emprende</a>
      <a href="#" class="activo">Recursos</a>
      <a href="#" class="nav link">Analítica</a>
      <a href="https://www.incubarhuila.co/contacto/" class="nav link">Contácto</a>
    </nav>
  </header>
  <div class="cabezal">
    lista 2
    <img src="<?php echo media(); ?>images/img.png">
  </div>
  <div class="enunciado">
    <div class="Icono_enunciado">
      <img src="<?php echo media(); ?>images/mesa_ayuda.png">
    </div>
    <h1><b> MESA DE AYUDA Y SOPORTE TECNICO</b></h1>
  </div>
  <div class="cuerpo">
    <div>
      <div class="contenedorBotones">
        <a href="<?php base_url(); ?>tickets"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>
      </div>
      
      <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-body">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nombre(s)Apellido(s)</th>
                        <th>Asunto</th>
                        <th>Fecha Creación</th>
                        <th>Fecha Cierre</th>
                        <th>Prioridad</th>
                        <th>Categoria</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($data['tickets'] as $ticket) { ?>
                        <tr>
                          <td><?php echo $ticket['numero_ticket']; ?></td>
                          <td><?php echo $ticket['nombre_apellido_usuario']; ?></td>
                          <td><?php echo $ticket['asunto']; ?></td>
                          <td><?php echo $ticket['fecha_creacion_ticket']; ?></td>
                          <td><?php echo $ticket['fecha_respuesta']; ?></td>
                          <td><?php echo $ticket['nombre_prioridad']; ?></td>
                          <td><?php echo $ticket['nombre_categoria']; ?></td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>

  </div>
  <div class="comparte">
    <div class="comparteContenedor">
      <nav class="compartir">
        <a style="cursor:pointer" href="mailto:info@incubarhuila.co?subject=Mayor Información" title="¡Escribemos!">
          <img src="https://i0.wp.com/www.incubarhuila.co/wp-content/uploads/2017/06/Email2.png?resize=35%2C35" alt="¡Escribemos!" width="30" height="30" data-recalc-dims="1">
        </a>
        <a style="cursor:pointer;" onclick="javascript:window.open('//www.linkedin.com/shareArticle?mini=true&url=https://www.incubarhuila.co/soporte/','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="Compartir en Linkedin">
          <img src="https://i0.wp.com/www.incubarhuila.co/wp-content/uploads/2017/06/Linkelin-02.png?resize=35%2C35" alt="Compartir en Linkedin" width="30" height="30" data-recalc-dims="1">
        </a>
        <a style="cursor:pointer;" onclick="window.open('//twitter.com/share?url=https://www.incubarhuila.co/soporte/&text=Soporte&nbsp;&nbsp;', '_blank', 'width=800,height=300')" title="Compartir en Twitter"><img src="https://i0.wp.com/www.incubarhuila.co/wp-content/uploads/2017/06/Twitter-02.png?resize=35%2C35" alt="Compartir en Twitter" width="30" height="30" data-recalc-dims="1">
        </a>
        <a style="cursor:pointer;" onclick="window.open('//www.facebook.com/sharer/sharer.php?u=https://www.incubarhuila.co/soporte/','Facebook','width=800,height=300');return false;" title="Compartir en Facebook"><img src="https://i0.wp.com/www.incubarhuila.co/wp-content/uploads/2017/06/Facebook-02.png?resize=35%2C35" alt="Compartir en Facebook" width="30" height="30" data-recalc-dims="1">
        </a>
      </nav>
    </div>
    <div class="triangulo">
    </div>
    <div class="compartirTriangulo">
      <p>Comparte!</p>
    </div>
  </div>
  <footer>
    <div class="footerUno">
      <div class="footerUnoLogo">
        <img src="<?php echo media(); ?>images/logo-incubarhuila-blanco.png">
        <p>¡Somos una plataforma colaborativa para la aceleración de negocios!</p>
      </div>
      <div class="footerNavegador">
        <nav>
          <a href="https://www.incubarhuila.co/conocenos/" class="nav link">Conocenos</a>
          <a href="https://www.incubarhuila.co/conocenos/aliados/" class="nav link">Aliados</a>
          <a href="https://www.incubarhuila.co/actualidad/eventos/" class="nav link">Eventos</a>
          <a href="https://www.incubarhuila.co/recursos/politica-de-privacidad/" class="nav link">Politica de Privacidad</a>
          <a href="https://www.incubarhuila.co/recursos/mapa-de-sitio/" id="liFinal" class="nav link">Mapa Sitio</a>
        </nav>
      </div>
      <div class="ContactoFooter">
        <label><b>Contácto</b></label>
        <p>Recinto Ferial "La Vorágine"</p>
        <p>Carrera 4 No. 22-11 Oficinas A10- A11</p>
        <p>Celular 322 468 5815</p>
        <p>info@incubarhuila.co</p>
        <p>Neiva - Huila - Colombia- Sur América</p>
      </div>
    </div>
    <div class="footerDos">
      <div class="footerDerechos">
        <p>Incubarhuila © Todos los derechos reservados - 2022 </p>
      </div>
      <div class="footerSocial">
        <div>
          <ul class="social">
            <li><a href="https://www.facebook.com/incubarhuila/" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="https://plus.google.com/108934053141951520528?hl=es" title="Google+"><i class="fa-brands fa-google-plus-g"></i></a></li>
            <li><a href="https://twitter.com/incubarhuilaco" title="Twitter"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="https://www.linkedin.com/in/incubarhuila/" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
          </ul>
        </div>
        <div class="botonTopContainer">
          <span class="fa-solid fa-chevron-up"></span>
        </div>
      </div>
    </div>

  </footer>
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/modernizr.min.js"></script>
  <script src="assets/js/detect.js"></script>
  <script src="assets/js/fastclick.js"></script>
  <script src="assets/js/jquery.slimscroll.js"></script>
  <script src="assets/js/jquery.blockUI.js"></script>
  <script src="assets/js/waves.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
  <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
  <script src="assets/plugins/datatables/jszip.min.js"></script>
  <script src="assets/plugins/datatables/pdfmake.min.js"></script>
  <script src="assets/plugins/datatables/vfs_fonts.js"></script>
  <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
  <script src="assets/plugins/datatables/buttons.print.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
  <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
  <script src="assets/pages/datatables.init.js"></script>
  <script src="assets/js/app.js"></script>
</body>

</html>

<style>
  .enunciado {
    background-image: linear-gradient(rgba(252, 255, 255, 0.2), rgba(255, 255, 255, 0.2)), url("http://localhost/incubarSoporte/assets/images/logo_oficina.png");
    background-size: cover;
    /* background-color: #FCB900; */
    display: flex;
    padding: 3% 9% 3% 14%;
    margin: 2% 10% 1% 8.5%;
    align-items: end;
  }

  header nav a {
    color: #01562c;
    text-decoration: none;
    font-size: 81%;
    padding: 18px 10px 18px 10px;
    margin-right: 8px;
  }
</style>