<!DOCTYPE HTML">
<html>
<head>
<title>Comunidad Anime</title>
<!-- codificación -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- boostrap --> 
<link rel="stylesheet" type="text/css" href="../css/bootstrap/bootstrap.min.css">
<!-- data table -->
<!--<link rel="stylesheet" type="text/css" href="../css/data_table/jquery.dataTables.min.css">-->
<link rel="stylesheet" type="text/css" href="../css/data_table/dataTables.bootstrap.min.css">
<!-- animate -->
<link href="../css/animate/animate.css" rel="stylesheet"> 
<!-- boostrap -->
<script type="text/javascript" src="../js/jquery/jquery.js"></script>
<!-- jquery -->
<script type="text/javascript" src="../js/bootstrap/bootstrap.min.js"></script>
<!-- data table -->
<script type="text/javascript" src="../js/data_table/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/data_table/dataTables.bootstrap.min.js"></script>

</head>

<body>

<?php include_once('../template/menu.php'); ?>	

<div class="container">
<br><br>
<div class="table-responsive">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Subido</th>
				<th>Accionnn</th>
            </tr>
        </thead>
        <tbody>    
        </tbody>
    </table>
</div>
</div>

	
<script>
$(document).ready(function(){
   $('#example').DataTable({
      responsive: true,
	  "ajax" : {
		 "url": "../controller/ctl_animes.php/All_ANIMES",
		 "type": "POST"
	   },
	   "columns": [
		 {data : "ide_anim"},
		 {data : "nom_anim"},
		 {data : "fec_regi"}
	   ],
	   "columnDefs": [
	    {
		  "targets": [3],
          "data": "ide_anim",
          "render":	function(data, type, row){
		  return '<div class="dropdown"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action<span class="fa fa-caret-down"></span></button><ul class="dropdown-menu"><li><a href="#">Action</a></li><li><a href="#">Another action</a></li><li><a href="#">Something else here</a></li><li class="divider"></li><li><a href="#">Separated link</a></li></ul></div>';


		  }	  
	    }
	   ],
	   "order": [[0,"asc"]],
   });
   
    
}); 
 
</script>
</body>
</html>