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
			<div style="margin-left:17px ;padding-top :50px">
			
<form action ="excel.php" method="post" Content-Type= "application/xls"  >	

	<input type ="submit" name="export_excel" class="btn btn-success" value="Export to Excel" />
	
	<label for="operatori"> Visualissa
                        <select  id="opsion"class="form-control" name="tipologia" onchange="getSelectedValue();">
                            <option  value="5" >5</option>
                            <option selected value="8">8</option>
                            <option value="4">4</option>
                        </select> elementi </label>
	</form>
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
                paging: {
            pageSize: 8
            },
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
        });
    </script>
	
	
	
	
</body>
</html>