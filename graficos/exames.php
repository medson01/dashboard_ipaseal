<?php

    	// BANCO DE DADOS
			
	include("../conexion/conn_sqlsrv.php");
	include("../conexion/conn_dw.php");
	
                
       date_default_timezone_set('America/Maceio');

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");  
	
	

   $mes_extenso = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    );    
  $mes2 = array(
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Marco',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    );            
            
       $sql01=pg_query($conexao,"select mes, quantidade as qtd from fato_procedimento 
								inner join dim_tempo on dim_tempo.id_tempo = fato_procedimento.id_tempo 
							   where
								ano = '".$ano."'
							 	and  codigo = '00000000'");
								
	   $sql02="SELECT '00000000' AS EXAMES, COUNT(*) AS TOTAL FROM 
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

-- AND   BE2_CODPRO <> '50000012' --> SESSÃO DE PSICOLOGIA
-- AND   BE2_CODPRO <> '50000020' --> SESSÃO DE NUTRIÇÃO
-- AND   BE2_CODPRO <> '50000039' --> SESSÃO DE FONOAUDIOLOGIA
-- AND   BE2_CODPRO <> '50000004' --> OFTALMOLOGIA  

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


 
  
AND   BE2_STATUS = '1'       
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*'


) 
AS TABELA;";


		// executar consultas 
		 $consultas = odbc_exec ($con, $sql02);		 
    
        //teste de consulta
        if (!$sql01) {
        echo "Erro na consulta banco DW.<br>";  
        }
		//teste de consulta
        if (!$sql02) {
        echo "Erro na consulta banco TOTVs.<br>";  
        }
        
		while ($rows = odbc_fetch_object($consultas)) { 
		
			$constotal = $rows->TOTAL;
		 }

		 
        //Fechar conexao
        pg_close($conexao);
        odbc_close($con);
        

?>
<!DOCTYPE HTML>
<html>
    <head>
	
	<!-- Bootstrap -->
    
    <script src="http://code.jquery.com/jquery.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
    <script src="../bootstrap/js/bootstrap.min.js"></script>
		
    <!---->
	
	
	
	
	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar',
            style: {
                fontSize: '10px' // Aummenta a fonto da legenda "Quandidade de pessoas" na barra
            }
        },
        title: {
            text: 'Gráfico',
            style: {
                fontSize: '25px'
            }
        },
        //subtitle: {
        //    text: 'Ipaseal Saude'
        //},
        xAxis: {
            categories: [ 

            <?php

                    $linha = pg_num_rows($sql01);       

                    error_reporting(0);

                    $x=1;
					

                    while( $row = pg_fetch_array( $sql01 ) ) {
                        $qtd[$x] = $row [qtd]; 
						            $mes[$x] = $row [mes];
                                    
                        echo "'".$mes2[$x]."'," ; 
                        
                     $x++;         
                     }

                     echo "'".$mes_extenso[date("m")]."',"

            ?>
            ],
            title: {
                text: null
            },
            labels: {
                overflow: 'justify',
                 style: {
                    fontSize: '18px' //Aumenta a fonte dos valores da escala Y no grafico
                 }
            }
            
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Exames(Qtd)',
                align: 'high'
            },
            labels: {
                overflow: 'justify',
                 style: {
                    fontSize: '14px' //Aumenta a fonte dos valores da escala X no grafico
                 }
            }
        },
        tooltip: {
            valueSuffix: ' Exames'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '15px' //Aumenta o tamanho da fonte do valor na barra
                    }
                    
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 300,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
            
            
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'total',
            data: [
<?php
           
            // VALOR DO GRAFICO  
            for ($y=1; $y <= $linha; $y++) {
                // RÓTULO "X"
                if($linha <> $y){    
                    echo "[".$qtd[$y] ."],";
                }else{
                    echo "[".$qtd[$y] ."],";
                }                     
        }

                echo "[".$constotal."],";

                    
?>    
            ]
        }]
    });
});
        </script>
    </head>
    <body style="zoom: 60%;">
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

</br>
</br>
<center><span style="font-size:24px"> Exames &nbsp;<?php echo $ano; ?></span></center>
<center>  
<table  class="table thead-light" style="font-size:20px">
  <tr>
  
  <?php

// Tabela título
  for ($y=1; $y <= $linha; $y++) {
  
  		if($y <> $linha){
				 		
						echo "<td>".$mes2[$y]."</td>" ; 

             $aa =  $mes2[$y];

				 }else{
				 		 echo "<td><font color='green'>".$mes2[$y]."</font></td>";	

						 $bb = $mes2[$y];

				 }
                     
  }     
// Alteração 		 
  		 echo "<td><font color='blue'>".$mes_extenso[date("m")]."</font></td>";	
// ***
  		 echo "<td>Total</td>" ;
		 $y=$y-1;

// =================
  ?>	
  </tr>
  <tr>
  <?php
  
 // Tabela quantidade
  for ($y=1; $y <= $linha; $y++) {
  
				if($y <> $linha){
				 		echo "<td>".$qtd[$y]."</td>"; 
            $a = $qtd[$y];

				 }else{
				 		 echo "<td><font color='green'>".$qtd[$y]."</font></td>";	
             $b = $qtd[$y]; 	
				 }
		  


	 	 $acumulado =  $qtd[$y];	
		 $t = $t + $acumulado; 
			     
        }

		echo "<td><font color='blue'>".$constotal."</font></td>";
		
		
    echo "<td>".$t."</td>" ;
    // =================
  ?>
  </tr>
  </table>
  
  <img src="../imagem/icone_grafico.png" width="61" height="74">  
  
  <?php 
  
  if($b > $a) {
  
  $sub = -($a-$b);
  echo "Houve um acréscimo de <font color='red' size='6'>&nbsp;".$sub."&nbsp;</font> nos Exames entre os meses de <font color='red' size='6'>&nbsp;".$aa; 
  
  echo "&nbsp;</font> a &nbsp; <font color='red' size='6'>".$bb."</font>";
 } 


  if($b < $a){
    $sub = -($a-$b);
  echo "Houve uma redução de <font color='red' size='6'>&nbsp;".$sub."&nbsp;</font> nos Exames  entre os meses de <font color='red' size='6'>&nbsp;".$aa; 
  $y=$y+1;
  echo "&nbsp;</font> a &nbsp; <font color='red' size='6'>".$bb."</font>";
  
  
  }


 if(($b == $a) &&  (!empty($b))){

  echo "O valor se manteve constante nos meses de &nbsp;<font color='red' size='6'>".$bb."</font>e <font color='red' size='6'>".$aa."</font>.";
 }

 If(empty($a)){

  echo "Não existe valarores. Favor verificar com o administrador do sistema.";
 }





  ?> 
  
</br>
</br>
</centro>

<div id="container" style="min-width: 310px; max-width: 1000px; height: 350px; margin: 0 auto"></div>
<br>

    </body>
</html>
