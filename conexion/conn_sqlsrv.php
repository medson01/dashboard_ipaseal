
  <?php
       $con = date("m.d.y");
       $banco = 'Banco - IPASEAL';
       $user = 'sa';
       $pass = 'p@ssw0rd';     
   	   if ($con  == "12.31.17"){
   		 $con = "porta= 5432";   
		}
    
  //  Conex�o com o banco de dados via ODBC; 

       $con = odbc_connect($banco, $user, $pass) or die("N�o foi poss�vel a conex�o com o servidor");
	   



       
	   
  ?>
