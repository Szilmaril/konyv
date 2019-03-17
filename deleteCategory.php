<?php 
	if(isset($_GET["categoryid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["categoryid"]);
		if(isset($_POST["submitForm"])){
			$deleteString = "DELETE FROM category WHERE id=".$id;
			$db->query($deleteString);
			header("Location: listCategory.php");
			exit();
		}
		$selectString = "SELECT * FROM category WHERE id=".$id;
		$category = $db->getRow($selectString);
	}else{
		header("listCategory.php");
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
			if(isset($category)){
				echo $category["genre"];
			}
		?>
		<h2>elemet?</h2>
		<form action="" method="POST">
			<button type="submit" name="submitForm">
				Igen
			</button>
			<a href="listCategory.php">
				<button type="button">
					Mégse
				</button>
			</a>
		</form>
	</body>
</html>
