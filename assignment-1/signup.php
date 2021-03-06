<?php
	//start session
	session_start();

	include('database.php');
	//connectto DB
	$conn = connect_db();

	//get info from $_POST
	if(isset($_POST["username"]))
	{
		$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	if(isset($_POST["password"]))
	{
		$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	if(isset($_POST["name"]))
	{
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	if(isset($_POST["email"]))
	{
		$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	if(isset($_POST["dob"]))
	{
		$dob = filter_var($_POST["dob"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	if(isset($_POST["gender"]))
	{
		$gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	if(isset($_POST["verans"]))
	{
		$verification_answer = filter_var($_POST["verans"], FILTER_SANITIZE_STRING);
	}else{
		header("Location:signup.html");
	}
	$verques = "What was your first pets name?";
	if(isset($_POST["location"]))
	{
		$location = filter_var($_POST["location"], FILTER_SANITIZE_STRING);
	}else{
		$location = NULL;
	}
	if(isset($_FILES["profilepic"]))
	{
		//get the picture ready to upload
		$profile_pic =  mysqli_real_escape_string($conn,$_FILES["profilepic"]);
	}else{
		$profile_pic = NULL;
	}

	



	//hash the password
	$hash_password = password_hash($password, PASSWORD_DEFAULT);



	//escape the img
	//$profile_pic = mysqli_real_escape_string($conn, $profile_pic);

	//insert data into DB
	$result_insert = mysqli_query($conn, "INSERT INTO users(Username, 
		Password, Name, Email, dob, gender, verification_question, 
		verification_answer, location, profile_pic) VALUES ('$username',
		'$hash_password', '$name', '$email', '$dob', '$gender', '$verques',
		'$verification_answer', '$location', '$profile_pic')");

	//check if insert was okay
	if($result_insert){
		//redirect to login page
		header('Location: login.html');
	}else{
		//throw error
		echo "Oops! Something went wrong! Please try again!<br>";
		printf("Errormessage: %s\n", mysqli_error($conn));
	}

?>