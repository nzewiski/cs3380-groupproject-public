<!DOCTYPE html>
<html>
	<head>
	    <title>PickChamp Forum</title>
		<link rel="stylesheet" type="text/css" href="/forum/style.css">
		<link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="/css/all.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="/css/jquery.countdown.css" />
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	</head>
	<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="/">Pick Champ Forum</a>
	    </div>
	    <div>
	      <ul class="nav nav-pills">
	        <li><a href="index.php">Home</a></li>
	        <?php
	        session_start();
	        if($_SESSION['logged'] == 'yes'){
	        	//Admin is signed Show admin tools
	        	if($_SESSION['is_admin'] == 'T'){
	        		//Only allow admins to create categories
					echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">Admin Tools
						<span class="caret"></span></a>';
		        	//Begin drop down <ul>
		        	echo '<ul class="dropdown-menu">';
		        		echo '<li><a href="create_cat.php">Create a Category</a></li>';
		        		echo '<li><a href="create_topic.php">Create a Topic</a></li>';
		        		echo '<li><a href="edit_profile.php?id=' . $_SESSION['user_id'] .'">Edit Profile</a></li>';
		        	echo '</ul></li>';
	        	}else{
	        	//Show user Tools
					echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">User Tools
						<span class="caret"></span></a>';
		        	//Begin drop down <ul>
		        	echo '<ul class="dropdown-menu">';
		        		echo '<li><a href="create_topic.php">Create a Topic</a></li>';
		        		echo '<li><a href="edit_profile.php?id=' . $_SESSION['user_id'] .'">Edit Profile</a></li>';
		        	echo '</ul></li>';
	        	}
	        }
	        ?>
	      <li><a href="about.php">About</a></li>
	      <ul class="nav navbar-nav navbar-right">
	        <?php 	        
	        	if($_SESSION['logged']){
	        	echo '<li><a href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
	        	}else{
	        		//Only echo sign up and login, when logged out
	        		echo '<li><a href="/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
	        		echo '<li><a href="/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
	        		 
	        	}
	        ?>
	      </ul>
	    </div>	    
	  </div>
	</nav>
	<div class="container" id="content">