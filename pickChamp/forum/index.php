<?php
include 'connect.php';
include 'header.php';
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('Location: ' . $url);
}


$sql = "SELECT * from categories";
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cat_id, $cat_name, $cat_desc);
    mysqli_stmt_store_result($stmt);
}

 

	

        //prepare the table and body content   	
        
        echo '<div class="col-sm-10 col-sm-offset-1 "><table class="table table-hover">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
             
        while(mysqli_stmt_fetch($stmt))
        {               
            echo '<tr>';
                echo '<td class="text-left">';
                	//Passing category id with fancy link magic
                    echo '<h3><a href="category.php?id=' . $cat_id .'"> ' . $cat_name . '</a></h3>' . $cat_desc;
                echo '</td>';
                echo '<td class="">';
                $row2 = lastTopic($cat_id);
	                if($row2 == null){
						echo 'No Topics!';
	                }else{
	                	echo '<a href="topic.php?id=' . $row2['topic_id'] .' "> ' . $row2['topic_subject'] . '</a> at ' . $row2['topic_date'];       	 
	                }
                echo '</td>';
            echo '</tr>';
        }
        
        echo '</table></div>';
        include 'footer.php';
        


//Returns the last topic created in a category
function lastTopic($catid){
	
	$sql = 'SELECT topics.topic_subject, topics.topic_date, topics.topic_id FROM topics RIGHT JOIN categories ON topics.topic_cat =' . $catid . ' LIMIT 1';
$link = mysqli_connect($host, $user, $password, $db) 
or die ("Database connection failed - " . mysqli_error($link));
	if(!$result = mysqli_query($link, $sql)){
		echo 'Error Retrieving Last Topic!';
	}
	

	if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		return $row;
	}else{
        return null;    
    }

		mysqli_close($link);
}