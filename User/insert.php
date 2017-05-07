<?php session_start();
if($_SESSION==NULL){
    echo '<script language="javascript">';
    echo 'alert("Duhet te beni log in ne fillim. \n")';
    echo '</script>';
    echo "<script> location.href='../Login/index.php'; </script>";
}
if($_SESSION['logged']=='user'){
    $pid = $_SESSION['pid'];
    include("getdata.php");
}
else{
    echo '<script language="javascript">';
    echo 'alert("Questa pagina non e disponibile \n")';
    echo '</script>';
    echo "<script> location.href='../Login/index.php'; </script>";
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
   <script type="text/javascript" src="indexjs.js"></script>
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
                    <li><a href="insert.php"><i class="fa fa-level-up"></i> Inserisci</a></li>
                    <li><a href="draft.php"><i class="fa fa-bookmark-o"></i> Draft</a></li>
                    <li><a href="arkiv.php"><i class="fa fa-archive"></i> Archivio</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">

                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;"><i class="fa fa-user"></i> <?php echo $emer.' '.$mbiemer?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-user"></i> Cambia Password</a></li>
                          
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
            $sql2=mysqli_query($link,"SELECT * FROM `operator` WHERE `password`='$vechia_pass' AND `id`='$pid'");
            $r1=mysqli_num_rows($sql2);
            if($r1!=0){
                if($nuovo_pass==$conf_pass){
                    $sql3=mysqli_query($link,"UPDATE `operator` SET `password` = '$nuovo_pass' WHERE `operator`.`id` = '$pid'");
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
            <h3 class="text-muted" style="padding-bottom: 20px">Raccolta Dati (aggiungi contratto)</h3>
            <form method="post" class="text-primary" >
                <div class="row">
                    <div class="form-group col-lg-1">
                        <label >Operatori</label>
                        <input style="background: #d3d3d3; color: #2e6da4" type="text" class="form-control" name="operatori" value="<?php echo $emer;?>" disabled>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Gestore Telefonico</label>
                        <input type="text" class="form-control" name="gestore"onfocusout="korniza(plotesuar('gestore'), 'gestore')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="operatori">Tipologia CNT</label>
                        <select  class="form-control" name="tipologia"onfocusout="korniza(plotesuar('tipologia'), 'tipologia')" required>
                            <option value="" disabled selected>Scegli Tipologia Contratto</option>
                            <option value="NIP">NIP</option>
                            <option value="ULL">ULL</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="operatori">APP/CNT</label>
                        <select  class="form-control" name="app"onfocusout="korniza(plotesuar('app'), 'app')" required>
                            <option value="" disabled selected>Scegli APP/CNT Contratto</option>
                            <option value="APP">APP</option>
                            <option value="CNT">CNT</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Numero Fisso</label>
                        <input type="text" class="form-control" name="nr_fisso"onfocusout="korniza(plotesuar('nr_fisso'), 'nr_fisso')" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label>Comune</label>
                        <input type="text" class="form-control" name="comune"onfocusout="korniza(plotesuar('comune'), 'comune')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Provincia</label>
                        <input type="text" class="form-control" name="provincia"onfocusout="korniza(plotesuar('provincia'), 'provincia')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Frazione</label>
                        <input type="text" class="form-control" name="frazione"onfocusout="korniza(plotesuar('frazione'), 'frazione')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Cap</label>
                        <input type="text" class="form-control" name="cap"onfocusout="korniza(plotesuar('cap'), 'cap')" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Via</label>
                        <input type="text" class="form-control" name="via"onfocusout="korniza(plotesuar('via'), 'via')" required>
                    </div>
                    <div class="form-group col-lg-1">
                        <label>Nr Civico</label>
                        <input type="text" class="form-control" name="nr_civico"onfocusout="korniza(plotesuar('nr_civico'), 'nr_civico')" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome"onfocusout="korniza(plotesuar('nome'), 'nome')" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Cognome</label>
                        <input type="text" class="form-control" name="cognome"onfocusout="korniza(plotesuar('cognome'), 'cognome')" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Luogo di nascita</label>
                        <input type="text" class="form-control" name="luogo_nasc"onfocusout="korniza(plotesuar('luogo_nasc'), 'luogo_nasc')" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label>N. Documento</label>
                        <input type="text" class="form-control" name="n_doc"onfocusout="korniza(plotesuar('n_doc'), 'n_doc')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Comune di Emessione</label>
                        <input type="text" class="form-control" name="comune_emes"onfocusout="korniza(plotesuar('comune_emes'), 'comune_emes')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data di Rilascio</label>
                        <input type="date" class="form-control" name="data_rilasc"onfocusout="korniza(plotesuar('data_rilasc'), 'data_rilasc')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data di Scadenza</label>
                        <input type="date" class="form-control" name="data_scad"onfocusout="korniza(plotesuar('data_scad'), 'data_scad')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Codice Fiscale</label>
                        <input type="text" class="form-control" name="cod_fisc"onfocusout="korniza(plotesuar('cod_fisc'), 'cod_fisc')" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Codice di Migrazione</label>
                        <input type="text" class="form-control" name="cod_migr"onfocusout="korniza(plotesuar('cod_migr'), 'cod_migr')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Recapito di Cell</label>
                        <input type="text" class="form-control" name="rec_cell"onfocusout="korniza(plotesuar('rec_cell'), 'rec_cell')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Operatore Cell</label>
                        <input type="text" class="form-control" name="op_cell"onfocusout="korniza(plotesuar('op_cell'), 'op_cell')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label >Offerta Scelta</label>
                        <select  class="form-control" name="offer_scelta"onfocusout="korniza(plotesuar('offer_scelta'), 'offer_scelta')" required>
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
                        <input type="text" class="form-control" name="cel_off_tsm"onfocusout="korniza(plotesuar('cel_off_tsm'), 'cel_off_tsm')" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label>ICCID (TSM)</label>
                        <input type="text" class="form-control" name="iccid"onfocusout="korniza(plotesuar('iccid'), 'iccid')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Codice Op</label>
                        <input type="text" class="form-control" name="cod_op"onfocusout="korniza(plotesuar('cod_op'), 'cod_op')" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data</label>
                        <input type="text" class="form-control" name="data" id="data" style="color: #2e6da4;background: #d3d3d3;" disabled>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Stato</label>
                        <input type="text" class="form-control" name="stato" value="Waiting" style="color: #2e6da4;background: #d3d3d3;" readonly>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Motivazione</label>
                        <input type="text" class="form-control" name="motivazione" value="in Lavorazione" style="color: #2e6da4;background: #d3d3d3;" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label>Note</label>
                        <textarea class="form-control" style="height: 100px" name="note" ></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">
                         <button type="submit" name="aggiungi" class="btn btn-primary">Aggiungi</button>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" name="aggiungi_draft" class="btn btn-success">Salva Come Draft</button>
                    </div>
                </div>

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
        var today = yyyy+'-'+mm+'-'+dd;
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
  VALUES (NULL, '$today', '$info[11]', '$info[12]', '$info[26]', '$pid', '$info[1]', '$info[2]', '$info[3]', '$info[4]', '$info[5]', '$info[6]', '$info[8]', 
  '$info[9]', '$info[10]', '$info[13]', '$info[14]', '$info[15]', '$info[16]', '$info[17]', '$info[18]', '$info[19]', '$info[20]', '$info[21]', '$info[22]', '$info[23]', 
  '$info[24]', '$info[25]', '$info[27]', '$info[28]', '', '$info[7]');");
	
	
        echo '<script language="javascript">';
        echo 'alert("Il contratto e stato aggiunto \n")';
        echo '</script>';
		echo "<script> location.href='arkiv.php'; </script>";
    
}
?>
    <?php
    include ("../db_connect.php");





    if(isset($_POST['aggiungi_draft'])){

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
INSERT INTO `draft` (`id`, `data`, `emer`, `mbiemer`, `status`, `#id_Operator`, `gestore_tel`, `tipologia_cnt`, `app_cnt`, `numero_fisso`, `comune`, `provincia`, `cap`,
 `via`, `nr_civico`, `luogo_di_nascita`, `nr_documento`, `comune_emmissione`, `data_rilascio`, `data_scadenza`, `codice_fiscale`, `codice_migrazione`, 
 `recapito_cell`, `operatore_cell`, `offerta_scelta`, `cell_off_tsm`, `iccid`, `codice_op`, `motivazione`, `note`, `id_admin`, `frazione`)
  VALUES (NULL, '$today', '$info[11]', '$info[12]', '$info[26]', '$pid', '$info[1]', '$info[2]', '$info[3]', '$info[4]', '$info[5]', '$info[6]', '$info[8]', 
  '$info[9]', '$info[10]', '$info[13]', '$info[14]', '$info[15]', '$info[16]', '$info[17]', '$info[18]', '$info[19]', '$info[20]', '$info[21]', '$info[22]', '$info[23]', 
  '$info[24]', '$info[25]', '$info[27]', '$info[28]', '', '$info[7]');");


        echo '<script language="javascript">';
        echo 'alert("Il contratto e stato salvato come draft \n")';
        echo '</script>';
        echo "<script> location.href='draft.php'; </script>";

    }
    ?>
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

</body>
</html>