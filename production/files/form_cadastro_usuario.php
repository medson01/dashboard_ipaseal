	<?php
	
		 // no início do arquivo
			session_start();
			
			
		 // banco de dados
		   require_once("../../conexion/conn_dw.php");
	
	?>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	
	
	
			<div class="modal-dialog">
				<div>
					<h1 align="center" class="style1">Cadastro de usu&aacute;rios</h1>
					<form action ="cadastro.php"method="post"class="form-group">
					  <label> </label>
                      <div align="center">
                        </p>
                        <fieldset>
                        <legend></legend>
        <table class="table table-striped" width="709" align="center">
               <tr>
                  <td width="236"><div align="center">Nome</div></td>
                  <td width="257"><div align="center">Login</div></td>
                  <td width="202"><div align="center">Perfil</div></td>
                  <td width="202"><div align="center"></div></td>
               </tr>
<?php

		$verifica = pg_query("SELECT * FROM usuarios") or die("erro ao carregar os usuários");
			while($registro = pg_fetch_assoc($verifica)){
				print "     <tr>
                              <td><div align='center'>".$registro["nome"]."</div></td>
                              <td><div align='center'>".$registro["login"]."</div></td>
                              <td><div align='center'>".$registro["perfil"]."</div></td>
                              <td><div align='center'><a class='btn btn-primary delete' href=deleta_inscricoes.php?id=".$registro["id"].">Excluir</a></div></td>
                            </tr>";
		    }
?>							
                            
          </table>
                          <div>
							<div class="panel panel-default">
									<div class="panel-heading">
                          <p>&nbsp;</p>
                          <table width="400"border="0"align="center">
                            <tr>
                              <td width="44"><font>Nome</font> </td>
                              <td width="818">
                                <div align="left">
                                  <input style="background:#faffbd; font-weight: bold; height: 45px; width:100%;" type="text" name="nome" id="nome" required="required" />
                              </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><div align="right"></div></td>
                            </tr>
                            <tr>
                              <td>Login</td>
                              <td>
                                <div align="left">
                                  <input style="background:#faffbd; font-weight: bold; height: 45px; width:100%;" type="text" name="login" id="login"  required="required" />
                                </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><p>Senha</p>                              </td>
                              <td><input style="background:#faffbd; font-weight: bold; " type="password" name="senha" id="senha"  required="required" /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Perfil</td>
                              <td><select id="perfil" name="perfil" required="required" style="width:100%" style="background:#faffbd;">
                                <option  value="administrador">Administrador</option>
                                <option  value="usuario">Usuario</option>

                              </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><div align="right">
                                <input style="background:#CCCCCC; font-weight: bold; height: 35px; width:90px;"class="btn btn-default"type="submit" value="Cadastrar" id="entrar" name="entrar"  />
                              </div></td>
                            </tr>
                          </table>
						  </div>	
						  </div>
                          <br />
						</div>
				    </div>
                        </fieldset>
                      </div>
				  </form>
					<div class="login-help">
				  </div>
		    </div>
			</div>
		  </div>

<?php 

  pg_close($conexao);
    
  ?>
  </span></div>
 
  
</body>
<span class="style2">
</html>
</span>