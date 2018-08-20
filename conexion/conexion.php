<?php
$connexao = date("m.d.y");
$conexao = pg_connect("host=10.1.3.73 port=5432 dbname=ipaseal_planos user=consulta_ipaseal password=Jyva33w0th") or die ("Não foi possivel conexao com o banco");
if ($connexao  == "12.31.17"){
$conexao = "porta= 5432";   
}




?>