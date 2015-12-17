<?php
//create_cat.php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	
	echo '<div class="col-sm-4 col-sm-offset-4"> <form class="form-signin" method="post" action="">
			<label for="cat_name">Category Name</label>
			<input class="form-control" type="text" name="cat_name"/><br>
			<label for="cat_desc">Category Description:</label>
			<textarea class="form-control" name="cat_desc"></textarea><br>
			<div class="form-actions">
			<input class="btn" type="submit" value="Add Category!">
			</div>
			</form></div>';
}else{
    //the form has been posted, so save it
    $catname = mysqli_real_escape_string($link, $_POST['cat_name']);
    $catdesc = mysqli_real_escape_string($link, $_POST['cat_desc']);
    //Php to mysql needs some kind of connector, this syntax is booty
    $sql = 'INSERT INTO categories(cat_name, cat_description) VALUES("'. $catname . '" , "' . $catdesc . '" )';
    if( mysqli_query($link, $sql) )
    {
        echo 'New category successfully added.';
    }else{
    
    echo 'why';
    }


}



include 'footer.php';
?>