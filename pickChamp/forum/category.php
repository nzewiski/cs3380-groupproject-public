<?php
include 'connect.php';
include 'header.php';

if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('Location: ' . $url);
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
?>
<!-- Display table Headers -->
<table class="table table-striped table-hover table-bordered">
		<th>Topic</th><th>Created</th>
<?php 
if($result= mysqli_query($link, 'SELECT * FROM topics WHERE topic_cat=' . $id)){
		while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){			
			echo '<tr>';
			echo '<td><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a>';
			echo '</td>';
			echo '<td>';
			echo date('d-m-Y', strtotime($row['topic_date']));
			echo '</td></tr>';
		}
		

}else{
 echo 'Query Failed';
}
		echo '</table>';	


mysqli_close($link);


include 'footer.php';