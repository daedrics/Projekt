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
                   <li><div id="filterbox">
                        <form class="navbar-search">
                            <input type="text" placeholder="Cerca" class="form-control">
                        </form></div>
                    </li>
                </ul>
            </div>
        </nav>
		<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
				<div class="panel-body">

					<table class="table">
					<tbody>
					<tr>
					<td>Totale <?php echo $i.'('.$i/$i*100 ?>%)</td>
					<td>OK <?php echo $ok.'('.number_format($ok/$i*100,2)?>%)</td>
					<td>Pritje <?php echo $pritje.'('.number_format($pritje/$i*100,2) ?>%)</td>
					<td>KO <?php echo $ko.'('.number_format($ko/$i*100,2) ?>%)</td>

					</tr>
					</tbody>
					</table>
	
				 </div>
                </div>

			</div >
			<div class="row" >
			<div class="form-group col-lg-2">
                        <label>Data inizio</label>
                        <input type="date" class="form-control" id="d_in">
                    </div>
					<div class="form-group col-lg-2">
                        <label>Data fine</label>
                        <input type="date" class="form-control" id="d_out">
                    </div>
					<div style="padding-top:25px" class="form-group col-lg-1 ">
                       
                        <input type="button" class="form-control btn btn-primary" value="cerca" id="d_button">
                    </div>
			<div class="col-lg-2">
					<form style="padding-top:25px"action ="excel.php" method="post" Content-Type= "application/xls" name="myform" >	
						<input type ="submit" name="export_excel" class="btn btn-success" value="Export to Excel" />
					</form>
				</div>
				
				<div class="col-lg-1"style="padding-top:25px"><label style="font-size:18px">Visualizza</label></div>
				<div style="padding-top:23px"class="col-lg-1 ">
					
                    <select  class="form-control" onchange="setPage();" id="elementi">
                        
                        <option value="10" selected>10</option>
                        <option value="5">5</option>

                    </select>
					
				</div>
				<div style="padding-top:25px"class="col-lg-1"><label style="font-size:18px">Elementi</label>
				</div>
				
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
    </div>

	
	<script  type="text/javascript">
    jQuery(function ($) {
        var traffic = [
            <?php

            for($i=0;$i<sizeof($id_k);$i++){
                echo '{ Id: '.$id_k[$i].', Data: "'.$data[$i].'", Emer: "'.$k_emer[$i].'", Mbiemer: "'.$k_mbiemer[$i].'",codicefiscale : "'.$codicefiscale[$i].'",telfisso:"'.$telfisso[$i].'",rcell:"'.$rcell[$i].'",
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
                rowHover: true,
                
					paging:7
				
            ,
                columns: [
                { field: "Id", width: "60px", title: "Id" },
                { field: "Data", title: "Data" },
                { field: "Emer", title: "Emer" },
                { field: "Mbiemer", title: "Mbiemer" },
				 { field: "codicefiscale", title: "CODICE FISCALE" },
				  { field: "telfisso", title: "TEL FISSO" },
			     { field: "rcell", title: "R.CELL" },
				 { field: "motivacione", title: "MOTIVACIONE" },
					 
                    { field: "Status", title: "Status" },
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
		
		    function setPage() {
        var x=document.getElementById('elementi').value;
        $("#shieldui-grid1").swidget().pager.pageSize(x); // Sets the page size to 4
        $("#shieldui-grid1").refresh();
    }
    </script>
	
	
	
	
</body>
</html>