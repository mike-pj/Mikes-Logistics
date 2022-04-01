<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/projectpgd/core/init.php';
	include 'includes/head.php';

	$email = ((isset($_POST['email']))?sanitize($_POST['email']) : '');
	$email = trim($email);
	$password = ((isset($_POST['password']))?sanitize($_POST['password']) : '');
	$password = trim($password);
	$errors = array();
?>

<style>
	body{
		background-image: url("/projectpgd/images/background.jpg");
		background-size: 99vw auto;
	}
</style>
<div id="login-form">
	<div>
		
		<?php
		   if ($_POST) {
		   		//form validation
		   	if(empty($_POST['email']) || empty($_POST['password'])){
		   		$errors[] = 'You must provide email and password.';
		   	}

		   	// validate email
		   	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		   		$errors[] = 'You must enter a valid email.';
		   	}

		   	// password is more than 6 characters
		   	if(strlen($password) < 6){
		   		$errors[] = 'Password must be at least 6 characters';
		   	}


		   	//check if email exists in the database
		   	$query = $db->query("SELECT * FROM users WHERE email = '$email'");
		   	$user = mysqli_fetch_assoc($query);
		   	$userCount = mysqli_num_rows($query);
		   	if($userCount < 1){
		   		$errors[] = 'That email doesn\'t exist in the database.';
		   	}

		   	 if(!password_verify($password, $user['password'])){
		   	 	$errors[] = 'The password does not match our records. Please try again.';
		   	 } 



		   	// check for errors
		   	if(!empty($errors)){
		   		echo display_errors($errors);
		   	}else{
		   		// log user in
		   		$user_id = $user['id'];
		   		login($user_id);  
		   	}
		   }
		?>


	</div>
	<h2 class="text-center">Login</h2><hr>
	<form action="login.php" method="post">
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">			
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">			
		</div>
		<div class="form-group">
			<input type="submit" value="Login" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/projectpgd/index.php" alt="home">Visit Site</a></p>
</div>
<style>
	#login-form{
		width:50%;
		height:auto;
		border:2px solid #000;
		border-radius: 20px;
		box-shadow: 20px 20px 15px rgba(0,0,0,0.6);
		margin: 7% auto;
		padding: 3%;
		background-color: #fff; 
	}
</style>

<?php include 'includes/footer.php';