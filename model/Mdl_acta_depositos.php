  <?php
require_once('Connection.php');
date_default_timezone_set('America/Bogota');

class ActaDepositos{
	
	private
		$ConnMySQL = NULL;
		
	public function __construct(){
		$this->ConnMySQL = new MySQL();
    }
    
	
		
	public function HeadFactura(){ 
		
	    $Sql = "SELECT 
	               T1.*,T2.*
			  FROM 
			      representante T1
			  INNER JOIN
			      oficina T2
				   ON T1.ide_ofic = T2.ide_ofic
			  WHERE
			      T1.tip_repr = 'P' AND
				  T1.ind_esta = 'A'";
		
		return $this->ConnMySQL->ExecuteQuery($Sql,NULL,0);
		
	}
	
		
	public function ResolucionFacturaEscritura(){
		
	  $Sql = "SELECT 
	                * 
			  FROM 
			        resolucion_factura 
			  WHERE 
			        fec_fin_vig >= CURDATE() AND   /* valido que no este vencida la ResDIAN */
					tip_reso = 12 /* 12 es para facturas de escrituración*/
			  HAVING 
			        MAX(fec_reso)";	
					
		return $RsetNumeroResol =  $this->ConnMySQL->ExecuteQuery($Sql,NULL,0);
	}
	
	
	public function TipoIdentificacion(){
	
      $Sql = "SELECT
	                *
			  FROM
			       tipo_identificacion";
	   
	   return $this->ConnMySQL->ExecuteQuery($Sql,NULL,1);
	}
	
