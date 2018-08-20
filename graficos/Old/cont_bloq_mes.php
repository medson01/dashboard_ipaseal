<?php

    require_once("../conexion/conn_dw.php");
                
       date_default_timezone_set('America/Maceio');

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");  

      $mes_extenso = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Marco',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Novembro',
        '10' => 'Setembro',
        '11' => 'Outubro',
        '12' => 'Dezembro'
    );           
            
       $sql=pg_query($conexao,"select mes , count(*) as qtd from fato_contrato 
            inner join dim_tempo on dim_tempo.id_tempo = fk_id_tempo where ativo = 'f' and bloqueado ='f' and ano ='".$ano."' group by mes");
    
        //teste de consulta
        if (!$sql) {
        echo "Erro na consulta.<br>";  
        }
        
        //Fechar conexao
        pg_close($conexao);
        
        $linha = pg_num_rows($sql);          

        error_reporting(0);

        $x=1;

        while( $row = pg_fetch_array( $sql ) ) {
            $qtd[$x] = $row [qtd]; 
            $mes[$x] = $row [mes];

            $x++; 
        }

?>
<!DOCTYPE HTML>
<html>
    <head>
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
            text: 'Contratos x Mês ',
            style: {
                fontSize: '25px'
            }
        },
        //subtitle: {
        //    text: 'Ipaseal Saude'
        //},
        xAxis: {
            categories: [ [<?php 
                                        // RÓTULO DO GRAFICO  
                                        /*for ($y=1; $y <= $linha; $y++) {
                                            if($linha <> $y){    
                                                        echo "'".$mes[$y] ."',";
                                                   }else{
                                                        echo "'".$mes[$y] ."'";
                                                   }    
                                        } */
                                       foreach($mes as $indice=> $valor){   
                                
                                             echo "'".$valor ."',";
                                        }

                            ?>],
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
                text: 'Contratos(Qtd)',
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
            valueSuffix: ' contratos'
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
            data: [<?php
                                // VALOR DO GRAFICO  
                                for ($y=1; $y <= $linha; $y++) {
                                            // RÓTULO "X"
                                                   if($linha <> $y){    
                                                        echo "[".$qtd[$y] ."],";
                                                   }else{
                                                        echo "[".$qtd[$y] ."],";
                                                   }     
                                }             
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

<div id="container" style="min-width: 310px; max-width: 1000px; height: 350px; margin: 0 auto"></div>
<br>

    </body>
</html>
