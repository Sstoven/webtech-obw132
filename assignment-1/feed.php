<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();
	$conn = connect_db();
	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	//user information 
	$row = mysqli_fetch_assoc($result);
	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";
	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";
	echo "<br>";
	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);
	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}
	$result_comments = mysqli_query($conn, "SELECT * FROM comments");
	//show all posts and comments on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){
		$row = mysqli_fetch_row($result_posts);
		$comment = mysqli_fetch_assoc($result_comments);
		echo "$row[2] said $row[1] ($row[5])";
		echo "<br>";
		echo $comment['content']." commented ".$comment['UID']." (".$comment['name'].")";
		echo "<form action='likes.php' method='POST'> 
		<input type='hidden' name='PID' value='$row[0]'> 
		<input type='submit' value='Like'></form>";
		echo "<form action='comments.php' method='POST'>
		<p><textarea name='content'>Comment...</textarea></p>
		<input type='hidden' name='UID' value='$row[1]'>
		<p><input type='submit' value='Comment!'></p></form>";
		echo "<br>";
	}
?>


</body>
</html>