 <!DOCTYPE HTML">
<html>
<head>
<title>Comunidad Anime</title>
<!-- codificación -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- boostrap --> 
<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
<!-- animate -->
<link href="css/animate/animate.css" rel="stylesheet"> 
<!-- boostrap -->
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<!-- jquery -->
<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
<style>
.carousel .item{
  width: 100%;
  max-height: 400px;
  overflow: hidden;
}
	  
.carousel .item img{
  width: 100%;
}

</style>

</head>

<body>

<?php include_once('template/menu.php'); ?>	

<!-- Galeria -->
<div class="container" style="background-color: silver;">
 <div class="row">
  <!--<h2>Foros de Discución</h2>-->  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/galeria/Boku-no-Hero-Academia.jpg" alt="" style="width:100%;">
		   <!-- caption para resolucion mayores a 768 -->
           <div class="carousel-caption zoomInDown animated hidden-xs">
		     <h2 style="" > Formaletas Metalicas </h2>  <hr><h3  style="">Trabajar en equipo divide el trabajo y multiplica los resultados </h3>
		   </div>
		   <!-- caption menores a resoluciones de 768 -->
		   <div class="carousel-caption  zoomInDown animated visible-xs">
		      <span style="" > Formaletas Metalicas </span>   
		   </div>
      </div>

      <div class="item">
        <img src="img/galeria/Masamune-kun-no-Revenge.jpg" alt="" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="img/galeria/toradora.jpg" alt="" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div><!-- fin de la row -->

</div>
 
</body>
</html>