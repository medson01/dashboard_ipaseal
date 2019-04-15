


<?php


 // no início do arquivo
	session_start();
	

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

?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Dasboard Ipaseal Saúde | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	
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
              <a href="#level1_1" class="site_title" onClick="aguardar()"><img src="../imagem/logo.png" width="29" height="27">&nbsp;IPASEAL SAÚDE</span></a>
			    
              
            </div>
            

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
				<div class="profile_pic">
					<img src="../imagem/avatar.png" width="20" height="27" class="img-circle profile_img">	            </div>
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
                      <li><a href="../../dashboard_ipaseal/graficos/grafico_financeiro.php">Financeiros</a></li>
                      <li><a href="../../dashboard_ipaseal/graficos/grafico_saude.php">Gestão Saúde</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tabela do Plano <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
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
                 <!--  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page </a></li> -->
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout.php">
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
                    <img src="images/img.jpg" alt="">Perfil
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                   
				   <li><a href="javascript:;"> Profile </a></li>
                  <?php  
                  if("administrador"==$_SESSION["perfil"]){
                      echo "<li><a href='./files/principal_mudar_senha.php'>Cadastro usuários</a></li>";}
                  ?> 
                    <li><a href="javascript:;">Help</a></li>
					
                    <li><a href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
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
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
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
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
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
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
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

          <!-- /top tiles -->

           <!--   <div class="row">


                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320 overflow_hidden">

                      <div class="x_content">
                          <iframe src="../graficos/cont_bloq_mes.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320">

                      <div class="x_content">
                        <div class="dashboard-widget-content">
                          
                             <iframe src="../graficos/cont_ativo_mes.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                        
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
			  
		-->	  

              <div class="row">

                
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">

                      <div class="x_content">
                          <iframe src="../graficos/top10_credenciado_x_qtdexames.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                      </div>
                    </div>
              </div>


                   
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                      <div class="x_content">                       
                          
                             <iframe src="../graficos/top10_usuario_x_qtdexames.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>                                              
                      </div>
                     </div>
                  </div>
                  </div>
			  
			  
		      <!-- <div class="row">

                
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">

                      <div class="x_content">
                          <iframe src="../graficos/psicologia.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>
                      </div>
                    </div>
              </div>


                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">

                      <div class="x_content">                       
                          
                             <iframe src="../graficos/exames.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>                                              
                      </div>
                    </div>
                  </div>
              </div>

	

		<div class="row">


              <div class="col-md-12">
                <div class="x_panel tile fixed_height_320 overflow_hidden">

                   <div class="x_content">
						              <iframe src="../graficos/qtd_usuarios_plano.php" height="280" width="100%" scrolling="no" style="border:none;"></iframe>
                  </div>
                </div>
              </div>
            </div>
	
	-->
						
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
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
