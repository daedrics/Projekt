
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

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->

    <link id="gridcss" rel="stylesheet" type="text/css" href="../../bower_components/shieldui-lite/dist/css/light-mint/all.min.css" />

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
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    <li ><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="insert.php"><i class="fa fa-level-up"></i> Inserisci</a></li>
                    <li><a href="arkiv.php"><i class="fa fa-archive"></i> Archivio</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">

                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white"><i class="fa fa-user"></i> <?php echo $emer.' '.$mbiemer?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="home.php"><i class="fa fa-user"></i> Home</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-gear"></i> Cambia Password</a></li>
                            <li class="divider"></li>
                            <li><a href="../logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>

                        </ul>
                    </li>
                    <li class="divider-vertical"></li>
                   <li><div id="filterbox">
                        <form class="navbar-search">
                            <input type="text" placeholder="Cerca" class="form-control">
                        </form></div>
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
                    echo "<script> location.href='arkiv.php'; </script>";
                }
                else{
                    echo '<script language="javascript">';
                    echo 'alert("Il nuovo password non e confermato \n")';
                    echo '</script>';
                    echo "<script> location.href='arkiv.php'; </script>";
                }
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Il vecchio password non e correto \n")';
                echo '</script>';
                echo "<script> location.href='arkiv.php'; </script>";
            }
        }

        ?>
      <div class="row">
        <div class="col-lg-3" >
            <img src="icon.png">
        </div>
      </div>
        <script>
            $(document).ready(function(){
                $("#buton2").click(function(){
                    $("#shieldui-grid1").swidget().filter({ path: "Status", filter: "eq", value: "ok" });
                });

                $("#buton1").click(function(){
                    $("#shieldui-grid1").swidget().filter({ path: "Status", filter: "notnull", value: "" });
                });
                $("#buton3").click(function(){
                    $("#shieldui-grid1").swidget().filter({ path: "Status", filter: "eq", value: "recuperato" });
                });
                $("#buton4").click(function(){
                    $("#shieldui-grid1").swidget().filter({ path: "Status", filter: "eq", value: "ko" });
                });
                $("#buton5").click(function(){
                    $("#shieldui-grid1").swidget().filter({ path: "Status", filter: "eq", value: "wip" });
                });
            });
        </script>
      <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
				<div class="panel-body">

					<table class="table">
					<tbody>
					<tr>
					<td><button type="button" id="buton1" class="btn btn-primary">Totale <span class="badge"><?php echo $tot.'('.$toti ?>%)</span></button></td>
					<td><button type="button" id="buton2" class="btn btn-success">OK <span class="badge"><?php echo $ok.'('.number_format($oki,2)?>%)</span></button></td>
					<td><button type="button" id="buton3" class="btn btn-warning">Recuperato <span class="badge"><?php echo $pritje.'('.number_format($pritjei,2) ?>%)</span></button></td>
					<td><button type="button" id="buton4" class="btn btn-danger">KO <span class="badge"><?php echo $ko.'('.number_format($koi,2) ?>%)</span></button></td>
					<td><button type="button" id="buton5" class="btn btn-default">WIP <span class="badge"><?php echo $wip.'('.number_format($wipi,2) ?>%)</span></button></td>
					</tr>
					</tbody>
					</table>
	
				 </div>
                </div>

            </div>
        </div>

          <script>
              $(document).ready(function(){



                  $("#d_button").click(function(){
                      var data_fillim= document.getElementById("dataf").value;
                      var data_mbarim= document.getElementById("datamb").value;


                      if(data_fillim=='' && data_mbarim == '')
                          $("#shieldui-grid1").swidget().filter({ path: "Data", filter: "notnull", value: "" });

                      else if(data_mbarim== ''){
                          $("#shieldui-grid1").swidget().filter({ path: "Data", filter: ">=", value: new Date(data_fillim) });

                      }

                      else if(data_fillim==''){
                          $("#shieldui-grid1").swidget().filter({ path: "Data", filter: "<=", value: new Date(data_mbarim) });

                      }

                      else{
                          $("#shieldui-grid1").swidget().filter(

                              {
                                  and: [
                                      { path: "Data", filter: ">=", value: new Date(data_fillim) },
                                      {
                                          and: [

                                              { path: "Data", filter: "<=", value: new Date (data_mbarim) }
                                          ]
                                      }
                                  ]
                              }

                          );}
                  });
              });
          </script>

          <script>
              $(document).ready(function(){
                  $("#d_button1").click(function(){
                      var data_fillim= document.getElementById("dataf").value;
                      var data_mbarim= document.getElementById("datamb").value;
                      if(data_fillim!='' || data_mbarim!=''){
                          document.getElementById("dataf").value = '';
                          document.getElementById("datamb").value = '';
                          $("#shieldui-grid1").swidget().filter({ path: "Data", filter: "notnull", value: "" });
                      }
                  });




              });
          </script>
            <div class="row" >

                    <div class="form-group col-lg-2">
                        <label>Data inizio</label>
                        <input type="date" class="form-control" id="dataf" name="d_in" >
                    </div>
                    <div class="form-group col-lg-2">
                        <label>Data fine</label>
                        <input type="date" class="form-control" id="datamb" name="d_out">
                    </div>
                    <div style="padding-top:25px" class="form-group col-lg-1 ">
                        <input type="submit" class="form-control btn btn-primary" value="cerca" id="d_button" name="cerca">
                    </div>
                    <div style="padding-top:25px" class="form-group col-lg-1 ">
                        <input type="submit" class="form-control btn btn-success" value="reset" id="d_button1"  >
                    </div>
                    <button type="button" style="margin-top: 18px" class="btn btn-success" data-toggle="modal" data-target="#1Modal">Export to Excel</button>
                    <div style="padding-top:25px"  class="col-lg-1">
                        <label style="font-size:18px">Visualizza</label>
                    </div>
                    <div style="padding-top:18px" class="col-lg-1 ">
                        <select  class="form-control" onchange="setPage1();" id="elementi">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div  style="padding-top:25px"  class="col-lg-1">
                        <label style="font-size:18px">Elementi</label>
                    </div>
                </div>
			</div>



           
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">

                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                        </div>
                    </div>
                </div>

        </div>

        </div>


	
	<script  type="text/javascript">
    jQuery(function ($) {
        var traffic = [
            <?php
            for($i=0;$i<sizeof($id_k);$i++){
                echo '{ Id: '.$id_k[$i].', Data: new Date("'.$data[$i].'"), Emer: "'.$k_emer[$i].'", Mbiemer: "'.$k_mbiemer[$i].'",codicefiscale : "'.$codicefiscale[$i].'",telfisso:"'.$telfisso[$i].'",rcell:"'.$rcell[$i].'",
				motivacione :"'.$motivacione[$i].'", Status: "'.$status[$i].'"}';
                if($i!=sizeof($id_k)-1){
                    echo ',';
                }
            }
            ?>
                ];
			
				
				
         $("#shieldui-grid1").shieldGrid({
                dataSource: {
            data: traffic
                },
                sorting: {
            multiple: false
                },
                rowHover: false,
                
					paging:{pageSize:5},
				
             events: {
                dataBound: dataBoundFunction
            },
                columns: [
                { field: "Id", width: "60px", title: "Id" },
                { field: "Data", title: "Data" ,
                    format: function(value) {
                        var month=value.getMonth()+1;
                        if(month<10)
                            month="0"+month;
                        return value.getDate()+'-'+month+'-'+value.getFullYear();
                    }
                },
                { field: "Emer", title: "Nome" },
                { field: "Mbiemer", title: "Cognome" },
				 { field: "codicefiscale", title: "CODICE FISCALE" },
				  { field: "telfisso", title: "TEL FISSO" },
			     { field: "rcell", title: "R.CELL" },
				
					  {field:"motivacione",
                        width: "150px",
                        title: "Motivazione",
                        columnTemplate: function (cell, item) {
                            var transport = item["Id"];
                            var text= item["motivacione"];
                            $('<button data-toggle="modal" data-target="#2Modal" value="in Lavoracione" style=" height: 25px;" id="cell">Leggi Motivazione</button>')
                                .appendTo(cell).click(function(){
                                $("#text_leggi").text(text);
                            });
                                
                        }
                    },
                    { field: "Status", title: "STATO" },
                    {
                        width: "110px",
                        title: "Modifica",
                        columnTemplate: function (cell, item) {
                            var transport = item["Id"];
                            $('<button ><img src="edit.png" style="width: 40px; height: 25px;"/></button>')
                                .appendTo(cell)
                                .shieldButton({
                                    events: {
                                        click: function () {
                                            location.href='modifica.php?id='+transport+'';
                                        }
                                    }
                                });
                        }
                    }



                ]
            });
			
			
			
			        var dataSource = $("#shieldui-grid1").swidget().dataSource,
            input = $("#filterbox input"),
            timeout,
            value;
        input.on("keydown", function () {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                value = input.val();
                if (value) {
                    dataSource.filter = {
                        or: [
                            { path: "Id", filter: "contains", value: value },
                            { path: "Data", filter: "contains", value: value },
                            { path: "Emer", filter: "contains", value: value },
                            { path: "Mbiemer", filter: "contains", value: value },
							{ path: "codicefiscale", filter: "contains", value: value },
                            { path: "telfisso", filter: "contains", value: value },
                            { path: "rcell", filter: "contains", value: value },
							{ path: "motivacione", filter: "contains", value: value },
                            { path: "Status", filter: "contains", value: value }
                        ]
                    };
                }
                else {
                    dataSource.filter = null;
                }
                dataSource.read();
            }, 300);
        });



        });
		
		    function setPage1() {
        var x=document.getElementById('elementi').value;
        $("#shieldui-grid1").swidget().pager.pageSize(x);
        $("#shieldui-grid1").refresh();
		
             }
			 
    function dataBoundFunction(e) {
		
        var data = e.target.dataSource.view,
            rows = e.target.contentTable.find(">tbody>tr"),
            i;
        for (i = 0; i < data.length; i++) {
            var item = data[i];
            if (item.Status == 'ok'|| item.Status == 'OK' || item.Status == 'Ok') {
                $(rows[i].cells[8]).addClass("jeshile");
            }
            if (item.Status =='ko' || item.Status =='KO' || item.Status == 'Ko') {
                $(rows[i].cells[8]).addClass("kuqe");
            }
            if (item.Status =='wip' || item.Status =='WIP' || item.Status == 'Wip' ) {
                $(rows[i].cells[8]).addClass("bardhe");
            }
			if (item.Status =='recuperato' || item.Status =='RECUPERATO' || item.Status == 'Recuperato') {
                $(rows[i].cells[8]).addClass("verdhe");
            }
        }
    }
