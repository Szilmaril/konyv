<?php 
	session_start();
	if (isset($_SESSION["username"])) {
		header("location: list.php");
	}
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<form class="container text-center" action="" method="POST">
			<a href="login.php" class="btn btn-primary">Bejelentkezés</a>
			<label>Felhasználónév: </label>
			<input type="text" name="username" id="username" value="<?php echo (isset($users)) ? $users["username"] : "" ; ?>"><br>
			<label>Jelszó: </label>
			<input type="password" name="password" id="password" value="<?php echo (isset($users)) ? $users["password"] :"";?>"><br>
			<label>Jelszó ellenörzés: </label>
			<input type="password" name="password_confirmation" id="passwordConfirmation" value="<?php echo (isset($users)) ? $users["password"] :"";?>"><br>
			<label>Email: </label>
			<input type="email" name="email" id="email" value="<?php echo (isset($users)) ? $users["email"] :"";?>"><br>
			<label>Születésnap: </label>
			<input type="date" name="birthday" id="birthday" value="<?php echo (isset($users)) ? $users["birthday"] :""; ?>"><br>
	
			<button type="submit" name="submitForm">Mentés</button>
		</form>
	</body>
</html>
<?php 
	require_once "db.php";
	$db = db::get();
	if(true){
		if(isset($_POST["submitForm"])){
			$username = $db->escape($_POST["username"]);
			$password = $db->escape($_POST["password"]);
			$email = $db->escape($_POST["email"]);
			$birthday = $db->escape($_POST["birthday"]);
			$password_confirmation = $db->escape($_POST["password_confirmation"]);
			if(empty($username) || empty($password) || empty($email) || empty($birthday)){
				$errorMsg = "Minden mező kitöltése kötelező";
		}else{
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errorMsg = "Az emailcím nem megfelelő formátumú";
			}else if(strlen(trim($password)) < 8){
				$errorMsg = "A jelszónak legalább 8 karakternek kell lennie";
			}else if($password != $password_confirmation){
					$errorMsg = "A jelszó és a jelszó megerősítésnek egyeznie kell!";
				}else{
					$insertString = "INSERT INTO users(
				`username`,
				`password`,
				`email`,
				`birthday`
				) VALUE(
				'".$username."',
				'".md5($password)."',
				'".$email."',
				'".$birthday."'
				);";
				$db->query($insertString);
				$_SESSION["username"] = $username;
				header("location: list.php");
				}
			}
		}
	}
?>