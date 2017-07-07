<?php
class MySQL{
	private
		$Server = 'localhost',
		$Port = 3306,
		$dbName = 'anime',
		$UserName = 'root',
		$Password = 'developer',
		$Conn = NULL;
		
		
	public function Connect(){
		try{
			$this->Conn = new PDO(
				"mysql:host=$this->Server;port=$this->Port;dbname=$this->dbName",
				$this->UserName,
				$this->Password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			$this->Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $this->Conn;
	}
	
	public function ExecuteQuery($Sql, $Parameters, $Type){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
			
			if($Type == 0){
				$Rset = $Stmt->fetch(PDO::FETCH_ASSOC);
			}
			else{
				$Rset = $Stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Rset;
	}
	

	public function ExecuteInsert($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Conn->lastInsertId();
	}
	
	public function ExecuteInsertrowCount($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Stmt->rowCount();
	}
	
	public function ExecuteInsert_LastInsert_rowCount($Sql, $Parameters){
		
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		 $row = $Stmt->rowCount();
		 $id  = $Conn->lastInsertId();
		 
		 return array($id,$row); /// CREADO PARA GUARDAR EL ID DE CREACION EN EL LOG 
		           
	}
	
	
	public function ExecuteUpdate($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Conn->lastInsertId();
	}
	
	public function ExecuteUpdateRow($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Stmt->rowCount();
	}
	
	
}

?>