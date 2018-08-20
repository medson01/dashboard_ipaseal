<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	background-image: url(imagem/servicos.png);
	background-repeat: no-repeat;
}

.style2 {
	font-family: Arial;
	font-weight: bold;
	font-size: 36px;
	color: #000000;
}

.style4 {
	font-family: Arial;
	font-weight: bold;
	font-size: 20px;
	color: #FFFFFF;
}


-->
</style></head>

<body>

</p>

</div>
<p>&nbsp;</p>

<p /></div>

<?php

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");  
	
	
    
  
    

    include("./conexion/conn_sqlsrv.php");


	$sql_internamento = "SELECT COUNT (*) AS INTERNAMENTO FROM
(SELECT DISTINCT  BE2_CODPRO, BE2_DESPRO,BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BA1_NOMUSR,BA1_CPFUSR,BAU_CODIGO,BAU_NOME,BAU_SIGLCR,BAU_CONREG, BAQ_CODESP,BAQ_DESCRI,BE2_CDPFSO,BE2_NOMSOL, 
( SELECT SUM(BD4_VLMED) FROM BD4010 WHERE BD4_CODPRO = BE2_CODPRO) AS VALOR 

	FROM BA1010 ,BE2010 , BA3010 , BAU010 , BAQ010 
WHERE BA1_CONEMP = BE2_CONEMP 					   
AND   BA1_CODEMP = BE2_CODEMP
AND   BA1_MATRIC = BE2_MATRIC 
AND   BA1_TIPREG = BE2_TIPREG
AND   BA1_MATRIC = BA3_MATRIC
AND   BA1_CODEMP = BA3_CODEMP
AND   BE2_CODRDA = BAU_CODIGO
AND   BE2_CODESP = BAQ_CODESP


AND   BE2_DATPRO BETWEEN '".$ano.$mes."01' AND '".$ano.$mes.$dia."'

AND   BE2_CODRDA <> '000871'   --> RDA GENERICO

AND   BE2_CODPRO = '10102019'
AND   BE2_STATUS = '1'		   
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";

	$sql_consultas_medica = "SELECT COUNT (*) AS CONSULTAS_MEDICA FROM
(SELECT DISTINCT  BE2_CODPRO, BE2_DESPRO,BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BA1_NOMUSR,BA1_CPFUSR,BAU_CODIGO,BAU_NOME,BAU_SIGLCR,BAU_CONREG, BAQ_CODESP,BAQ_DESCRI,BE2_CDPFSO,BE2_NOMSOL, 
( SELECT SUM(BD4_VLMED) FROM BD4010 WHERE BD4_CODPRO = BE2_CODPRO) AS VALOR 

	FROM BA1010 ,BE2010 , BA3010 , BAU010 , BAQ010 
WHERE BA1_CONEMP = BE2_CONEMP 					   
AND   BA1_CODEMP = BE2_CODEMP
AND   BA1_MATRIC = BE2_MATRIC 
AND   BA1_TIPREG = BE2_TIPREG
AND   BA1_MATRIC = BA3_MATRIC
AND   BA1_CODEMP = BA3_CODEMP
AND   BE2_CODRDA = BAU_CODIGO
AND   BE2_CODESP = BAQ_CODESP


AND   BE2_DATPRO BETWEEN '".$ano.$mes."01' AND '".$ano.$mes.$dia."'

AND   BE2_CODPRO = '10101012' --> CONSULTA MÉDICA

AND   BE2_CODRDA <> '000871'  --> RDA GENERICO

AND   BE2_STATUS = '1'		   
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";


	$sql_consultas_odont = "SELECT COUNT (*) AS CONSULTAS_ODONT FROM
(SELECT DISTINCT  BE2_CODPRO, BE2_DESPRO,BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BA1_NOMUSR,BA1_CPFUSR,BAU_CODIGO,BAU_NOME,BAU_SIGLCR,BAU_CONREG, BAQ_CODESP,BAQ_DESCRI,BE2_CDPFSO,BE2_NOMSOL, 
( SELECT SUM(BD4_VLMED) FROM BD4010 WHERE BD4_CODPRO = BE2_CODPRO) AS VALOR 

	FROM BA1010 ,BE2010 , BA3010 , BAU010 , BAQ010 
WHERE BA1_CONEMP = BE2_CONEMP 					   
AND   BA1_CODEMP = BE2_CODEMP
AND   BA1_MATRIC = BE2_MATRIC 
AND   BA1_TIPREG = BE2_TIPREG
AND   BA1_MATRIC = BA3_MATRIC
AND   BA1_CODEMP = BA3_CODEMP
AND   BE2_CODRDA = BAU_CODIGO
AND   BE2_CODESP = BAQ_CODESP


AND   BE2_DATPRO BETWEEN '".$ano.$mes."01' AND '".$ano.$mes.$dia."'

AND   BE2_CODPRO = '10001000' --> CONSULTA ODONTOLOGIA

AND   BE2_CODRDA <> '000871'  --> RDA GENERICO

AND   BE2_STATUS = '1'		   
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";

	$sql_exames = "SELECT COUNT (*) AS EXAMES  FROM 
(SELECT DISTINCT  BE2_CODPRO, BE2_DESPRO,BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BA1_NOMUSR,BA1_CPFUSR,BAU_CODIGO,BAU_NOME,BAU_SIGLCR,BAU_CONREG, BAQ_CODESP,BAQ_DESCRI,BE2_CDPFSO,BE2_NOMSOL, 
( SELECT SUM(BD4_VLMED) FROM BD4010 WHERE BD4_CODPRO = BE2_CODPRO) AS VALOR 

	FROM BA1010 ,BE2010 , BA3010 , BAU010 , BAQ010 
WHERE BA1_CONEMP = BE2_CONEMP 					   
AND   BA1_CODEMP = BE2_CODEMP
AND   BA1_MATRIC = BE2_MATRIC 
AND   BA1_TIPREG = BE2_TIPREG
AND   BA1_MATRIC = BA3_MATRIC
AND   BA1_CODEMP = BA3_CODEMP
AND   BE2_CODRDA = BAU_CODIGO
AND   BE2_CODESP = BAQ_CODESP


AND   BE2_DATPRO BETWEEN '".$ano.$mes."01' AND '".$ano.$mes.$dia."'

AND   BE2_CODRDA <> '000871'   --> RDA GENERICO

AND   BE2_CODPRO <> '10101012' --> CONSULTA MÉDICA
AND   BE2_CODPRO <> '10001000' --> CONSULTA ODONTOLOGIA

AND   BE2_CODPRO <> '10102019' --> VISITA HOSPITALAR (PACIENTE INTERNADO - INTERNAMENTO) 

AND   BE2_CODPRO <> '50000012' --> SESSÃO DE PSICOLOGIA
AND   BE2_CODPRO <> '50000020' --> SESSÃO DE NUTRIÇÃO
AND   BE2_CODPRO <> '50000039' --> SESSÃO DE FONOAUDIOLOGIA 

AND   BE2_CODPRO NOT LIKE '3%' --> PELE E TECIDO CELULAR SUBCUTÂNEO / CABECA E PESCOSO / MAMAS / SISTEMA MÚSCULO-ESQUELÉTICO E ARTICULAÇÕES
AND   BE2_CODPRO NOT LIKE '5%' --> TABELA DE COFFITO (FISIOTERAPIA)
AND   BE2_CODPRO NOT LIKE '6%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '7%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '8%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '9%' --> NÃO TABELA CHPM
AND   BE2_CODPRO <> '20103115' --> ATIVIDADE REFLEXA OU APLICACAO DE TECNICA CINESIOTERAPICA ESPECIFICA                                                         
AND   BE2_CODPRO <> '20103360' --> PACIENTE COM D.P.O.C. EM ATENDIMENTO AMBULATORIAL NECESSITANDO REEDUCACAO E REABILITACAO RESPIRATORIA
AND   BE2_CODPRO <> '20103476' --> PATOLOGIA NEUROLOGICA COM DEPENDENCIA DE ATIVIDADES DA VIDA DIARIA                                                           
AND   BE2_CODPRO <> '20103484' --> PATOLOGIA OSTEOMIOARTICULAR EM UM MEMBRO                         
AND   BE2_CODPRO <> '20103492' --> PATOLOGIA OSTEOMIOARTICULAR EM DOIS OU MAIS MEMBROS                                                                                            
AND   BE2_CODPRO <> '20103506' --> PATOLOGIA OSTEOMIOARTICULAR EM UM SEGMENTO DA COLUNA                                                                                       
AND   BE2_CODPRO <> '20103514' --> PATOLOGIA OSTEOMIOARTICULAR EM DIFERENTES SEGMENTOS DA COLUNA                                                                    
AND   BE2_CODPRO <> '20103522' --> PATOLOGIAS OSTEOMIOARTICULARES COM DEPENDUNCIA DE ATIVIDADES DA VI                                                             
AND   BE2_CODPRO <> '20103654' --> RECUPERACAO FUNCIONAL DE DISTURBIOS CRANIO-FACIAIS                                                                                        
AND   BE2_CODPRO <> '20103727' --> REABILITAþOO  CARDÝACA SUPERVISIONADA. PROGRAMA DE 12 SEMANAS. DUA                                                          
AND   BE2_CODPRO <> '50000004' --> OFTALMOLOGIA 

 
  
AND   BE2_STATUS = '1'		   
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";

	$sql_cicurgia = "SELECT COUNT (*) AS CICURGIAS  FROM 
(SELECT DISTINCT  BE2_CODPRO, BE2_DESPRO,BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BA1_NOMUSR,BA1_CPFUSR,BAU_CODIGO,BAU_NOME,BAU_SIGLCR,BAU_CONREG, BAQ_CODESP,BAQ_DESCRI,BE2_CDPFSO,BE2_NOMSOL, 
( SELECT SUM(BD4_VLMED) FROM BD4010 WHERE BD4_CODPRO = BE2_CODPRO) AS VALOR 

	FROM BA1010 ,BE2010 , BA3010 , BAU010 , BAQ010 
WHERE BA1_CONEMP = BE2_CONEMP 					   
AND   BA1_CODEMP = BE2_CODEMP
AND   BA1_MATRIC = BE2_MATRIC 
AND   BA1_TIPREG = BE2_TIPREG
AND   BA1_MATRIC = BA3_MATRIC
AND   BA1_CODEMP = BA3_CODEMP
AND   BE2_CODRDA = BAU_CODIGO
AND   BE2_CODESP = BAQ_CODESP


AND   BE2_DATPRO BETWEEN '".$ano.$mes."01' AND '".$ano.$mes.$dia."'
AND   BE2_CODRDA <> '000871'   --> RDA GENERICO


AND   BE2_CODPRO <> '10101012' --> CONSULTA MÉDICA
AND   BE2_CODPRO <> '10001000' --> CONSULTA ODONTOLOGIA
AND   BE2_CODPRO <> '10102019' --> VISITA HOSPITALAR (PACIENTE INTERNADO - INTERNAMENTO) 

AND   BE2_CODPRO <> '50000012' --> SESSÃO DE PSICOLOGIA
AND   BE2_CODPRO <> '50000020' --> SESSÃO DE NUTRIÇÃO
AND   BE2_CODPRO <> '50000039' --> SESSÃO DE FONOAUDIOLOGIA 

AND   BE2_CODPRO LIKE '3%' --> PELE E TECIDO CELULAR SUBCUTÂNEO / CABECA E PESCOSO / MAMAS / SISTEMA MÚSCULO-ESQUELÉTICO E ARTICULAÇÕESB (CICURGIAS)
AND   BE2_CODPRO <> '30909031' --> MODIALISE CRONICA (POR SESSAO)
AND   BE2_CODPRO <> '30001005' --> KIT DE PREVENCAO 1          

AND   BE2_CODPRO NOT LIKE '5%' --> TABELA DE COFFITO (FISIOTERAPIA)
AND   BE2_CODPRO NOT LIKE '6%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '7%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '8%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '9%' --> NÃO TABELA CHPM
AND   BE2_CODPRO <> '20103115' --> ATIVIDADE REFLEXA OU APLICACAO DE TECNICA CINESIOTERAPICA ESPECIFICA                                                         
AND   BE2_CODPRO <> '20103360' --> PACIENTE COM D.P.O.C. EM ATENDIMENTO AMBULATORIAL NECESSITANDO REEDUCACAO E REABILITACAO RESPIRATORIA
AND   BE2_CODPRO <> '20103476' --> PATOLOGIA NEUROLOGICA COM DEPENDENCIA DE ATIVIDADES DA VIDA DIARIA                                                           
AND   BE2_CODPRO <> '20103484' --> PATOLOGIA OSTEOMIOARTICULAR EM UM MEMBRO                         
AND   BE2_CODPRO <> '20103492' --> PATOLOGIA OSTEOMIOARTICULAR EM DOIS OU MAIS MEMBROS                                                                                            
AND   BE2_CODPRO <> '20103506' --> PATOLOGIA OSTEOMIOARTICULAR EM UM SEGMENTO DA COLUNA                                                                                       
AND   BE2_CODPRO <> '20103514' --> PATOLOGIA OSTEOMIOARTICULAR EM DIFERENTES SEGMENTOS DA COLUNA                                                                    
AND   BE2_CODPRO <> '20103522' --> PATOLOGIAS OSTEOMIOARTICULARES COM DEPENDUNCIA DE ATIVIDADES DA VI                                                             
AND   BE2_CODPRO <> '20103654' --> RECUPERACAO FUNCIONAL DE DISTURBIOS CRANIO-FACIAIS                                                                                        
AND   BE2_CODPRO <> '20103727' --> REABILITAþOO  CARDÝACA SUPERVISIONADA. PROGRAMA DE 12 SEMANAS. DUA                                                          
AND   BE2_CODPRO <> '50000004' --> OFTALMOLOGIA 

 
  
AND   BE2_STATUS = '1'		   
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";


	$sql_psicologia = "SELECT COUNT (*) AS PSICOLOGIAS  FROM 
(SELECT DISTINCT  BE2_CODPRO, BE2_DESPRO,BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BA1_NOMUSR,BA1_CPFUSR,BAU_CODIGO,BAU_NOME,BAU_SIGLCR,BAU_CONREG, BAQ_CODESP,BAQ_DESCRI,BE2_CDPFSO,BE2_NOMSOL, 
( SELECT SUM(BD4_VLMED) FROM BD4010 WHERE BD4_CODPRO = BE2_CODPRO) AS VALOR 

	FROM BA1010 ,BE2010 , BA3010 , BAU010 , BAQ010 
WHERE BA1_CONEMP = BE2_CONEMP 					   
AND   BA1_CODEMP = BE2_CODEMP
AND   BA1_MATRIC = BE2_MATRIC 
AND   BA1_TIPREG = BE2_TIPREG
AND   BA1_MATRIC = BA3_MATRIC
AND   BA1_CODEMP = BA3_CODEMP
AND   BE2_CODRDA = BAU_CODIGO
AND   BE2_CODESP = BAQ_CODESP


AND   BE2_DATPRO BETWEEN '".$ano.$mes."01' AND '".$ano.$mes.$dia."'
AND   BE2_CODRDA <> '000871'   --> RDA GENERICO


AND   BE2_CODPRO <> '10101012' --> CONSULTA MÉDICA
AND   BE2_CODPRO <> '10001000' --> CONSULTA ODONTOLOGIA

AND   BE2_CODPRO <> '10102019' --> VISITA HOSPITALAR (PACIENTE INTERNADO - INTERNAMENTO) 

AND   BE2_CODPRO = '50000012' --> SESSÃO DE PSICOLOGIA

AND   BE2_CODPRO <> '50000020' --> SESSÃO DE NUTRIÇÃO
AND   BE2_CODPRO <> '50000039' --> SESSÃO DE FONOAUDIOLOGIA 

AND   BE2_CODPRO NOT LIKE '3%' --> PELE E TECIDO CELULAR SUBCUTÂNEO / CABECA E PESCOSO / MAMAS / SISTEMA MÚSCULO-ESQUELÉTICO E ARTICULAÇÕESB (CICURGIAS)


AND   BE2_CODPRO NOT LIKE '6%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '7%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '8%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '9%' --> NÃO TABELA CHPM
AND   BE2_CODPRO <> '20103115' --> ATIVIDADE REFLEXA OU APLICACAO DE TECNICA CINESIOTERAPICA ESPECIFICA                                                         
AND   BE2_CODPRO <> '20103360' --> PACIENTE COM D.P.O.C. EM ATENDIMENTO AMBULATORIAL NECESSITANDO REEDUCACAO E REABILITACAO RESPIRATORIA
AND   BE2_CODPRO <> '20103476' --> PATOLOGIA NEUROLOGICA COM DEPENDENCIA DE ATIVIDADES DA VIDA DIARIA                                                           
AND   BE2_CODPRO <> '20103484' --> PATOLOGIA OSTEOMIOARTICULAR EM UM MEMBRO                         
AND   BE2_CODPRO <> '20103492' --> PATOLOGIA OSTEOMIOARTICULAR EM DOIS OU MAIS MEMBROS                                                                                            
AND   BE2_CODPRO <> '20103506' --> PATOLOGIA OSTEOMIOARTICULAR EM UM SEGMENTO DA COLUNA                                                                                       
AND   BE2_CODPRO <> '20103514' --> PATOLOGIA OSTEOMIOARTICULAR EM DIFERENTES SEGMENTOS DA COLUNA                                                                    
AND   BE2_CODPRO <> '20103522' --> PATOLOGIAS OSTEOMIOARTICULARES COM DEPENDUNCIA DE ATIVIDADES DA VI                                                             
AND   BE2_CODPRO <> '20103654' --> RECUPERACAO FUNCIONAL DE DISTURBIOS CRANIO-FACIAIS                                                                                        
AND   BE2_CODPRO <> '20103727' --> REABILITAþOO  CARDÝACA SUPERVISIONADA. PROGRAMA DE 12 SEMANAS. DUA                                                          
AND   BE2_CODPRO <> '50000004' --> OFTALMOLOGIA 

 
  
AND   BE2_STATUS = '1'		   
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";



  // Execu??o do Select com o banco
  
      		$internamento = odbc_exec ($con, $sql_internamento); 
            $consultas_medica = odbc_exec ($con, $sql_consultas_medica); 
            $consultas_odon = odbc_exec ($con, $sql_consultas_odont);
            $exames = odbc_exec ($con, $sql_exames);
            $cicurgia = odbc_exec ($con, $sql_cicurgia); 
            $psicologia = odbc_exec ($con, $sql_psicologia); 
              
              
  // Pegar valores 
  
  
  while ($rows = odbc_fetch_object($internamento)) { 
  	
  			$inter = $rows->INTERNAMENTO;
  
  }
  
    while ($rows = odbc_fetch_object($consultas_medica)) { 
  	
  			$medica = $rows->CONSULTAS_MEDICA;
  
  }
  
      while ($rows = odbc_fetch_object($consultas_odon)) { 
  	
  			$odont = $rows->CONSULTAS_ODONT;
  
  }
  
      while ($rows = odbc_fetch_object($exames)) { 
  	
  			$exame = $rows->EXAMES;
  
  }
  
      while ($rows = odbc_fetch_object($cicurgia)) { 
  	
  			$cicur = $rows->CICURGIAS;
  
  }
  
      while ($rows = odbc_fetch_object($psicologia)) { 
  	
  			$psico = $rows->PSICOLOGIAS;
  
  }
  
            
  odbc_close($con);


			$consult = $medica + $odont;
			$total =  $inter + $exame + $cicur + $psico + $medica + $odont;

echo "


<p>&nbsp;</p>
</br>
</br>

</br>
<div  align='center'>
<table width='900' height='55' border='0' >
  <tr>
<th width='198' height='49' scope='col'><span class='style4'>".$inter."</span></th>
    <th width='196' scope='col'><span class='style4'>".$consult."&nbsp;&nbsp;&nbsp;</span></th>
    <th width='156' scope='col'><span class='style4'>&nbsp;&nbsp;".$psico."</span></th>
	<th width='233' scope='col'><span class='style4'>".$exame."&nbsp;&nbsp;</span></th>
	<th width='136' scope='col'><span class='style4'>".$cicur."</span></th>
  </tr>
</table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</br>
</br>
<table width='1030' height='55' border='0' >
  <tr>
    <th height='49' scope='col'><div align='right' class='style4'>".$mes."/".$ano."</div></th>
  </tr>
</table>

 </br>
<table width='1100' height='55' border='0' >
  <tr>
    
    <th scope='col'><div align='center'  class='style2'>".$total."</div></th>
   
  </tr>
</table>";



?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;	</p>
</body>
</html>