<?php

				require_once("conexion/conexion.php");

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
            text: 'Quantitativos de pessoas ativas',
			style: {
            	fontSize: '25px'
        	}
        },
        subtitle: {
            text: 'Ipaseal Saude'
        },
        xAxis: {
            categories: [
<?php

		/*
			  Contrato_contrato.ativo / Contrato_contrato.bloqueado
							V					V					=> 			ATIVO
							V					F					=> 			BLOQUEADO (continua pagando)
							F					V					=> 			CANCELADO
							F					F					=>			CANCELADO


		*/
        //TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ COM ODONTOL�GICO
        $sql1=pg_query($conexao,"SELECT count(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_contrato.plano_odontologico = 't' AND contrato_pessoa.ativo = 't'");
		//TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ SEM ODONTOL�GICO
		$sql2=pg_query($conexao,"SELECT count(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_contrato.plano_odontologico = 'f' AND contrato_pessoa.ativo = 't'");
	    //TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ MASCULINO
		$sql3=pg_query($conexao,"SELECT count(*) FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.sexo = 'M' AND contrato_pessoa.ativo = 't'");
        //TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ FEMININO
		$sql4=pg_query("SELECT count(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.sexo = 'F' AND contrato_pessoa.ativo = 't'");
        //TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ AGREGADO
		$sql5=pg_query("SELECT COUNT(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 't' AND contrato_pessoa.titular = 'f' AND contrato_pessoa.tipo = 'AGREGADO'");
        //TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ DEPENDENTES (AGREGADO, DEPENDENTE, CONJUGE)
		$sql6=pg_query("SELECT COUNT(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 't' AND contrato_pessoa.titular = 'f' AND contrato_pessoa.tipo <> 'AGREGADO'");
		//TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO (TOTAL)
		$sql7=pg_query("SELECT COUNT(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 't'");
		//TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO / PESSOA ATIVA (TITULARES)
		$sql8=pg_query("SELECT COUNT(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 't' AND contrato_pessoa.titular = 't' ");
		
		
     
        //Fechar conexao
		pg_close($conexao);
        
        
        
        //TESTE DE CONSULTA
        if (!$sql1) {
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ COM ODONTOL�GICO .<br>";
        exit;
        }elseif(!$sql2){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ SEM ODONTOL�GICO.<br>";
        exit;    
        }elseif(!$sql3){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ MASCULINO.<br>";
        exit;   
        }elseif(!$sql4){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ FEMININO.<br>";
        exit;   
        }elseif(!$sql5){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ COPARTICIPACAO / AGREGADO.<br>";
        exit;    
        }elseif(!$sql6){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ COPARTICIPACAO / DEPENDENTES (AGREGADO, DEPENDENTE, CONJUGE).<br>";    
		exit;    
        }elseif(!$sql7){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO.<br>";    
		exit;    
        }elseif(!$sql8){
        echo "Erro na consulta TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO / PESSOA TITULAR.<br>";    
		exit;    
        }
        
		
        while( $row = pg_fetch_array( $sql1 ) ) {
            $comodonto= $row [0] ;
        }
        while( $row = pg_fetch_array( $sql2 ) ) {
            $semodonto = $row [0] ;
        }
        while( $row = pg_fetch_array( $sql3 ) ) {
        $masculino = $row [0] ;
        }
        while( $row = pg_fetch_array( $sql4 ) ) {
        $feminino = $row [0] ;
        }
        while( $row = pg_fetch_array( $sql5 ) ) {
        $agregado = $row [0] ;
        }
        while( $row = pg_fetch_array( $sql6 ) ) {
        $dependentes = $row [0] ;
        }
		while( $row = pg_fetch_array( $sql7 ) ) {
        $pessoas_ativas = $row [0] ;
        }
		while( $row = pg_fetch_array( $sql8 ) ) {
        $pessoas_titular = $row [0] ;
        }
	    
       //$pessoas_ativas = $pessoas_ativas + $agregado;
			
        $ressult = array("Pessoas ativas"=>$pessoas_ativas, "Titular"=>$pessoas_titular,"Dependentes"=>$dependentes,"Agregados"=>$agregado, "Masculino"=>$masculino, "Feminino"=>$feminino,"Com odonto"=>$comodonto, "Sem odonto"=>$semodonto);

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
                text: 'Pessoas(Qtd)',
                align: 'high'
            },
            labels: {
                overflow: 'justify',
				style: {
				 	fontSize: '14px' //Aumenta a fonte dos valores da escala no grafico
				}
            }
        },
        tooltip: {
            valueSuffix: 'pessoas'
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
                                
            ?>
            			
			[<?php echo $valor ?>],
		
<?php
}
?>			
			]
        }]
    });
});
		</script>
	</head>
	<body style="zoom:66%;">
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 1000px; height: 350px; margin: 0 auto"></div>
<br>

	</body>
</html>
