<?php 
	include '../db_connect.php';
	$query = "SELECT * FROM s_chat_messages ORDER BY id"; 
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

