<?php

session_start();

    	// BANCO DE DADOS
			
	include("../conexion/conn_sqlsrv.php");
	include("../conexion/conn_dw.php");
	
                
       date_default_timezone_set('America/Maceio');

    $dia = date("d");
    $mes = date("m");
    $ano = $_SESSION["ano"]; 
	
	

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
							 	and  codigo = '10102019'");
								
	  


	 
    
        //teste de consulta
        if (!$sql01) {
        echo "Erro na consulta banco DW.<br>";  
        }


		if($_SESSION["notquery"] <> "0"){
			$constotal = $_SESSION["Internamento"];
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
// alteração
                     echo "'".$mes_extenso[date("m")]."',"
// ******
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
                text: 'Consultas(Qtd)',
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
            valueSuffix: ' consultas'
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
if($_SESSION["notquery"] <> "0"){
                echo "[".$constotal."],";

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

</br>
</br>
<center><span style="font-size:24px"> Internamentos &nbsp;<?php echo $ano; ?></span></center>
<center>  
<table  class="table thead-light" style="font-size:10px">
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
  		 
      if($_SESSION["notquery"] <> "0"){  
           echo "<td><font color='blue'>".$mes_extenso[date("m")]."</font></td>"; 
      }
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
		if($_SESSION["notquery"] <> "0"){
		    echo "<td><font color='blue'>".$constotal."</font></td>";
		}
		
    echo "<td>".$t."</td>" ;
    // =================
  ?>
  </tr>
  </table>
  
  <img src="../imagem/icone_grafico.png" width="61" height="74">  
  
  <?php 
  
  if($b > $a) {
  
  $sub = -($a-$b);
  echo "Houve um acréscimo de <font color='red' size='6'>&nbsp;".$sub."&nbsp;</font> nos INTERNAMENTOS entre os meses de <font color='red' size='6'>&nbsp;".$aa; 
  
  echo "&nbsp;</font> a &nbsp; <font color='red' size='6'>".$bb."</font>";
 } 


  if($b < $a){
    $sub = -($a-$b);
  echo "Houve uma redução de <font color='red' size='6'>&nbsp;".$sub."&nbsp;</font> nos INTERNAMENTOS  entre os meses de <font color='red' size='6'>&nbsp;".$aa; 
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
