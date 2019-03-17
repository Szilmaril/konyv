<?php session_start();

if(isset($_POST["login"])){
	require_once "db.php";
	$db = db::get();
	$username = $db->escape($_POST["username"]);
	$password = $db->escape($_POST["password"]);
	$passwordhashed = md5($password);

	if(empty($username) || empty($password)){
		$errorMsg = "Minden mező kitöltése kötelező!";
	}
	else
	{
		$selectString = "SELECT * FROM users where `username`='$username' && `password` = '$passwordhashed' LIMIT 1";
		$userCheck = $db->getArray($selectString);
		if(count($userCheck) == 0){
			$errorMsg = "Hibás email vagy jelszó!";
		}else{

			$_SESSION["username"] = $username;
			header("Location: list.php");
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<div class="container" style="margin-top: 5%;">
			<div class="text-center">
				<form action="" method="POST">
			<?php //require_once "errorMessage.php"; ?>
			<label for="username">Username </label>
			<input type="text" id="username" name="username">
			<br>
			<label for="password">Jelszó</label>
			<input type="password" id="password" name="password">
			<br>
			<button name="login" class="btn btn-secondary">
				Bejelentkezés
			</button><br>
			<!--<a href="#" style="color: black; text-decoration: none;">
				Elfelejtettem a jelszavam!
			</a>-->
		</form>
			</div>
		</div>
		
	</body>
</html>