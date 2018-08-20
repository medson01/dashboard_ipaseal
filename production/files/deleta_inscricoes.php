<?php

require_once("../../conexion/conn_dw.php");
$id = $_GET['id'];
$deleta = pg_query("DELETE FROM usuarios WHERE id = '$id'");
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"form_cadastro_usuario.php\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"form_cadastro_usuario.php\"</script>";
}
?>