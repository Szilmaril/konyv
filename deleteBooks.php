<?php 
	if(isset($_GET["booksid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["booksid"]);
		if(isset($_POST["submitForm"])){
			$deleteString = "DELETE FROM book_edition WHERE id=".$id;
			$db->query($deleteString);
			header("Location: listBooks.php");
			exit();
		}
		$selectString = "SELECT * FROM book_edition WHERE id=".$id;
		$book_edition = $db->getRow($selectString);
	}else{
		header("listBooks.php");
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
			if(isset($book_edition)){
				echo $book_edition["id"];
			}
		?>
		<h2>elemet?</h2>
		<form action="" method="POST">
			<button type="submit" name="submitForm">
				Igen
			</button>
			<a href="listBooks.php">
				<button type="button">
					Mégse
				</button>
			</a>
		</form>
	</body>
</html>