<?php session_start();
if($_SESSION==NULL){
    echo '<script language="javascript">';
    echo 'alert("Duhet te beni log in ne fillim. \n")';
    echo '</script>';
    echo "<script> location.href='../Login/index.php'; </script>";
}
if($_SESSION['logged']=='admin'){
    $pid = $_SESSION['pid'];
    include("getdata.php");
    include ("../db_connect.php");
}
else{
    echo '<script language="javascript">';
    echo 'alert("Questa pagina non e disponibile \n")';
    echo '</script>';
    echo "<script> location.href='../Login/index.php'; </script>";
}
?>

<?php
$data=getdate();
$year=$data['year'];
$month=$data['mon'];

$data_f=$year.'-'.$month.'-01';
$data_mb=$year.'-'.$month.'-31';

$total_query=mysqli_query($link,"SELECT * FROM kliente WHERE data >='$data_f' AND data <= '$data_mb';");
$total=0;
$wip_muaj=0;
$ok_muaj=0;
$pritje_muaj=0;
$ko_muaj=0;
$wipi_muaj=0; $toti_muaj=0;$koi_muaj=0;$oki_muaj=0;
while ($r=mysqli_fetch_assoc($total_query)){
    $status[$total]=$r['status'];
    if(strcasecmp($status[$total],'ok')==0)
    {
        $ok_muaj++;
    }
    else if (strcasecmp($status[$total],'ko')==0)
        $ko_muaj++;
	 else if (strcasecmp($status[$total],'wip')==0)
		 $wip_muaj++;
    else $pritje_muaj++;

    $total++;
}
if($tot==0)
{
	$wipi_muaj=0;
	$toti_muaj=0;
	$koi_muaj=0;
	$oki_muaj=0;
}
else{
	$toti_muaj=$total/$total*100;
	$oki_muaj=$ok_muaj/$total*100;
	$koi_muaj=$ko_muaj/$total*100;
	$wipi_muaj=$wip_muaj/$total*100;
	$pritjei_muaj=$pritje_muaj/$total*100;
}




?>

<?php
include("../db_connect.php");

$sql=mysqli_query($link,"SELECT * FROM `operator`");

