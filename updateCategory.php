<?php 
	if(isset($_GET["categoryid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["categoryid"]);
		if(isset($_POST["submitForm"])){
			$genre = $db->escape($_POST["genre"]);
			if(empty($genre)){
				$errorMsg  = "Minden mező kitöltése kötelező";
			}else{
				$updateString = "UPDATE category SET
					`genre`='".$genre."'
				WHERE id=".$id;
				$db->query($updateString);
				header("Location: listCategory.php");
			}
		}
		$selectString = "SELECT * FROM category WHERE id=".$id;
		$category = $db->getRow($selectString);
	}else{
		header("Location: listCategory.php");
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
			<input type="text" name="genre" value="<?php echo (isset($category)) ? $category["genre"] : "" ; ?>"><br>
			<button type="submit" name="submitForm">
				Mentés
			</button>
		</form>
	</body>
</html>