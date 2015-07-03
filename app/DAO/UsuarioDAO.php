<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

namespace app\DAO
{
	require '../libs/connect.php';

	public class UsuarioDAO
	{
		public function listaUsuarios()
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