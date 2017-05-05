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
$ok_muaj=0;
$pritje_muaj=0;
$ko_muaj=0;
while ($r=mysqli_fetch_assoc($total_query)){
    $status[$total]=$r['status'];
    if(strcasecmp($status[$total],'ok')==0)
    {
        $ok_muaj++;
    }
    else if (strcasecmp($status[$total],'ko')==0)
        $ko_muaj++;
    else $pritje_muaj++;

    $total++;
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

    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/local.css" />

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
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" >
            <ul id="active" class="nav navbar-nav side-nav">
                <li ><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="insert.php"><i class="fa fa-level-up"></i> Inserisci</a></li>
                <li><a href="arkiv.php"><i class="fa fa-archive"></i> Archivio</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">

                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $emer.' '.$mbiemer?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
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
                                <td>Totale <?php echo $total.'('.$total/$total*100 ?>%)</td>
                                <td>OK <?php echo $ok_muaj.'('.number_format($ok_muaj/$total*100,2)?>%)</td>
                                <td>Pritje <?php echo $pritje_muaj.'('.number_format($pritje_muaj/$total*100,2) ?>%)</td>
                                <td>KO <?php echo $ko_muaj.'('.number_format($ko_muaj/$total*100,2) ?>%)</td>

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
    echo "<script> location.href='#'; </script>";
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
    echo "<script> location.href='#'; </script>";
	
	
}



?>




</body>
</html>