	public function EstadosActa(){
		
	  $Sql = "SELECT
	                *
			  FROM
			        acta_deposito_estado";
		
	   return $this->ConnMySQL->ExecuteQuery($Sql,NULL,1);
	}
	
	
	public function UltimaActa(){
		
	  $Sql = "SELECT 
	                *
              FROM
              		acta_deposito
              WHERE
                    num_acta = (SELECT MAX(num_acta) FROM acta_deposito)";
              		
	  return $this->ConnMySQL->ExecuteQuery($Sql,NULL,0);
	}
	
	
	public function Acta($acta){
		
	 $DataActa = explode('-', $acta);
	  
	  $Sql = "SELECT 
	               *
			  FROM
			       acta_deposito
			  WHERE
			        num_acta = $DataActa[1] AND
					YEAR(fec_acta) = $DataActa[0]";
		
	  return $this->ConnMySQL->ExecuteQuery($Sql,NULL,0);
	}
	
	
	public function GuardarActa($TipoIden,$Identifi,$NombreUsu,$Telefono,$FormaPago,$CheqBanco,$Concepto,$Escrituras,$DerechoNot,$BoletaFis,$Registro,$Otros,$Total,$Estado,$FechaRegi,$FechaRealRegi,$NumeroActa,$FechaActa){
		
		$id_usuario = $_SESSION['misession']['codigo_usuario'];
		$Fecha      = date('Y-m-d');
		$Anio       = date("Y", strtotime($FechaActa));
		$DerechoNot = ($DerechoNot != '') ? $DerechoNot : 0 ; 
		$BoletaFis  = ($BoletaFis != '')  ? $BoletaFis : 0 ;
        $Registro   = ($Registro != '')  ? $Registro : 0;
        $Otros      = ($Otros != '')  ? $Otros     : 0;
		$Total      = ($Total != '') ? $Total : 0 ;
		$CheqBanco  = ($CheqBanco != '') ? $CheqBanco : 0; 
		
	    if($NumeroActa == ''){
		       $Sql = "INSERT INTO
		                    acta_deposito(fec_acta,ide_clie,tip_ide_clie,nom_clie,tel_clie,obs_acta,num_radi,num_escr,val_dere_nota,val_bole,val_regi,val_otro,val_tota,for_pago,num_chequ,est_acta,cod_usua,fec_real_env_reg,fec_env_regi)
				       VALUES
				            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		
		     return  $Id_Inse =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($Sql, array($Fecha,$Identifi,$TipoIden,$NombreUsu,$Telefono,$Concepto,NULL,$Escrituras,$DerechoNot,$BoletaFis,$Registro,$Otros,$Total,$FormaPago,$CheqBanco,$Estado,$id_usuario,$FechaRealRegi,$FechaRegi));
	    }else{
		       $SqlUpd = "UPDATE 
			                    acta_deposito
						  SET
						        ide_clie = $Identifi,tip_ide_clie = '$TipoIden',nom_clie = '$NombreUsu',tel_clie = $Telefono,obs_acta = '$Concepto',num_escr = '$Escrituras',val_dere_nota = $DerechoNot,val_bole = $BoletaFis,val_regi = $Registro,val_otro = $Otros,val_tota = $Total,for_pago = '$FormaPago',num_chequ = $CheqBanco,est_acta = $Estado,fec_real_env_reg = '$FechaRealRegi', fec_env_regi = '$FechaRegi'
						  WHERE 
						        num_acta = $NumeroActa AND
					            YEAR(fec_acta) = $Anio";
			
			   return  $Id_Upd =  $this->ConnMySQL->ExecuteUpdateRow($SqlUpd, NULL);
	  
		}	
	}
	
	
	public function AutocompletarBuscarActas(){
	
      $Sql = "SELECT 
	               CONCAT(YEAR(fec_acta) ,'-', num_acta) AS acta 
			  FROM 
			       acta_deposito";

	  return $this->ConnMySQL->ExecuteQuery($Sql,NULL,1);
	}
	
	
	public function AutocompletarBuscarEscri(){
	
      $Sql = "SELECT 
	               CONCAT(YEAR(fec_escr) ,'-', num_escr) AS escritura 
			  FROM 
			       e_protocolo";

	   return $this->ConnMySQL->ExecuteQuery($Sql, NULL,1);
	}
	
	
	public function ListarActasPendientes(){
		
	  $Sql = "SELECT
	               num_acta,fec_acta,ide_clie,tip_ide_clie,nom_clie,tel_clie,obs_acta,num_radi,num_escr,val_bole,val_regi,val_otro,val_tota,
				   for_pago,num_chequ,est_acta,cod_usua,fec_env_regi,CONCAT(YEAR(fec_acta) ,'-', num_acta) AS Acta,
	               CASE est_acta
	                  WHEN 1 THEN 'PENDIENTE'
	                  WHEN 2 THEN 'ENTREGADO'
	                  WHEN 3 THEN 'ANULADO'
	                  WHEN 4 THEN 'ENVIADO'
	               END AS nom_estado
			  FROM
			        acta_deposito
			  WHERE
			        est_acta = 1";
		
	  return $this->ConnMySQL->ExecuteQuery($Sql,NULL,1);
	}
	
	
    public function BuscarActas($FechaIni,$FechaFin,$Acta,$Estado){
	
	   $NumActa = explode('-', $Acta);
	   $Where = "1";
	   if($FechaIni != '' && $FechaFin != ''){
		  $Where .= " AND T1.fec_acta BETWEEN '$FechaIni' AND '$FechaFin'";
	   }
	   if($FechaIni != '' && $FechaFin == ''){
		  $Where .= " AND T1.fec_acta = '$FechaIni'";
	   }
       if($FechaFin != '' && $FechaIni == ''){
		  $Where .= " AND T1.fec_acta = '$FechaFin'";
	   }
	   
	   /*** estado ***/
	   if($Estado != ''){
		   $Where.=" AND T1.est_acta = $Estado";
	   }
	   
	   if($Acta != '' && $FechaIni == '' && $FechaFin == ''){
		  $Where .= " AND T1.num_acta = $NumActa[1] AND YEAR(T1.fec_acta) = $NumActa[0]";
	   }
	
	    $Sql = "SELECT
	                  T1.*,CONCAT(T1.num_acta ,'-', YEAR(T1.fec_acta)) AS numero_acta,T2.nom_tipo
			    FROM 
			          acta_deposito T1
			    INNER JOIN 
				       acta_deposito_estado T2
					     ON T1.est_acta = T2.cod_tipo
			    WHERE 
			         $Where"; 

	  return $this->ConnMySQL->ExecuteQuery($Sql,NULL,1);
	 
    }
	
	
	

}
?>