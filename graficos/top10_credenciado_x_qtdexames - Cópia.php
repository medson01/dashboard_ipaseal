<?php

//BANCO DE DADOS
require_once("../conexion/conn_sqlsrv.php");
           
// DATA

       date_default_timezone_set('America/Maceio');

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y"); 


//RANK CREDENCIADOS: CONSULTA CREDENCIADOS, QTD PROCESSOS, PERÍODO, VALOR
        $sql="SELECT TOP 10 BAU_NOME AS CREDENCIADO, SUM (BE2_QTDPRO) AS PROCEDIMENTOS, CONVERT(DECIMAL(10,2),SUM (VALOR)) AS VALOR FROM 
(SELECT DISTINCT  BE2_CODPRO, BE2_DATPRO,BA1_CODINT,BA1_CODEMP,BA1_MATRIC,BA1_TIPREG,BAU_CODIGO,BAU_NOME, BE2_QTDPRO,
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


AND   BE2_CODPRO <> '10101012' --> CONSULTA MÉDICA
AND   BE2_CODPRO <> '10001000' --> CONSULTA ODONTOLOGIA

AND   BE2_CODPRO <> '10102019' --> VISITA HOSPITALAR (INTERNAMENTO - PACIENTE INTERNADO) 

-- AND   BE2_CODPRO <> '50000012' --> SESSÃO DE PSICOLOGIA
-- AND   BE2_CODPRO <> '50000020' --> SESSÃO DE NUTRIÇÃO
-- AND   BE2_CODPRO <> '50000039' --> SESSÃO DE FONOAUDIOLOGIA 

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

 
AND   BE2_CODRDA <> '000871'   --> RDA GENERICO  
AND   BA3_CODPLA = '0005'      --> COPARTICIPAÇÃO
AND   BE2_STATUS = '1'         
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*' 

) AS TABELA
GROUP BY BAU_NOME
ORDER BY PROCEDIMENTOS DESC";
        
// executar consultas 
         $consultas = odbc_exec ($con, $sql);      

//teste de consulta
        if (!$sql) {
        echo "Erro na consulta banco TOTVs.<br>";  
        }
        $x=1;
        while ($rows = odbc_fetch_object($consultas)) { 
        
            $credenciado[$x] = $rows -> CREDENCIADO;
            $qtd_proc[$x] = $rows -> PROCEDIMENTOS;
            $valor[$x] = $rows -> VALOR;
            $x++;

         }
                
//Fechar conexao
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
                fontSize: '10px' // Aummenta a fonto da legenda "Quandidade de pessoas" na barra (pessoas/QTD)
            }
        },
        title: {
            text: 'Top 10: Credenciados X Exames',
            style: {
                fontSize: '25px' // Aummenta a fonto do Título do Grafica
            }
        },
        subtitle: {
            text: '<?php echo "01".$mes.$ano." a ".$dia.$mes.$ano; ?>',
            style: {
            fontSize: '15px' // Aummenta a fonto do Título do Grafica
            }
        },
        xAxis: {
            categories: [ 

            <?php

                    $x = $x - 1;

                    $n=1;
                    while( $n <= $x ) {
                        
                        echo "'".$credenciado[$n]."'," ; 
                        
                     $n++;         
                     }

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
                   
                    for ($y=1; $y <= $x; $y++) {
                        
                         echo "[".$qtd_proc[$y] ."],"; 
                        
                            
                     }
                    
?>    
            ]
        }]
    });
});
        </script>
    </head>
    <body style="zoom: 50%;">
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; max-width: 1000px; height: 760px; margin: 0 auto"></div>
<br>

    </body>
</html>
