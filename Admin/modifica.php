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
    <link rel="icon" href="icon.png">
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
            <a class="navbar-brand" href="index.html">CRM</a>
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
                        <li><a href="home.php"><i class="fa fa-user"></i> Home</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-gear"></i> Cambia Password</a></li>
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
                echo "<script> location.href='#'; </script>";
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Il nuovo password non e confermato \n")';
                echo '</script>';
                echo "<script> location.href='#'; </script>";
            }
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Il vecchio password non e correto \n")';
            echo '</script>';
            echo "<script> location.href='#'; </script>";
        }
    }

    ?>


    <div class="row"  >
        <div class="col-lg-12" >
            <img src="icon.png">
        </div>
    </div>

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
                    <input type="text" class="form-control" name="gestore" value="<?php echo $info1[6];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label for="operatori">Tipologia CNT</label>
                    <select  class="form-control" name="tipologia">
                        <option value="<?php echo $info1[7];?>" selected><?php echo $info1[7];?></option>
                        <option value="" disabled >Scegli Tipologia Contratto</option>
                        <option value="NIP">NIP</option>
                        <option value="ULL">ULL</option>
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <label for="operatori">APP/CNT</label>
                    <select  class="form-control" name="app">
                        <option value="<?php echo $info1[8];?>" selected><?php echo $info1[8];?></option>
                        <option value="" disabled >Scegli APP/CNT Contratto</option>
                        <option value="APP">APP</option>
                        <option value="CNT">CNT</option>
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <label>Numero Fisso</label>
                    <input type="text" class="form-control" value="<?php echo $info1[9];?>" name="nr_fisso">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-2">
                    <label>Comune</label>
                    <input type="text" class="form-control" name="comune" value="<?php echo $info1[10];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Provincia</label>
                    <input type="text" class="form-control" name="provincia" value="<?php echo $info1[11];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Frazione</label>
                    <input type="text" class="form-control" name="frazione" value="<?php echo $info1[12];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Cap</label>
                    <input type="text" class="form-control" name="cap" value="<?php echo $info1[13];?>">
                </div>
                <div class="form-group col-lg-3">
                    <label>Via</label>
                    <input type="text" class="form-control" name="via" value="<?php echo $info1[14];?>">
                </div>
                <div class="form-group col-lg-1">
                    <label>Nr Civico</label>
                    <input type="text" class="form-control" name="nr_civico" value="<?php echo $info1[15];?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $info1[2];?>" >
                </div>
                <div class="form-group col-lg-3">
                    <label>Cognome</label>
                    <input type="text" class="form-control" name="cognome" value="<?php echo $info1[3];?>">
                </div>
                <div class="form-group col-lg-4">
                    <label>Luogo di nascita</label>
                    <input type="text" class="form-control" name="luogo_nasc" value="<?php echo $info1[16];?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-2">
                    <label>N. Documento</label>
                    <input type="text" class="form-control" name="n_doc" value="<?php echo $info1[17];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Comune di Emessione</label>
                    <input type="text" class="form-control" name="comune_emes" value="<?php echo $info1[18];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Data di Rilascio</label>
                    <input type="date" class="form-control" name="data_rilasc" value="<?php echo $info1[19];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Data di Scadenza</label>
                    <input type="date" class="form-control" name="data_scad" value="<?php echo $info1[20];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Codice Fiscale</label>
                    <input type="text" class="form-control" name="cod_fisc" value="<?php echo $info1[21];?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label>Codice di Migrazione</label>
                    <input type="text" class="form-control" name="cod_migr" value="<?php echo $info1[22];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Recapito di Cell</label>
                    <input type="text" class="form-control" name="rec_cell" value="<?php echo $info1[23];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Operatore Cell</label>
                    <input type="text" class="form-control" name="op_cell" value="<?php echo $info1[24];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label >Offerta Scelta</label>
                    <select  class="form-control" name="offer_scelta">
                        <option value="<?php echo $info1[25];?>" selected><?php echo $info1[25];?></option>
                        <option value="" disabled >Scegli Offerta</option>
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
                    <input type="text" class="form-control" name="cel_off_tsm" value="<?php echo $info1[26];?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3">
                    <label>ICCID (TSM)</label>
                    <input type="text" class="form-control" name="iccid" value="<?php echo $info1[27];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Codice Op</label>
                    <input type="text" class="form-control" name="cod_op" value="<?php echo $info1[28];?>">
                </div>
                <div class="form-group col-lg-2">
                    <label>Data</label>
                    <input type="text" class="form-control" id="data" name="data" style="color: #2e6da4;background: #d3d3d3;" disabled>
                </div>
                <div class="form-group col-lg-2">
                    <label>Stato</label>
                    <input type="text" class="form-control" name="stato" value="<?php echo $info1[5];?>" style="color: #2e6da4;background: #d3d3d3;" >
                </div>
                <div class="form-group col-lg-2">
                    <label>Motivazione</label>
                    <input type="text" class="form-control" name="motivazione" value="<?php echo $info1[29];?>" style="color: #2e6da4;background: #d3d3d3;" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label>Note</label>
                    <textarea class="form-control" style="height: 100px" name="note"  ><?php echo $info1[30];?></textarea>
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
UPDATE `kliente` SET `emer` = '$info[11]', `mbiemer` = '$info[12]', `status` = '$info[26]', `gestore_tel` = '$info[1]', `tipologia_cnt` = '$info[2]', `app_cnt` = '$info[3]', 
`numero_fisso` = '$info[4]', `comune` = '$info[5]', `provincia` = '$info[6]', `cap` = '$info[8]', `via` = '$info[9]', `nr_civico` = '$info[10]', `luogo_di_nascita` = '$info[13]', 
`nr_documento` = '$info[14]', `comune_emmissione` = '$info[15]', `data_rilascio` = '$info[16]', `data_scadenza` = '$info[17]', `codice_fiscale` = '$info[18]', 
`codice_migrazione` = '$info[19]', `recapito_cell` = '$info[20]', `operatore_cell` = '$info[21]', `offerta_scelta` = '$info[22]', `cell_off_tsm` = '$info[23]', `iccid` = '$info[24]', 
`codice_op` = '$info[25]', `motivazione` = '$info[27]', `note` = '$info[28]', `frazione` = '$info[7]' WHERE `kliente`.`id` = '$id_kontrata'



");


    echo '<script language="javascript">';
    echo 'alert("Il contratto e stato modificato \n")';
    echo '</script>';
    echo "<script> location.href='arkiv.php'; </script>";

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