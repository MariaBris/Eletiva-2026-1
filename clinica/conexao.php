<?php

    $dominio = "mysql:host=localhost;port=3306;dbname=mydb";
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch(Exception $e){
        die("Erro ao conectar ao banco: ". $e->getMessage());
    }