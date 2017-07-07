<?php 
function PosicionActual($cad){
  $url= $_SERVER["REQUEST_URI"];
  $parametro = "view";
  $pos = strpos($url, $parametro);
  $res = ($pos == false) ? "" : "../"; /*si esta en vista se pone la raiz para ir atras */
   return $res.$cad;
}


?>
<!-- Menu -->
<nav class="navbar navbar-default" style="margin-bottom:2px">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo PosicionActual('index.php') ?>">Comunidad Anime</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo PosicionActual('index.php') ?>" >Inicio <span class="sr-only">(current)</span></a></li>
        <li><a href="view/foro.php">Foros</a></li>
        <li><a href="#">Conocimientos</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
	    <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
        <li><a href="#">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>