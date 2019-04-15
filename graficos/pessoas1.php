<?php

// grafico Pessoas 01
				require_once("../conexion/conexion.php");

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
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Percentual de vidas no plano',
			style: {
            	fontSize: '20'
        	}
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        // tamnaho das letras da pizza
						fontSize: '16px'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: [
			
			<?php
            
            
            
            
  if(!isset($_SESSION["ativo"])){             
   //contrato_ativo_pessoas_ativa
			$sql1=pg_query("SELECT count(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 't'");
   //contrato_ativo_pessoas_bloqueada
			$sql2=pg_query("SELECT count(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 'f'");
			
   //Fechar conexao
	    	pg_close($conexao);
   
   //TESTE DE CONSULTA
             if (!$sql1) {
                 echo "Erro na consulta.<br>";
             exit;
             }elseif(!$sql2){
                 echo "Erro na consulta.<br>";
                 exit;    
             }
   //PEGAR VALOR DA CONSULTAS        
            while( $row = pg_fetch_array( $sql1 ) ) {
                $_SESSION["ativo"] = $row [0] ;
            }
            while( $row = pg_fetch_array( $sql2 ) ) {
                $_SESSION["bloqueado"] = $row [0] ;
            }
    }       
            $ressult = array("Ativas"=>$_SESSION["ativo"], "Bloqueadas"=>$_SESSION["bloqueado"]);
                        
            foreach($ressult as $indice=> $valor){	
            
            
            
			?>
			
                ['<?php echo $indice; ?>', <?php echo $valor; ?>],
			
			<?php
			}
			?>	

            ]
        }]
    });
});


		</script>
	</head>
    <body style="zoom: 80%;">
<script src="Highcharts-4.1.5/js/highcharts2.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 500px; margin: 0 auto;"></div>


<br><br>
<!--<center><a href="ejemplo2.php">Ver ejemplo 2</a></center> -->

	</body>
</html>
