<body>
<header>
  <div class="LogoEncubarhuila">
    <a href="http://www.incubarhuila.co/" title="Incubarhuila"><img src="<?php echo media();?>images/logo.png"></a>
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
  <img src="<?php echo media();?>images/img.png">
</div>
<div class="enunciado">
  <div class="Icono_enunciado">
    <img src="<?php echo media();?>images/mesa_ayuda.png">
  </div>
  <h1><b> MESA DE AYUDA Y SOPORTE TECNICO</b></h1>
</div>


<style>
  header {
    display: flex;
    padding: 1.2% 14.5% 0.8% 8.5%;
    justify-content: space-between;
    align-items: center
  }
  .LogoEncubarhuila {
    display: flex;
  }
  header a.activo{
    color: #F9BF00;
    background-color: #01562C;
    border-radius: 3px;
    padding: 18px 10px 18px 10px;
  }

  .LogoEncubarhuila img {
    height: 67.7pt;
    padding: 0;
    margin: 0
  }
  header nav a {
    color: #01562C;
    text-decoration: none;
    font-size: 81%;
    padding: 2px 10px 18px 10px;
  }
  header nav a:hover {
    color: #F9BF00;
    background-color: #01562C;
    border-radius: 3px;
    padding: 18px 10px 18px 10px;
  }
  .cabezal {
    background-color: #F9BF00;
    padding-left: 4%;
    padding-right: 14.5%;
  }
  .cabezal img{
    width: 13%;
    padding:9px;
    margin-left:4%;
  }
  .enunciado {
    background-image: linear-gradient(rgba(252, 255, 255,0.2),rgba(255, 255, 255,0.2)),url(img/logo_oficina.png);
    background-size: cover;
    /* background-color: #FCB900; */
    display: flex;
    padding: 3% 9% 3% 14%;
    margin: 2% 10% 1% 8.5%;
    align-items: end;
  }
  .Icono_enunciado img {
    height: 60pt;
  }
  .enunciado h1 {
    padding-left: 1%;
    margin: 0;
  }

</style>