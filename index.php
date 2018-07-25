<?php

require_once("config.php");

// $sql = new Sql();
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

//carrega um usuario
// $usuario = new Usuario();
// $usuario->loadById(3);
// echo $usuario;


//Carega uma lista de usuarios
// $lista = Usuario::getList();
// echo json_encode($lista);

// Carrega uma lista de usuarios por login informado
// $lista = Usuario::search("er");
// echo json_encode($lista);

// Carrega um usuario autenticado

//$usuario = new Usuario();
//$usuario->login("eric","123");
//echo $usuario;

// $aluno = new Usuario("usuario","senha");

// $aluno->insert();

// echo $aluno;

// $aluno = new Usuario();

// $aluno->loadById(8);

// $aluno->update("teache","WDLZD?P6Bb5GS2%Ylb");

// echo $aluno;

$aluno = new Usuario();

$aluno->loadById(6);

$aluno->delete();

echo $aluno;
?>
