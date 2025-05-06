<?php
$dados = json_decode(file_get_contents('dados.json'),true);


if (!is_array($dados)){
    $dados = [];
}
$novoDado = [
    "username" => $_POST["username"],
    "password"=> $_POST["password"],
   
];

$dados [] =$novoDado;

file_put_contents("dados.json", json_encode($dados, JSON_PRETTY_PRINT));


header("refresh:0.5;url=index.html");
exit();
?>