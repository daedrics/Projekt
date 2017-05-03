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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dark Admin</title>

    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/local.css" />

    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->

    <link id="gridcss" rel="stylesheet" type="text/css" href="../../bower_components/shieldui-lite/dist/css/dark-bootstrap/all.min.css" />

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
            <a class="navbar-brand" href="index.html">Admin Panel</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul id="active" class="nav navbar-nav side-nav">
                <li ><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
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
            </div>
            <div class="col-lg-6">
                <h2 style="color: black">Modifica Password</h2>
            </div>
        </div>

    </div>





</div>







</body>
</html>