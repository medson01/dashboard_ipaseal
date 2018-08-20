<?php
		
		// grafico quantidade de autorizações


			// BANCO DE DADOS
			
			include("../conexion/conn_sqlsrv.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Quantidade de Usuários por mês</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
			style: {
            	fontSize: '25'
        	},
            type: 'line'
		},
			
		legend: {
            itemStyle: {
				fontSize: '25px'
				}	
        },
        title: {
			style: {
            	fontSize: '35'
        			},
            text: 'Autorizações por mês' 

        },
        //subtitle: {
        //    text: 'Ipaseal Saúde'
        //}, -->
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			labels: {
				style: {
				 	fontSize: '30px'
				}
            }

        },
        yAxis: {
            title: {
                text: 'Quantidade autorizadas'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true,	
					style: {
            			fontSize: '20'
        			},
                },
                enableMouseTracking: false
            }
        },
        series: [{
<?php

	// CONSULTA SQL

		    $mes = date("m");
			$ano = date("Y");
           
                   
           for ($i = 1; $i <= intval($mes); $i++){
                
               if (strlen($i) == 1){
                $y = "0".$i;
    //Call Center
                $sql_satd[$i] = "SELECT COUNT(*)as satd  FROM BEA010 WHERE BEA_ANOAUT = '$ano' AND BEA_STATUS = '1' AND BEA_SENHA <> '' AND BEA_NOMRDA <> 'RDA GENERICA' AND BEA_MESAUT = '$y' AND D_E_L_E_T_ <> '*'"; 
    //Pre- Liberações
                $sql_lib[$i] = "SELECT count(*) as lib  FROM BEA010	WHERE  BEA_ANOAUT = '$ano' AND BEA_STATUS = '1' AND BEA_NOMRDA = 'RDA GENERICA' AND BEA_MESAUT = '$y' AND D_E_L_E_T_ <> '*'"; 
                 
               }else{ 
                $y = $i;
    // Pre- Liberações
				$sql_lib[$i] = "SELECT count(*) as lib  FROM BEA010	WHERE  BEA_ANOAUT = '$ano' AND BEA_STATUS = '1' AND BEA_NOMRDA = 'RDA GENERICA' AND BEA_MESAUT = '$y' AND D_E_L_E_T_ <> '*'";   
    // Call Center             
				$sql_satd[$i] = "SELECT COUNT(*)as satd  FROM BEA010 WHERE  BEA_ANOAUT = '$ano' AND BEA_STATUS = '1' AND BEA_SENHA <> '' AND BEA_NOMRDA <> 'RDA GENERICA' AND BEA_MESAUT = '$y' AND D_E_L_E_T_ <> '*'"; 
                
                }
              
            }
				
				$i = $i - 1;
				$a = 1;

	
        echo "name: 'Atendimento',";
        echo "data: ["; 
		
		// Preliberacao 
         while ($i >= $a){ 
				$liberacao = odbc_exec ($con, $sql_lib[$a]);  

                 while (odbc_fetch_row($liberacao)) {	 
				 		 echo odbc_result($liberacao,"lib");
				 if($a <> $i){ echo ",";};
				 }
		  $a = $a + 1;
		}
		// --------------
		  $b = 1;
		   
		echo "]";       
		echo "}, {";
		echo "name: 'Callcenter',";
        echo "data: [";
		// --------------
		
			
		// Liberação Callcenter 
         while ($i >= $b){ 
				$callcenter = odbc_exec ($con, $sql_satd[$b]);  

                 while (odbc_fetch_row($callcenter)) {	 
				 		 echo odbc_result($callcenter,"satd");
					if($b <> $i){ echo ",";};
				 }
		  $b = $b + 1;
		}
		// --------------
		 
		 echo "]";
		 
		odbc_close($con);

?>

		}]
		
    });
});
		</script>
	</head>
	<body style="zoom: 45%;">
<script src="Highcharts-4.1.5/js/highcharts2.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto;"></div>

	</body>
</html>
