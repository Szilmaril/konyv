<?php 
	if(isset($_GET["usersid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["usersid"]);
		if(isset($_POST["submitForm"])){
			$deleteString = "DELETE FROM users WHERE id=".$id;
			$db->query($deleteString);
			header("Location: listUser.php");
			exit();
		}
		$selectString = "SELECT * FROM users WHERE id=".$id;
		$users = $db->getRow($selectString);
	}else{
		header("listUser.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Biztos törli a(z):</h2>
		<?php 
			if(isset($users)){
				echo $users["username"];
			}
		?>
		<h2>elemet?</h2>
		<form action="" method="POST">
			<button type="submit" name="submitForm">
				Igen
			</button>
			<a href="listUser.php">
				<button type="button">
					Mégse
				</button>
			</a>
		</form>
	</body>
</html>