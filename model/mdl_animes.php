    <?php
require_once('Connection.php');

class Anime{
	
	private
		$ConnMySQL = NULL;
		
	public function __construct(){
		$this->ConnMySQL = new MySQL();
    }
    
	
		
	public function ListaAnime(){ 
		
	    $Sql = "SELECT 
	                 T1.ide_anim,T1.nom_anim,T1.img_anim,DATE_FORMAT(T1.fec_regi,'%Y-%m-%d') AS fec_regi
			    FROM 
			         animes T1";
		
		return $this->ConnMySQL->ExecuteQuery($Sql,NULL,1);
		
	}
	
	
	

}
?>