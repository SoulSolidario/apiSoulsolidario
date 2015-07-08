<?php
namespace app\DAO
{
	require '../libs/connect.php';

	public class altDAO
	{
		public function getAlt()
		{
			try{
				$connection = getConnection();
				$dbh = $connection->prepare("SELECT * FROM usuario");
				$dbh->execute();
				$usuarios = $dbh->fetchAll(PDO::FETCH_ASSOC);
				$connection = null; 
     		}
     		catch(PDOException $e)
     		{
          		echo "Erro: " . $e->getMessage();
     		}
     		return $usuarios;
		}
	
	}

}
