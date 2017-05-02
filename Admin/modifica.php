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
    $id_kontrata=$_GET['id'];
}
else{
    echo '<script language="javascript">';
    echo 'alert("Questa pagina non e disponibile \n")';
    echo '</script>';
    echo "<script> location.href='../Login/index.php'; </script>";
}
?>

<?php
include ("../db_connect.php");
$kontrata_data=mysqli_query($link,"SELECT * FROM `kliente` WHERE `id`='$id_kontrata'");

$row=mysqli_fetch_assoc($kontrata_data);
$info1 = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
$info1[1] =  $row["id"];
$info1[2] = $row["emer"];
$info1[3] = $row["mbiemer"];
$info1[4] = $row["data"];
$info1[5] = $row["status"];
$info1[6] = $row["gestore_tel"];
$info1[7] = $row["tipologia_cnt"];
$info1[8] = $row["app_cnt"];
$info1[9] = $row["numero_fisso"];
$info1[10] = $row["comune"];
$info1[11] = $row["provincia"];
$info1[12] = $row["frazione"];
$info1[13] = $row["cap"];
$info1[14] = $row["via"];
$info1[15] = $row["nr_civico"];
$info1[16] = $row["luogo_di_nascita"];
$info1[17] = $row["nr_documento"];
$info1[18] = $row["comune_emmissione"];
$info1[19] = $row["data_rilascio"];
$info1[20] = $row["data_scadenza"];
$info1[21] = $row["codice_fiscale"];
$info1[22] = $row["codice_migrazione"];
$info1[23] = $row["recapito_cell"];
$info1[24] = $row["operatore_cell"];
$info1[25] = $row["offerta_scelta"];
$info1[26] = $row["cell_off_tsm"];
$info1[27] = $row["iccid"];
$info1[28] = $row["codice_op"];
$info1[29]= $row["motivazione"];
$info1[30]=$row["note"];
$info1[31]=$row["#id_Operator"];
$emri_op=mysqli_query($link,"SELECT emer FROM `operator` WHERE id='$info1[31]'");
$rresht=mysqli_fetch_assoc($emri_op);
$emri_oper=$rresht["emer"];

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
                <li ><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
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
        <h3 class="text-muted" style="padding-bottom: 20px">Raccolta Dati (modifica contratto)</h3>
        <form method="post" class="text-primary" >
            <div class="row">
                <div class="form-group col-lg-1">
                    <label >Operatori</label>
                    <input style="background: #d3d3d3; color: #2e6da4" type="text" class="form-control" name="operatori" value="<?php echo $emri_oper;?>" disabled>
                </div>
                <div class="form-group col-lg-2">
                    <label>Gestore Telefonico</label>
                    <input type="text" class="form-control" name="gestore" >
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
                    <input type="text" class="form-control" name="nome" value="<?php echo $info1[2];?>" >
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
            <button type="submit" name="aggiungi" class="btn btn-primary">Modifica Contratto</button>


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
include ("../db_connect.php");





if(isset($_POST['aggiungi'])){

    $info = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
    $info[1] = $_POST['gestore'];
    $info[2] = $_POST['tipologia'];
    $info[3] = $_POST['app'];
    $info[4] = $_POST['nr_fisso'];
    $info[5] = $_POST['comune'];
    $info[6] = $_POST['provincia'];
    $info[7] = $_POST['frazione'];
    $info[8] = $_POST['cap'];
    $info[9] = $_POST['via'];
    $info[10] = $_POST['nr_civico'];
    $info[11] = $_POST['nome'];
    $info[12] = $_POST['cognome'];
    $info[13] = $_POST['luogo_nasc'];
    $info[14] = $_POST['n_doc'];
    $info[15] = $_POST['comune_emes'];
    $info[16] = $_POST['data_rilasc'];
    $info[17] = $_POST['data_scad'];
    $info[18] = $_POST['cod_fisc'];
    $info[19] = $_POST['cod_migr'];
    $info[20] = $_POST['rec_cell'];
    $info[21] = $_POST['op_cell'];
    $info[22] = $_POST['offer_scelta'];
    $info[23] = $_POST['cel_off_tsm'];
    $info[24] = $_POST['iccid'];
    $info[25] = $_POST['cod_op'];
    $info[26] = $_POST['stato'];
    $info[27] = $_POST['motivazione'];
    $info[28] = $_POST['note'];
    $today = date("Y-m-d ");


    //shto ne databaze
    $query = mysqli_query($link,"
INSERT INTO `kliente` (`id`, `data`, `emer`, `mbiemer`, `status`, `#id_Operator`, `gestore_tel`, `tipologia_cnt`, `app_cnt`, `numero_fisso`, `comune`, `provincia`, `cap`,
 `via`, `nr_civico`, `luogo_di_nascita`, `nr_documento`, `comune_emmissione`, `data_rilascio`, `data_scadenza`, `codice_fiscale`, `codice_migrazione`, 
 `recapito_cell`, `operatore_cell`, `offerta_scelta`, `cell_off_tsm`, `iccid`, `codice_op`, `motivazione`, `note`, `id_admin`, `frazione`)
  VALUES (NULL, '$today', '$info[11]', '$info[12]', '$info[26]', '', '$info[1]', '$info[2]', '$info[3]', '$info[4]', '$info[5]', '$info[6]', '$info[8]', 
  '$info[9]', '$info[10]', '$info[13]', '$info[14]', '$info[15]', '$info[16]', '$info[17]', '$info[18]', '$info[19]', '$info[20]', '$info[21]', '$info[22]', '$info[23]', 
  '$info[24]', '$info[25]', '$info[27]', '$info[28]', '$pid', '$info[7]');");


    echo '<script language="javascript">';
    echo 'alert("Il contratto e stato aggiunto \n")';
    echo '</script>';
    echo "<script> location.href='arkiv.php'; </script>";

}
?>




</body>
</html>