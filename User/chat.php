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
    <link rel="stylesheet" type="text/css" href="../css/local.css" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" href="chatStyle.css" media="all" />

    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="indexjs.js"></script>
    <!-- you need to include the shieldui css and js assets in order for the charts to work -->

    <link id="gridcss" rel="stylesheet" type="text/css" href="../../bower_components/shieldui-lite/dist/css/dark-bootstrap/all.min.css" />

    <script type="text/javascript" src="../..//bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../../bower_components/shieldui-lite/dist/js/shieldui-lite-all.min.js"></script>
    <script>
        function chat_ajax(){
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat_box1').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat1.php', true);
            req.send();
        }
        setInterval(function(){chat_ajax()}, 1000) ;

    </script>
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
                    <li><a href="arkiv.php"><i class="fa fa-archive"></i> Archivio</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">

                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $emer.' '.$mbiemer?><b class="caret"></b></a>
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

            <div class="row">
            <div class="chat_window" id="chat_window">
                <div class="top_menu">
                    <div class="buttons">
                        <div class="button close">

                        </div>
                        <div class="button minimize">

                        </div>
                        <div class="button maximize">

                        </div>
                    </div>
                    <div class="title">Chat</div>
                </div>
                <ul class="messages" id="chat_box1">

                </ul>
                <div class="bottom_wrapper clearfix">
                    <div class="message_input_wrapper">
                        <form method="post" action="index.php">
                            <input class="message_input" placeholder="Type your message here..."  type="text" name="enter_message"/>
                    </div>
                    <div class="send_message"
                    <div class="icon">
                        <div class="text"><input type="submit"  name="submit" value="Send!" /> </div>
                    </div>
                </div>

                </form>
            </div>
            <?php

            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $msg = $_POST['enter_message'];
                $query = "INSERT INTO `s_chat_messages` (`id`, `user`, `message`, `koha`) VALUES (NULL, '$name', '$msg', CURRENT_TIMESTAMP)";
                $run = $link->query($query); }
            ?>

            </div>
        </div>



	
	

</body>
</html>