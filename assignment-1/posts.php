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

	$result_insert = mysqli_query($conn, "INSERT INTO posts(content, 
		UID, name, profile_pic, likes) VALUES ('$content',
		'$UID', '$name', '$profile_pic', '0')");

	//check if insert was okay
	if($result_insert){
		//redirect to feed page
		header("Location: feed.php");
	}else{
		//throw error
		printf("Errormessage: %s\n", mysqli_error($conn));
		echo "<br>Oops! Something went wrong! Please try again!<br>";
	}

	echo "Content: $content";
	echo "<br>";
	echo "UID: $UID";





?>