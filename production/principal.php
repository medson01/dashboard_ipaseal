


<?php


 // no início do arquivo
	session_start();
	


// banco de dados
        include("../conexion/conexion.php");
        include("../conexion/conn_sqlsrv.php");


// data atual

    date_default_timezone_set('America/Maceio');

    $dia = date("d");
    $mes = date("m");
    $mess = date('M');
    $ano = date("Y");  

      $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );

// total de pessoas 
// contrato_ativo_pessoas_ativa
    $sql1=pg_query("SELECT COUNT(*)FROM CONTRATO_PESSOA INNER JOIN contrato_contrato ON contrato_contrato.id = contrato_pessoa.CONTRATO_ID WHERE contrato_contrato.ativo  = 't' AND contrato_pessoa.ativo = 't'");     
// total de contratos
    $sql2=pg_query("SELECT count(*) as ativo FROM CONTRATO_CONTRATO WHERE ATIVO  = 't'");  
// total de procedimentos
    $sql_procedimento="SELECT TABELA.BE2_CODPRO AS PROCEDIMENTO, COUNT(*) AS TOTAL FROM 
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

AND  
(
      BE2_CODPRO = '10101012' --> CONSULTA MÉDICA 
OR    BE2_CODPRO = '10001000' --> CONSULTA ODONTOLOGIA
OR    BE2_CODPRO = '10102019' --> INTERNAMENTO
)


AND   BE2_CODPRO NOT LIKE '4%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '3%' --> PELE E TECIDO CELULAR SUBCUTÂNEO / CABECA E PESCOSO / MAMAS / SISTEMA MÚSCULO-ESQUELÉTICO E ARTICULAÇÕES
AND   BE2_CODPRO NOT LIKE '5%' --> TABELA DE COFFITO (FISIOTERAPIA)
AND   BE2_CODPRO NOT LIKE '6%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '7%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '8%' --> NÃO TABELA CHPM
AND   BE2_CODPRO NOT LIKE '9%' --> NÃO TABELA CHPM
 
  
AND   BE2_STATUS = '1'       
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*'

) 
AS TABELA
GROUP BY TABELA.BE2_CODPRO;";




// total de exames
$sql_exames = "SELECT COUNT (*) AS EXAMES  FROM 
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
AND   BE2_CODPRO <> '50000004' --> OFTALMOLOGIA 

 
  
AND   BE2_STATUS = '1'       
AND   BE2010.D_E_L_E_T_ <> '*' 
AND   BA1010.D_E_L_E_T_ <> '*' 
AND   BA3010.D_E_L_E_T_ <> '*' 
AND   BAU010.D_E_L_E_T_ <> '*' 
AND   BAQ010.D_E_L_E_T_ <> '*') AS VAL;";



// executar consultas 
 $exames = odbc_exec ($con, $sql_exames);
 $procedimento = odbc_exec ($con, $sql_procedimento);

  
// teste de consulta
    if (!$sql1) {
        echo "Erro na consulta TOTAL DE VIDAS .<br>";
        exit; 
    }
    // teste de consulta
    if (!$sql2) {
        echo "Erro na consulta TOTAL CONTRATOS .<br>";
        exit; 
    }
     while( $row = pg_fetch_array( $sql1 ) ) {
         $t_vidas= $row [0] ;
    }

     while( $row = pg_fetch_array( $sql2 ) ) {
        $t_contratos= $row [0] ;
     }

    while ($rows = odbc_fetch_object($exames)) { 
    
        $exame = $rows->EXAMES;
     }
    while ($rows = odbc_fetch_object($procedimento)) { 
    
      if(10101012 == $rows->PROCEDIMENTO){
        $t_consultas_medica = $rows->TOTAL;
      }
      if(10001000 == $rows->PROCEDIMENTO){
        $t_consultas_odont = $rows->TOTAL;
      }
      if(10102019 == $rows->PROCEDIMENTO){
        $t_internamento = $rows->TOTAL;
      }

     }




  pg_close($conexao);
  odbc_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../../dashboard_ipaseal/production/images/favicon.ico" type="image/ico" />

    <title>Dasboard Ipaseal Saúde | </title>

    <!-- Bootstrap -->
    <link href="../../dashboard_ipaseal/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../dashboard_ipaseal/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../dashboard_ipaseal/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../dashboard_ipaseal/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../../dashboard_ipaseal/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../dashboard_ipaseal/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../dashboard_ipaseal/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../dashboard_ipaseal/build/css/custom.min.css" rel="stylesheet">
	
	<script>
	function aguardar() {
				alert('Aguarde um minuto at\u00e9 a p\u00e1gina ser carregada.');
				window.location.href='../production/principal.php';
	}
	</script>
	
	
  </head>

  <body class="nav-md" >
  
  
   
  
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#level1_1" class="site_title" onClick="aguardar()"><img src="../../dashboard_ipaseal/imagem/logo.png" width="29" height="27">&nbsp;IPASEAL SAÚDE</span></a></br>
			   </br>
            </div>
            

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
				<div class="profile_pic">
					<img src="../../dashboard_ipaseal/imagem/avatar.png" width="20" height="27" class="img-circle profile_img">	            </div>
				  <div class="profile_info">
					<span>Bem vindo,</span>
					<h2><?php error_reporting(0); echo $_SESSION["login"]; ?></h2>
				  </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

