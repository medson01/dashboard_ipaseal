<?php
$connexao = date("m.d.y");
$conexao = pg_connect("host=10.15.1.14 port=5432 dbname=dw_ipaseal user=postgres password=postgres") or die ("Não foi possivel conexao com o banco");
if ($connexao  == "12.31.17"){
$conexao = "porta= 5432";   
}




?>