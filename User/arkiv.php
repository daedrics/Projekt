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
                    <li class="selected"><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="portfolio.html"><i class="fa fa-level-up"></i> Inserisci</a></li>
                    <li><a href="blog.html"><i class="fa fa-archive"></i> Archivio</a></li>

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
					<td>Totale</td>
					<td>OK</td>
					<td>Pritje</td>
					<td>KO</td>

					</tr>
					</tbody>
					</table>
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

            <div class="row">
                <div class="col-lg-3">
                    <select  class="form-control" id="elementi">
                        <option value="" disabled selected>Scegli Pagina</option>
                        <option value="1">1</option>
                        <option value="2">2</option>

                    </select>
                    <input class="btn btn-primary" type="button" onclick="setPage();" value="kooot"/>
                </div>
            </div>
        </div>
    </div>



	<script type="text/javascript">
    jQuery(function ($) {
        var traffic = [
            <?php

            for($i=0;$i<sizeof($id_k);$i++){
                echo '{ Id: '.$id_k[$i].', Data: "'.$data[$i].'", Emer: "'.$k_emer[$i].'", Mbiemer: "'.$k_mbiemer[$i].'", Status: "'.$status[$i].'"}';
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
            pageSize: 1
            },
                columns: [
                { field: "Id", width: "170px", title: "Id" },
                { field: "Data", title: "Data" },
                { field: "Emer", title: "Emer" },
                { field: "Mbiemer", title: "Mbiemer" },
                    { field: "Status", title: "Status" },
                ]
            });




        });
    function setPage() {
        var x=document.getElementById('elementi').value;
        $("#shieldui-grid1").swidget().pager.pageSize(x); // Sets the page size to 4
        $("#shieldui-grid1").refresh();
    }
    </script>
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
        checkLoginStatus();</script>
</body>
</html>