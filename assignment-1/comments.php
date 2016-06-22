<?php
	
	session_start();

	include('database.php');

	$content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
	$UID = filter_var($_POST['UID'], FILTER_SANITIZE_STRING);

	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");

	$row = mysqli_fetch_assoc($result);
	//fetch user info
	$name = filter_var($row['Name'], FILTER_SANITIZE_STRING);
	$profile_pic = filter_var($row["profile_pic"], FILTER_SANITIZE_STRING);

	//insert comment into db
	$result_insert = mysqli_query($conn, "INSERT INTO comments(content, 
		UID, name, profile_pic, likes, created_at) VALUES ('$content',
		'$UID', '$name', '$profile_pic', '0', CURDATE())");

	//check if insert was okay
	if($result_insert){
		//redirect to feed page
		header("Location: feed.php");
	}else{
		//throw error
		printf("Errormessage: %s\n", mysqli_error($conn));
		echo "<br>Oops! Something went wrong! Please try again!<br>";
	}




?>