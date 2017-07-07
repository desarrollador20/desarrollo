  <?php 
require_once('../model/mdl_animes.php');
$Objeto = new Anime();

  switch(true){
   case 'All_ANIMES': 
     $RsetData = $Objeto->ListaAnime();
	 $arreglo = array();
	 
	 foreach($RsetData as $ListaAnime => $Row){
	   $arreglo["data"][] = array('nom_anim' => $Row['nom_anim'], 'ide_anim' => $Row['ide_anim'], 'fec_regi' => $Row['fec_regi']);
	 }
	  echo json_encode($arreglo);
	  
	     
		 
   break; 
   case "dos":
     echo "holaaaa";
   break;   

}



?>