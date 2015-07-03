<?php

if(!defined("SPECIALCONSTANT")) die ("Acesso negado!" );

function getConnection()
{
    try{
        $db_username = "root";
        $db_password = "JOR@dan12";
        $connection = new PDO("mysql:host=localhost;dbname=soulsolidario", $db_username, $db_password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    return $connection;
}