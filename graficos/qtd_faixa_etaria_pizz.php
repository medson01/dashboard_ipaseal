
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
            text: 'Usuários por Faixa Etária',
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
            require_once("../conexion/conexion.php");

$sql=pg_query($conexao,"SELECT 
                                
                                faixaetaria , count(id) as qtd
                                
                                FROM 
                                
                                (SELECT 
                                
                                CONTRATO_PESSOA.id, (case 
                                        when extract(year from age(data_nascimento)) between 0 and 18 then '0_a_18'
                                        when extract(year from age(data_nascimento)) between 19 and 25 then '19_a_25'
                                        when extract(year from age(data_nascimento)) between 26 and 30 then '26_a_30'
                                        when extract(year from age(data_nascimento)) between 31 and 35 then '31_a_35'
                                        when extract(year from age(data_nascimento)) between 36 and 40 then '36_a_40'
                                        when extract(year from age(data_nascimento)) between 41 and 45 then '41_a_45'
                                        when extract(year from age(data_nascimento)) between 46 and 50 then '46_a_50'
                                        when extract(year from age(data_nascimento)) between 51 and 55 then '51_a_55'
                                        when extract(year from age(data_nascimento)) between 56 and 60 then '56_a_60'
                                        when extract(year from age(data_nascimento)) between 61 and 65 then '61_a_65'
                                        when extract(year from age(data_nascimento)) between 66 and 70 then '66_a_70'
                                        when extract(year from age(data_nascimento)) between 71 and 75 then '71_a_75'
                                        when extract(year from age(data_nascimento)) between 76 and 80 then '76_a_80'
                                        when extract(year from age(data_nascimento)) between 81 and 85 then '81_a_85'
                                        when extract(year from age(data_nascimento)) between 86 and 90 then '86_a_90'
                                        when extract(year from age(data_nascimento)) between 91 and 95 then '91_a_95'
                                        when extract(year from age(data_nascimento)) between 96 and 100 then '96_a_100'
                                        when extract(year from age(data_nascimento)) > 100 then '>_100'
                                        
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

       

    while($registro = pg_fetch_assoc($sql)){
                        	

			
               echo  "['".$registro["faixaetaria"]." ', ".$registro["qtd"]."],";
			
			
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

<div id="container" style="min-width: 600px; height: 500px; max-width: 650px; margin: 0 auto;"></div>

<br><br>
<!--<center><a href="ejemplo2.php">Ver ejemplo 2</a></center> -->

	</body>
</html>