</script>
<style type="text/css">
    .jeshile {
		color:#ffffff;
       text-align: center;
	   font-size: 120%;
	   font-weight: 900;
	   background-color:#5cb85c;
    }
       .kuqe {
		color:#ffffff;
       text-align: center;
	   font-size: 120%;
	   font-weight: 900;
	   background-color:#d9534f;
    }   
	.bardhe {
		color:#000000;
       text-align: center;
	   font-size: 120%;
	   font-weight: 900;
	   background-color:#ffffff;
    }   
	.verdhe {
		color:#ffffff;
       text-align: center;
	   font-size: 120%;
	   font-weight: 900;
	   background-color:#f0ad4e;
    }
    
</style>
 <div class="modal fade" id="2Modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-body">
                   <p id="text_leggi"></p>
					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="1Modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Export to Excel</h4>
                </div>
                <div class="modal-body">
                    <form action="excel1.php" method="post" Content-Type= "application/xls" name="myformD" >
                        <div class="row">
                        <div class="form-group col-lg-4">

                            <label>Data inizio</label>
                            <input type="date" class="form-control" name="d_inX" >
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Data fine</label>
                                <input type="date" class="form-control" name="d_outX">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2"  >

                                <input type ="submit" name="export_excelD" class="btn btn-success" value="Export to Excel" />

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                </div>
            </div>

        </div>
    </div>
	
	
	
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
