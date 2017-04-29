<?php session_start();
if($_SESSION==NULL){
    echo '<script language="javascript">';
    echo 'alert("Duhet te beni log in ne fillim. \n")';
    echo '</script>';
    echo "<script> location.href='../Login/index.php'; </script>";
}
else{
    $pid = $_SESSION['pid'];
    include("getdata.php");
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


        <div id="page-wrapper">
            <h3 class="text-muted" style="padding-bottom: 20px">Raccolta Dati (aggiungi contratto)</h3>
            <form method="post" class="text-primary" >
                <div class="row">
                    <div class="form-group col-lg-1">
                        <label >Operatori</label>
                        <input style="background: #d3d3d3; color: #2e6da4" type="text" class="form-control" name="operatori" value="<?php echo $emer;?>" disabled>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Gestore Telefonico</label>
                        <input type="text" class="form-control" name="gestore">
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="operatori">Tipologia CNT</label>
                        <select  class="form-control" name="tipologia">
                            <option value="" disabled selected>Scegli Tipologia Contratto</option>
                            <option value="1">NIP</option>
                            <option value="2">ULL</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="operatori">APP/CNT</label>
                        <select  class="form-control" name="app">
                            <option value="" disabled selected>Scegli APP/CNT Contratto</option>
                            <option value="1">APP</option>
                            <option value="2">CNT</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Numero Fisso</label>
                        <input type="text" class="form-control" name="nr_fisso">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label>Comune</label>
                        <input type="text" class="form-control" name="comune">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Provincia</label>
                        <input type="text" class="form-control" name="provincia">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Cap</label>
                        <input type="text" class="form-control" name="cap">
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Via</label>
                        <input type="text" class="form-control" name="via">
                    </div>
                    <div class="form-group col-lg-1">
                        <label>Nr Civico</label>
                        <input type="text" class="form-control" name="nr_civico">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome">
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Cognome</label>
                        <input type="text" class="form-control" name="cognome">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Luogo di nascita</label>
                        <input type="text" class="form-control" name="luogo_nasc">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label>N. Documento</label>
                        <input type="text" class="form-control" name="n_doc">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Comune di Emessione</label>
                        <input type="text" class="form-control" name="comune_emes">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data di Rilascio</label>
                        <input type="text" class="form-control" name="data_rilasc">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data di Scadenza</label>
                        <input type="text" class="form-control" name="data_scad">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Codice Fiscale</label>
                        <input type="text" class="form-control" name="cod_fisc">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Codice di Migrazione</label>
                        <input type="text" class="form-control" name="cod_migr">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Recapito di Cell</label>
                        <input type="text" class="form-control" name="rec_cell">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Operatore Cell</label>
                        <input type="text" class="form-control" name="op_cell">
                    </div>
                    <div class="form-group col-lg-2">
                        <label >Offerta Scelta</label>
                        <select  class="form-control" name="offer_scelta">
                            <option value="" disabled selected>Scegli Offerta</option>
                            <option value="TUTTO VOCE">TUTTO VOCE</option>
                            <option value="ISL">ISL</option>
                            <option value="TSE">TSE</option>
                            <option value="TSM">TSM</option>
                            <option value="TSC">TSC</option>
                            <option value="TSF">TSF</option>
                            <option value="TSFC">TSFC</option>
                            <option value="TSFM">TSFM</option>
                            <option value="TSF 3x2">TSF 3x2</option>
                            <option value="RTG">RTG</option>
                            <option value="RTG TUTTO BUSINESS">RTG TUTTO BUSINESS</option>
                            <option value="ISDN TUTTO BUSINESS">ISDN TUTTO BUSINESS</option>
                            <option value="MOB UNLIMITED">MOB UNLIMITED</option>
                            <option value="MOB EUROPA">MOB EUROPA</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Cell Off TSM</label>
                        <input type="text" class="form-control" name="cel_off_tsm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label>ICCID (TSM)</label>
                        <input type="text" class="form-control" name="iccid">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Codice Op</label>
                        <input type="text" class="form-control" name="cod_op">
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data</label>
                        <input type="text" class="form-control" id="data" name="data" style="color: #2e6da4;background: #d3d3d3;" disabled>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Stato</label>
                        <input type="text" class="form-control" name="stato" value="Waiting" style="color: #2e6da4;background: #d3d3d3;" disabled>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Motivazione</label>
                        <input type="text" class="form-control" name="motivazione" value="in Lavorazione" style="color: #2e6da4;background: #d3d3d3;" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label>Note</label>
                        <textarea class="form-control" style="height: 100px" name="note" ></textarea>
                    </div>
                </div>
                <button type="submit" name="aggiungi" class="btn btn-primary">Aggiungi</button>


            </form>
        </div>


        
    </div>
	<script type="text/javascript">



        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        }
        if(mm<10){
            mm='0'+mm;
        }
        var today = mm+'/'+dd+'/'+yyyy;
        document.getElementById('data').value=today;
    </script>

<?php
$db_hostname = 'localhost';
$db_database = 'crm';
$db_username = 'root';
$db_password = '';

$link = mysqli_connect($db_hostname,$db_username , $db_password, $db_database);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}





if(isset($_POST['aggiungi'])){
   
        $info = array('','','','','','','','','','','');
        $info[1] = $_POST['data'];
        $info[2] = $_POST['nome'];
        $info[3] = $_POST['cognome'];
        $info[4] = $_POST['cod_fisc'];
        $info[5] = $_POST['nr_fisso'];
        $info[6] = $_POST['gestore'];
        $info[7] = $_POST['motivazione'];     
		$info[8] = $_POST['stato'];
	
	 
	

	 
        //shto ne databaze
       $query = mysql_query("INSERT INTO `kliente` VALUES (NULL, '$info[1]', '$info[2]', '$info[3]', '$info[4]','$info[5]','$info[6]','$info[7]','$info[8]','');", $link);
	
	
        echo '<script language="javascript">';
        echo 'alert("Klienti u regjistrua. \n")';
        echo '</script>';
		echo "<script> location.href='arkiv.php'; </script>";
    
}
?>
	
	
	
	
</body>
</html>