$j=0;
$op=NULL;
while ($r=mysqli_fetch_assoc($sql)){
    $op[$j]=$r["username"];
    $j++;
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Albania</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/local1.css" />

    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->

    <link id="gridcss" rel="stylesheet" type="text/css" href="../../bower_components/shieldui-lite/dist/css/dark-bootstrap/all.min.css" />
   <script type="text/javascript" src="indexjs.js"></script>
    <script type="text/javascript" src="../..//bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../../bower_components/shieldui-lite/dist/js/shieldui-lite-all.min.js"></script>
</head>
<body style="background:white ">
<div id="wrapper" >
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">CRM</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" >
            <ul id="active" class="nav navbar-nav side-nav">
                <li ><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="insert.php"><i class="fa fa-level-up"></i> Inserisci</a></li>
                <li><a href="arkiv.php"><i class="fa fa-archive"></i> Archivio</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">

                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white"><i class="fa fa-user"></i> <?php echo $emer.' '.$mbiemer?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Home</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-gear"></i> Cambia password</a></li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>

                    </ul>
                </li>
                <li class="divider-vertical"></li>
                <li>
                    <form class="navbar-search">
                        <input type="text" placeholder="Search" class="form-control">
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambia Password</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="text-primary">
                       <div class="row">
                           <div class="col-lg-4 form-group">
                               <label>Vechia Password</label>
                               <input type="password" class="form-control" name="vechia_pass">
                           </div>
                       </div>


                       <div class="row">
                            <div class="col-lg-4 form-group">
                                <label>Nuovo Password</label>
                            <input type="password" class="form-control" name="nuovo_pass">
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label>Conferma Password</label>
                                <input type="password" class="form-control" name="conf_pass">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="cambia">Cambia</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                </div>
            </div>

        </div>
    </div>

    <?php
    include("../db_connect.php");
    if(isset($_POST['cambia'])){
        $vechia_pass=$_POST['vechia_pass'];
        $nuovo_pass=$_POST['nuovo_pass'];
        $conf_pass=$_POST['conf_pass'];
        $sql2=mysqli_query($link,"SELECT * FROM `admin` WHERE `password`='$vechia_pass' AND `id`='$pid'");
        $r1=mysqli_num_rows($sql2);
        if($r1!=0){
            if($nuovo_pass==$conf_pass){
                $sql3=mysqli_query($link,"UPDATE `admin` SET `password` = '$nuovo_pass' WHERE `admin`.`id` = '$pid'");
                echo '<script language="javascript">';
                echo 'alert("Il password e stato cambiato \n")';
                echo '</script>';
                echo "<script> location.href='home.php'; </script>";
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Il nuovo password non e confermato \n")';
                echo '</script>';
                echo "<script> location.href='home.php'; </script>";
            }
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Il vecchio password non e correto \n")';
            echo '</script>';
            echo "<script> location.href='home.php'; </script>";
        }
    }

    ?>











    <div class="row"  >
        <div class="col-lg-12" >
            <img src="icon.png">
        </div>
    </div>
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-body">

                        <table class="table">
                            <tbody>
                            <tr>
							<td><button type="button" class="btn btn-primary">Totale <span class="badge"><?php echo $total.'('.$toti_muaj ?>%)</span></button></td>
					<td><button type="button" class="btn btn-success">OK <span class="badge"><?php echo $ok_muaj.'('.number_format($oki_muaj,2)?>%)</span></button></td>
					<td><button type="button" class="btn btn-warning">Recuperato <span class="badge"><?php echo $pritje_muaj.'('.number_format($pritjei_muaj,2) ?>%)</span></button></td>
					<td><button type="button" class="btn btn-danger">KO <span class="badge"><?php echo $ko_muaj.'('.number_format($koi_muaj,2) ?>%)</span></button></td>
                    <td><button type="button" class="btn btn-default">WIP <span class="badge"><?php echo $wip_muaj.'('.number_format($wipi_muaj,2) ?>%)</span></button></td> 
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div >
        </div>
        <div class="row">
			
            <div class="col-lg-6">
			
                <h2 style="color: black">Registra operatore</h2>
				<form method="post" class="text-primary">
				<div class="row">
					<div class="form-group col-lg-4">
						<label>Nome</label>
						<input type="text" class="form-control" name="emer"onfocusout="korniza(plotesuar('emer'), 'emer')" required >
					</div>
					<div class="form-group col-lg-4">
						<label>Cognome</label>
						<input type="text" class="form-control" name="mbiemer" onfocusout="korniza(plotesuar('mbiemer'), 'mbiemer')" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-4">
						<label>Username</label>
						<input type="text" class="form-control" name="username" onfocusout="korniza(plotesuar('username'), 'username')" required>
					</div>
					<div class="form-group col-lg-4">
						<label>Password</label>
						<input type="password" class="form-control" name="password" onfocusout="korniza(plotesuar('password'), 'password')" required>
					</div>
				</div>
				<button type="submit" name="registra" class="btn btn-primary">Registra</button>
					
				</form>
            
			</div>
            <div class="col-lg-6">
                <form method="post" class="text-primary">
                <h2 style="color: black">Modifica Password</h2>
                <div class="row">
                    <div class="col-lg-4 form-group">
                        <label>Operatore</label>
                        <input type="text" class="form-control" name="operatore" placeholder="Seleziona user" list="users" required>
                        <datalist id="users">
                            <?php
                            if($op!=NULL){
                            for($i=0;$i<sizeof($op);$i++){
                                echo '<option value="'.$op[$i].'">';
                            }}
                            else
                                echo 'koot';
                            ?>
                        </datalist>
                    </div>
                </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Metti nuovo password</label>
                            <input type="password" class="form-control" name="pass"  required>
                        </div>
                    </div>
                    <button type="submit" name="modifica" class="btn btn-primary">Modifica</button>
                </form>
            </div>
        </div>

    </div>





</div>
<?php
include("../db_connect.php");
if(isset($_POST['modifica'])){
    $passi=$_POST['pass'];
    $oper=$_POST['operatore'];
    $sql1=mysqli_query($link,"UPDATE `operator` SET `password` = '$passi' WHERE `operator`.`username` = '$oper'");

    echo '<script language="javascript">';
    echo 'alert("Il password e stato modificato. \n")';
    echo '</script>';
    echo "<script> location.href='home.php'; </script>";
}
?>

<?php 
include("../db_connect.php");

if(isset($_POST['registra'])){
	$op_name=$_POST['emer'];
	$op_surname=$_POST['mbiemer'];
	$op_user=$_POST['username'];
	$op_pass=$_POST['password'];
	
	$query=mysqli_query($link,"INSERT INTO `crm`.`operator` (`id`, `emer`, `mbiemer`, `username`, `password`) VALUES (NULL, '$op_name', '$op_surname', '$op_user', '$op_pass');");

    echo '<script language="javascript">';
    echo 'alert("L\'operatore e stato registrato. \n")';
    echo '</script>';
    echo "<script> location.href='home.php'; </script>";
	
	
}



?>




</body>
<script type="text/javascript">
    var _delay = 3000;
    function checkLoginStatus(){
        $.get("../checkStatus.php", function(data){
            if(!data) {
                window.alert("Duhet te besh log in")
                window.location = "../logout.php";
            }
            setTimeout(function(){  checkLoginStatus(); }, _delay);
        });
    }
    checkLoginStatus();
</script>
</html>
