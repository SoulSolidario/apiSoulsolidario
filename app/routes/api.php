<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

/*
     Metodo GET
     Possibilita api oferecer pela url https://localhost/Soulsolidario/usuarios
     a listagem de todas usuários cadastradas.
*/

$app->get("/usuarios", function() use($app)
{
     try{ 
          require_once 'app/DAO/UsuarioDAO.php';

         $usuarioDao = new UsuarioDAO();
         $usuarios = $usuarioDao->listaUsuarios();

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($usuarios));
     }
     catch(PDOException $e)
     {
          echo "Erro: " . $e->getMessage();
     }
});

/*
     Metodo GET - passando parâmetro.
     Possibilita a api oferecer as informações detalhada (perfil) de um usuário cadastrado
     A url deve ser consumida passando um parâmetro para seleção. No caso, @codUser.
*/

$app->get("/usuarios/:codUser", function($codUser) use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("SELECT * FROM usuario WHERE codUser = ?");
          $dbh->bindParam(1, $codUser);
          $dbh->execute();
          $usuario = $dbh->fetchObject();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($usuarios));
     }
     catch(PDOException $e)
     {
          echo "Erro: " . $e->getMessage();
     }
});



$app->post("/usuarios/", function() use($app)
{
     $nome = $app->request->post("nome");
     $email = $app->request->post("email");

     try{
          $connection = getConnection();
          $dbh = $connection->prepare("INSERT INTO usuario VALUES(?, ?)");
          $dbh->bindParam(1, $nome);
          $dbh->bindParam(2, $email);
          $dbh->execute();
          $ultimoUsuarioCadastrado = $connection->lastInsertId();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($ultimoUsuarioCadastrado));
     }
     catch(PDOException $e)
     {
          echo "Error: " . $e->getMessage();
     }
});