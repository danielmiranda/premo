<?php 
/*
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
*/
        include("_serv/zconect.php");
/*xxxxxxxxxx64644646546546454xxxxx*/
$sordid='';  
$vsfilter='';      
$vcfilter='selected="selected"';      
if(isset($_GET['ordid']))
{
        $sordid=$_GET['ordid'];
        $vcfilter='';      
        $vsfilter='selected="selected"';      
}

$curdate = date('Y-m-d');
$vulogin='nologin';
$vurol='uadm';
$tabadm=$vurol;
$tabprod='udsg';
$tabdsg='udsg';
$tabmain='udsg';
$divprod='udsg';
$divadm='udsg';
if(isset($_SESSION['user_session'])!="")
{$vulogin='ulogin'; }
if(isset($_SESSION['rol_session'])) {
 if($_SESSION['rol_session'] !="" and $_SESSION['rol_session'] == "1")
   {
    $vurol='uadm';
    $tabadm='uadm';
    $tabprod='uadm';
    $tabmain='uadm';
    $divprod='udsg';
    $divadm='uadm';
    $tabdsg='udsg';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Premo</title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="css/bootstrap-datepicker/css/datepicker-custom.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker/css/datetimepicker-custom.css" rel="stylesheet">
    <link href="css/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="vendor/bootstrap-timepicker/css/timepicker.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="css/style.css?ver=1.1" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/dropzone.css" rel="stylesheet" type="text/css">
    <script src="dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style3.css">
    <style>
        a.rfqite {
           pointer-events: none;
           cursor: default;
        }    
    </style>
    <script type="text/javascript">
          var dcmaxrow = 0;
          var dcmaxrowu = 0;
          var lqcname = '';
          var billno = '';
          var oTable;
          var vcontainer='';
          var path = '_serv/';
          var j = [];
          var vview = '';
          var vcateg = '';
          var vicateg = '';
          var vsubcat = '';
          var visubcat = '';
          var vcondiva = '';
          var vloc = '';

          var viunidcpra = '';
          var vistkunid = '';

          var vrfqid=0;
          var vordid=0;
          var vordit=0;
          var vtav=0;
          var nTr;
    </script>
</head>
<body>
    <div id="wrapper">
      <header>
        <div class="overlay" style="display: none;"></div>
        <nav id="sidebar" class="<?php echo $tabadm;?>">
            <div id="dismiss">
                <i class="glyphicon glyphicon-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3> </h3>
            </div>
            <ul class="list-unstyled components">
              <li id="mainadm" class="<?php echo $tabmain;?>">
                <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle admsmen">Administracion</a>
                <ul class="collapse list-unstyled" id="adminSubmenu">
                    <li id="categ" onClick="showcateg()">Categorias</li>
                    <li id="artic" onClick="showartic()">Articulos</li>
                    <li id="proveed" onClick="showprov()">Proveedores</li>
                    <li id="condiva" onClick="showciva()">Cond.IVA</li>
                </ul>
              </li>
              <li id="inventario" onClick="showinventario()" class="<?php echo $tabmain;?>">Inventario</li>
            </ul>
        </nav>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-toggle <?php echo $vulogin;?>" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-header col-lg-10" align="center">
                    <h1 style="margin-left:50px;margin-top: 3px;margin-bottom: 0px;">Isologo</h1>
            </div>
            <!-- /.navbar-header -->
<?php if($vulogin=='nologin'){?>
            <ul  id="usrlog" class="nav navbar-nav navbar-right" style="margin-right:20px">
              <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-signup-modal">Login</a></li>
            </ul>
<?php } else {?>                    
            <ul id="usrlog" class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)" onclick="logout()"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
<?php }?>                    
            <!-- /.navbar-top-links -->
        </nav>
      </header>
      <section class="contsec wrapper">
        <div id="page-wrapper" class="<?php echo $vulogin;?>">
            <div class="row">
            </div>
            <!-- /.row container -->
            <div id="container" class="<?php echo $divadm;?>">
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
      </section>
    </div>
    <!-- /#wrapper -->


<div id="msjalert" class="modal fade" role="dialog" style="z-index: 1600;">
    <div class="modal-dialog2">
    <!-- Modal content-->
        <div class="modal-content2">
            <div class="modal-body" align="center">
                <div class="commentsBox">
                  <div class="form-group" align="center" id="msjcontent">
                </div>
            </div>
         </div>      
      </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal-i">
  <span id="closemodal" class="close-i">&times;</span>
  <img class="modal-content-i img-responsive" id="img01">
  <div id="caption-i"></div>
</div>
<!-- End The Modal -->

<!-- partstatus Modal Start -->
<div class="modal fade" id="invmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title pstitle" id="ModalLabel"><?php echo '';?></h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive psarea">
                    <?php echo ''; ?>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- PS Modal End -->  

    <!-- Bootstrap Modal -->
    <!--Login, Signup, Forgot Password Modal -->
    <div id="login-signup-modal" class="modal fade" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
    	<!-- login modal content -->
        <div class="modal-content" id="login-modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Login Now!</h4>
      </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input name="usremail" id="usremail" type="email" class="form-control input-lg" placeholder="Enter Email" required data-parsley-type="email" >
                </div>                      
            </div>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="password" id="login-password" type="password" class="form-control input-lg" placeholder="Enter Password" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup">
                </div>                      
            </div>
            
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button onclick="loginusr();" class="btn btn-primary btn-block btn-lg">LOGIN</button>
        </div>
        <div class="modal-footer">
          <p>
          <a id="FPModal" href="javascript:void(0)">.</a> | 
          <a id="signupModal" href="javascript:void(0)">.</a>
          </p>
        </div>
       </div>
        <!-- login modal content -->
        <!-- signup modal content -->
       <div class="modal-content" id="signup-modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Signup Now!</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <input name="namereg" id="namereg" type="name" class="form-control input-lg" placeholder="Enter Your Name" required data-parsley-type="name">
                </div>                     
            </div>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input name="emailreg" id="emailreg" type="email" class="form-control input-lg" placeholder="Enter Email" required data-parsley-type="email">
                </div>                     
            </div>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="passwdreg" id="passwdreg" type="password" class="form-control input-lg" placeholder="Enter Password" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup">
                </div>                      
            </div>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input name="password" id="confirm-passwd" type="password" class="form-control input-lg" placeholder="Retype Password" required data-parsley-equalto="#passwdreg" data-parsley-trigger="keyup">
                </div>                      
            </div>
              <button onclick="reguser()" class="btn btn-success btn-block btn-lg">CREATE ACCOUNT!</button>
        </div>
        <div class="modal-footer">
          <p>Already a Member ? <a id="loginModal" href="javascript:void(0)">Login Here!</a></p>
        </div>
      </div>
        <!-- signup modal content -->
        <!-- forgot password content -->
         <div class="modal-content" id="forgot-password-modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Recover Password!</h4>
      </div>
        <div class="modal-body">
          <form method="post" id="Forgot-Password-Form" role="form">
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input name="email" id="email" type="email" class="form-control input-lg" placeholder="Enter Email" required data-parsley-type="email">
                </div>                     
            </div>
            <button type="submit" class="btn btn-success btn-block btn-lg">
              <span class="glyphicon glyphicon-send"></span> SUBMIT
            </button>
          </form>
        </div>
        <div class="modal-footer">
          <p>Remember Password ? <a id="loginModal1" href="javascript:void(0)">Login Here!</a></p>
        </div>
      </div>        
        <!-- forgot password content -->
    	<!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
		</div>
        <!--Login, Signup, Forgot Password Modal -->
	<!-- Bootstrap Modal -->
    <!-- jQuery -->
    <script src="vendor/jquery/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <!--select2 plugins-->
    <link href="vendor/select2/select2.css" rel="stylesheet">
    <script src="vendor/select2/select2.js"></script>
    <!-- Bootstrap Datepicker JavaScript -->
    <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="vendor/bootstrap-daterangepicker/moment.js"></script>
    <script src="vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/premo.js?ver=1.5"></script>
    <script src="js/parsley.min.js"></script>
    <script  type="text/javascript" src="js/typeahead.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>

