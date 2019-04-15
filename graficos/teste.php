<?php

	require_once("../conexion/conexion.php");

		$sql=pg_query($conexao,"SELECT 
								
								faixaetaria , count(id) as qtd
								
								FROM 
								
								(SELECT 
								
								CONTRATO_PESSOA.id, (case 
										when extract(year from age(data_nascimento)) between 0 and 18 then '0 a 18'
										when extract(year from age(data_nascimento)) between 19 and 25 then '19 a 25'
										when extract(year from age(data_nascimento)) between 26 and 30 then '26 a 30'
										when extract(year from age(data_nascimento)) between 31 and 35 then '31 a 35'
										when extract(year from age(data_nascimento)) between 36 and 40 then '36 a 40'
										when extract(year from age(data_nascimento)) between 41 and 45 then '41 a 45'
										when extract(year from age(data_nascimento)) between 46 and 50 then '46 a 50'
										when extract(year from age(data_nascimento)) between 51 and 55 then '51 a 55'
										when extract(year from age(data_nascimento)) between 56 and 60 then '56 a 60'
										when extract(year from age(data_nascimento)) between 61 and 65 then '61 a 65'
										when extract(year from age(data_nascimento)) between 66 and 70 then '66 a 70'
										when extract(year from age(data_nascimento)) between 71 and 75 then '71 a 75'
										when extract(year from age(data_nascimento)) between 76 and 80 then '76 a 80'
										when extract(year from age(data_nascimento)) between 81 and 85 then '81 a 85'
										when extract(year from age(data_nascimento)) between 86 and 90 then '86 a 90'
										when extract(year from age(data_nascimento)) between 91 and 95 then '91 a 95'
										when extract(year from age(data_nascimento)) between 96 and 100 then '96 a 100'
										when extract(year from age(data_nascimento)) > 100 then '> 100'
										
									end) AS FAIXAETARIA
									
								
								FROM 
								
									
									CONTRATO_PESSOA
								
									INNER JOIN CONTRATO_CONTRATO ON  CONTRATO_CONTRATO.id = CONTRATO_PESSOA.contrato_id
								
									WHERE 
								
									CONTRATO_CONTRATO.ativo = 't'
									AND CONTRATO_PESSOA.ativo = 't'
									
								
									) as TABELA
								
									group by faixaetaria
									order by faixaetaria");


//Fechar conexao
		pg_close($conexao);

		$x = 0;

       while($registro = pg_fetch_assoc($sql)){
     		echo $registro["faixaetaria"]." = <br>";
     		$z[$x] = $registro["qtd"];

     		$x++;
    }
    
  
      for ($i=0; $i < $x; $i++) { 
      
       			 echo $z[$i]."<br>";                  

            }

?>			
