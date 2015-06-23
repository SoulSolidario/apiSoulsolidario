<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

/*
     Metodo GET
     Possibilita api oferecer pela url https://localhost/Soulsolidario/usuario
     a listagem de todas entidades cadastradas.
*/

$app->get("/usuarios", function() use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("SELECT * FROM usuario");
          $dbh->execute();
          $usuarios = $dbh->fetchAll(PDO::FETCH_ASSOC);
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