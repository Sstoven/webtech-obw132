<?php
	//start session
	session_start();

	include('database.php');


	//get username and password from $_POST
	$username = $_POST["username"];
	$password = $_POST["password"];

	//check hash password
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$username'");
	$row = mysqli_fetch_assoc($result);
	$hashpass = $row['Password'];

	if(password_verify($password, $hashpass))
	{
		//if successfull send to login page
		$_SESSION["username"] = $username;
		header("Location:feed.php");
	}else if($result = 0){
		echo "User not registered";
	}else{
		//throw error
		echo "Incorrect login, try again!";
	}

?>