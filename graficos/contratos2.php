<?php

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
            type: 'bar',
			style: {
            	fontSize: '10px' // Aummenta a fonto da legenda "Quandidade de pessoas" na barra
        	}
        },
        title: {
            text: 'Quantitativos de contratos',
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

        //contrato ativo
    if(!isset($_SESSION["ativo"])){
        $sql1=pg_query($conexao,"SELECT count(*) as ativo FROM CONTRATO_CONTRATO WHERE ATIVO  = 't'");
		//contrato broqueado
		$sql2=pg_query($conexao,"SELECT count(*) as bloqueados FROM CONTRATO_CONTRATO WHERE ATIVO  = 't' AND BLOQUEADO = 't'");
		//contrato cacelado
		$sql3=pg_query($conexao,"SELECT count(*) as cancelado FROM CONTRATO_CONTRATO WHERE ATIVO  = 'f'");
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
		
		//Fechar conexao
		pg_close($conexao);
		
        while( $row = pg_fetch_array( $sql1 ) ) {
             $_SESSION["ativo"]  = $row [0] ;
        }
        while( $row = pg_fetch_array( $sql2 ) ) {
            $_SESSION["bloqueado"] = $row [0] ;
        }
        while( $row = pg_fetch_array( $sql3 ) ) {
            $_SESSION["cancelado"] = $row [0] ;
        }
	}
       // $total = $ativo + $bloqueado;
			
       // $ressult = array("Total geral"=>$total,"Ativo"=>$ativo, "Bloqueado"=>$bloqueado, "Cancelado"=>$cancelado);
		
	   $ressult = array("Ativo"=>$_SESSION["ativo"], "Bloqueado"=>$_SESSION["bloqueado"], "Cancelado"=>$_SESSION["cancelado"]);

        foreach($ressult as $indice=> $valor){
			
?>
			
			['<?php echo $indice ?>'],
			
<?php
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
            data: [
			<?php
            
            // VALOR DO GRAFICO                       
            foreach($ressult as $indice=> $valor){	
                                
            echo "[".$valor ."],";

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
