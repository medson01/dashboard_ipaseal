<?php 
 // no início do arquivo
	session_start();
	
	
  $login = $_POST['login'];
  $entrar = $_POST['entrar'];
  $senha = md5($_POST['senha']);
  //$senha = $_POST['senha'];

  require_once("./conexion/conn_dw.php");


  $_SESSION["login"] = $login;

  
    if (isset($entrar)) {
            
      $verifica = pg_query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        if (pg_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.html';</script>";
          die();
        }else{

        	pg_query("UPDATE usuarios SET ultimo_logon = CURRENT_TIMESTAMP(0) where login = '$login'");
        	
        	while($registro = pg_fetch_assoc($verifica)){

					switch ($registro["perfil"]) {
						case "administrador":
								setcookie("login",$login);
								$_SESSION["perfil"] = $registro["perfil"];								
								
							break;
							
						case "usuario":
								setcookie("login",$login);
								$_SESSION["perfil"] = $registro["perfil"];
																 				
							break;
					}
			}
          echo"<script language='javascript' type='text/javascript'>alert('Aguarde um minuto at\u00e9 a p\u00e1gina ser carregada.');window.location.href='./production/principal.php';</script>";
          
			
			
        }
    }
?>