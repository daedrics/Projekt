<?php
    session_start();
	include '../db_connect.php';
    $id_kontrata=$_SESSION['id_kontrata'];
	$query = "SELECT * FROM s_chat_messages WHERE `id_kontrata`='$id_kontrata' ORDER BY koha";
	$run = $link->query($query);
	while($row = $run->fetch_array()) : 
?> 
	<div id="chat_data"> 
		<span style="color:green;"><?php echo $row['user']; ?> : </span> 
		<span style="color:brown;"><?php echo $row['message']; ?></span> 
		<span style="float:right;"><?php echo $row['koha']; ?></span>
	</div> 
	
<?php 
	endwhile; 
?>

