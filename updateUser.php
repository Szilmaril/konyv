<?php 
	if(isset($_GET["usersid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["usersid"]);
		if(isset($_POST["submitForm"])){
			$username = $db->escape($_POST["username"]);
			$email = $db->escape($_POST["email"]);
			if(empty($username) ||empty($email)){
				$errorMsg  = "Minden mező kitöltése kötelező";
			}else{
				$updateString = "UPDATE users SET
					`username`='".$username."',
					`email`='".$email."'
					WHERE id=".$id;
				$db->query($updateString);
				header("Location: listUser.php");
			}
		}
		$selectString = "SELECT * FROM users WHERE id=".$id;
		$users = $db->getRow($selectString);
	}else{
		header("Location: listUser.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<form action="" method="POST">
				Neve 
			<input type="text" name="username" value="<?php echo (isset($users)) ? $users["username"] : "" ; ?>"><br>
			<input type="email" name="email" value="<?php echo (isset($users)) ? $users["email"] : "" ; ?>"><br>
			<button type="submit" name="submitForm">
				Mentés
			</button>
		</form>
	</body>
</html>