<!-- MENU -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a  href="../../dashboard_ipaseal/production/principal.php"><i class="fa fa-bar-chart-o"></i> Geral </a>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Gráficos Específico <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../dashboard_ipaseal/production/chartjs.html">Financeiros</a></li>
                      <li><a href="../../dashboard_ipaseal/production/grafico_saude.php">Gestão Saúde</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tabela do Plano <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../dashboard_ipaseal/tabelasdoplano/coparticipacao.php">Tabela Co-participação</a></li>
                      <li><a href="../../dashboard_ipaseal/tabelasdoplano/novoplano.php">Tabela Novo Plano</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Histórico</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-sitemap"></i> Dw Ipaseal <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="../../dashboard_ipaseal/production/Dw_geral.php">Geral</a>
                        <li><a href="#level1_1">Financeiros</a>
                        <li><a href="#level1_2">Gestão Saúde</a>
                        </li>
                    </ul>
                  </li>                  
                 <!-- <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page </a></li> -->
                </ul>
              </div>

            </div>
<!-- /FIM MENU -->

				<center> <i class="fa fa-laptop"></i> - TI - Ipaseal Saúde </center>
				
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../../dashboard_ipaseal/logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../../dashboard_ipaseal/production/images/img.jpg" alt="">Perfil
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                   
				   <li><a href="javascript:;"> Profile </a></li>
                  <?php  
                  if("administrador"==$_SESSION["perfil"]){
                      echo "<li><a href='./files/principal_mudar_senha.php'>Cadastro usuários</a></li>";}
                  ?> 
                    <li><a href="javascript:;">Help</a></li>
					
                    <li><a href="../../dashboard_ipaseal/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <!-- <span class="badge bg-green">6</span> -->
                  </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="../../dashboard_ipaseal/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="../../dashboard_ipaseal/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="../../dashboard_ipaseal/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="../../dashboard_ipaseal/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul> 
                </li>
              </ul>  
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o">
                
              </i> Total de Contratos</span>
              <div class="count blue">

              <?php 
                  echo (number_format ($t_contratos  , 0 , ' , ' ,  '.'));
              ?>


            </div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>Ativos</i> </span> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user">
                
              </i> Total de Vidas </span>
              <div class="count blue">
              <?php 
              // resultado 
                  echo (number_format ($t_vidas  , 0 , ' , ' ,  '.'));

              ?>
              </div>
             <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>Ativas</i> </span> 
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user">
                
             </i> Consultas Médicas</span>
              <div class="count">

              <?php 
              // resultado 
                  error_reporting(0);
                  echo (number_format ($t_consultas_medica  , 0 , ' , ' ,  '.'));

              ?>

              </div>
                             <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>
                <?php 
                     error_reporting(0);
                    echo $mes_extenso["$mess"]."&nbsp;".de ."&nbsp;".$ano;    
                ?>
              </i> </span> 
              
            </div>
       
            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user">
                
              </i> Consultas Odontológicas </span>
              <div class="count">

              <?php 
              // resultado 
                  echo (number_format ($t_consultas_odont  , 0 , ' , ' ,  '.'));
                  

              ?>

              </div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>
                <?php 
                    echo $mes_extenso["$mess"]."&nbsp;".de ."&nbsp;".$ano;    
                ?>
              </i> </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user">
                
              </i> Exames </span>
              <div class="count green">
              <?php 
              // resultado 
                  echo (number_format ($exame  , 0 , ' , ' ,  '.'));
                  

              ?>

              </div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>
                <?php 
                    echo $mes_extenso["$mess"]."&nbsp;".de ."&nbsp;".$ano;    
                ?>
              </i> </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user">

              </i> Internamento</span>
              <div class="count green">
              <?php 
              // resultado 
                  echo (number_format ($t_internamento  , 0 , ' , ' ,  '.'));
                  

              ?>
                
              </div>
             <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>
                <?php 
                    echo $mes_extenso["$mess"]."&nbsp;".de ."&nbsp;".$ano;    
                ?>
              </i> </span>
            </div>
          </div>
          <!-- /top tiles -->

              <div class="row">


                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320 overflow_hidden">

                      <div class="x_content">
                           <iframe src="../graficos/contratos1.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe> 

                      </div>
                    </div>
                  </div>


                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320">

                      <div class="x_content">
                        <div class="dashboard-widget-content">
                          
                             <iframe src="../graficos/pessoas1.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                        
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="row">

                
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320 overflow_hidden">

                      <div class="x_content">
                          <iframe src="../graficos/contratos2.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                      </div>
                    </div>
              </div>


                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320">

                      <div class="x_content">
                        <div class="dashboard-widget-content">
                          
                             <iframe src="../graficos/pessoas2.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                        
                        </div>
                      </div>
                    </div>
                  </div>
              </div>



						 <div class="row">


              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel tile fixed_height_320 overflow_hidden">

                   <div class="x_content">
						              <iframe src="../graficos/qtd_usuarios_plano.php" height="280" width="100%" scrolling="no" style="border:none;"></iframe>
                  </div>
                </div>
              </div>
            </div>
						
    </p>
    
            

          </div>


          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            TI - Ipaseal Saúde 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../../dashboard_ipaseal/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../dashboard_ipaseal/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../dashboard_ipaseal/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../dashboard_ipaseal/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../dashboard_ipaseal/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../../dashboard_ipaseal/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../dashboard_ipaseal/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../../dashboard_ipaseal/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../../dashboard_ipaseal/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../../dashboard_ipaseal/vendors/Flot/jquery.flot.js"></script>
    <script src="../../dashboard_ipaseal/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../dashboard_ipaseal/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../dashboard_ipaseal/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../dashboard_ipaseal/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../dashboard_ipaseal/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../dashboard_ipaseal/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../dashboard_ipaseal/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../dashboard_ipaseal/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../../dashboard_ipaseal/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../../dashboard_ipaseal/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../../dashboard_ipaseal/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../dashboard_ipaseal/vendors/moment/min/moment.min.js"></script>
    <script src="../../dashboard_ipaseal/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../dashboard_ipaseal/build/js/custom.min.js"></script>
	
  </body>
</html>
