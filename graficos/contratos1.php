<?php

// grafico Contratos 01

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
            plotShadow: false,
			
        },
        title: {
            text: 'Percentual de contratos',
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

                        // tamnaho das letras da pizza
						fontSize: '15px',
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: [
			
			<?php
		//contrato ativo
        $sql1=pg_query($conexao,"SELECT count(*) as ativo FROM CONTRATO_CONTRATO WHERE ATIVO  = 't'");
		//contrato broqueado
		$sql2=pg_query($conexao,"SELECT count(*) as bloqueados FROM CONTRATO_CONTRATO WHERE ATIVO  = 't' AND BLOQUEADO = 't'");
		//contrato cacelado
		$sql3=pg_query($conexao,"SELECT count(*) as cancelado FROM CONTRATO_CONTRATO WHERE ATIVO  = 'f'");
		
		//Fechar conexao
		pg_close($conexao);
		
        //teste de consulta
        if (!$sql1) {
        echo "Erro na consulta.<br>";
        exit;
        }elseif(!$sql2){
        echo "Erro na consulta.<br>";
        exit;    
        }elseif(!$sql3){
        echo "Erro na consulta.<br>";
        exit;   
        }
		
while( $row = pg_fetch_array( $sql1 ) ) {
$ativo = $row [0] ;
}
while( $row = pg_fetch_array( $sql2 ) ) {
$bloqueado = $row [0] ;
}
while( $row = pg_fetch_array( $sql3 ) ) {
$cancelado = $row [0] ;
}
	
			
	$ressult = array("Ativo"=>$ativo, "Bloqueado"=>$bloqueado, "Cancelado"=>$cancelado);	
			
		foreach($ressult as $indice=> $valor){	
		
			?>	
			
                ['<?php echo $indice;?>', <?php echo $valor; ?>],
			
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

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto;"></div>

<br><br>
<!--<center><a href="ejemplo2.php">Ver ejemplo 2</a></center> -->

	</body>
</html>
