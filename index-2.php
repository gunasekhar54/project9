<?php include('save.php') ?>
<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}



	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php  if (isset($_SESSION['username'])) : ?>
	<div class="cont_header">
		<h3>Welcome <?php echo $_SESSION['username'];?></h3>
		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
	</div>
	<?php endif; ?>


	 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";
$txt = $_SESSION['username'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = " SELECT * FROM `users` WHERE username = '$txt' ";
$run_query = mysqli_query($conn, $query);
    
if(mysqli_num_rows($run_query) == 1){
while($result = mysqli_fetch_assoc($run_query)){

$user_username = $result['username'];
$email = $result['email'];

}
}

mysqli_close($conn);
?> 

	<div class="content_student">
        <form class="student_data_update" method="post" action="index.php">
			<div class="input-group">
				<label>Name</label>
				<input type="text" name="username" value="<?php echo $user_username;?>">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="text" name="email" value="<?php echo $email;?>">
			</div>
			<div class="input-group">
				<label>Roll No</label>
				<input type="text" name="roll_no">
			</div>
			<div class="input-group">
				<label>Course Name</label>
				<input type="text" name="course">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="student_sdata">Save</button>
			</div>
		
	    </form>
	</div>
		
</body>
</html>


