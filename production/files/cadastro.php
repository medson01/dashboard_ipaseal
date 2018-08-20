
<?php 

		 // banco de dados
		   require_once("../../conexion/conn_dw.php");


$nome = $_POST["nome"];
$login = $_POST["login"];
$perfil = $_POST["perfil"];
$senha = md5($_POST['senha']);
//$senha = $_POST["senha"];
$sql = "SELECT login FROM usuarios WHERE login = '$login'";
$select = pg_query($conexao, $sql);
$array = pg_fetch_array($sql, 1, PGSQL_ASSOC);
$logarray = $array['login'];

  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='form_cadastro_usuario.php';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>alert('Esse login j\u00e1 existe');window.location.href='form_cadastro_usuario.php';</script>";
        die();

      }else{
        $query = "INSERT INTO usuarios (nome,login,senha,perfil) VALUES ('$nome','$login','$senha','$perfil')";
        $insert = pg_query($conexao, $query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Usu\u00e1rio cadastrado com sucesso!');window.location.href='form_cadastro_usuario.php'</script>";
        }else{
       //   echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse Usu\u00e1rio');window.location.href='form_cadastro_usuario.php' </script>";
        }
      }
    }
?>