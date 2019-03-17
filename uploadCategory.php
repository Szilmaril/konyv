<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once("../head.php"); ?>
	<style>
		.bg
		{
			background-image: url("http://www.budaorsiinfo.hu/wp-content/uploads/2013/12/konyv_illusztr.jpg");
			background-size: cover;
			background-repeat: none;
		}

		.bg img
		{
			height: 100%;
			width: 100%;
		}

	</style>
</head>
<body class="bg">
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Adatfeltöltés</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				<?php if($_SESSION["username"] == "admin"): ?>
					<li class="nav-item">
						<a class="nav-link" href="../list.php">Főoldal</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadBooks.php">Könyv feltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadBook.php">Könyv kiadás feltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadWriter.php">Író feltöltés</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="uploadCategory.php">Műfaj feltöltés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
	<div class="container">	
		<form class="text-center" action="" method="POST">
			<label>Műfaj: </label>
			<input type="text" name="genre" value="<?php echo (isset($category)) ? $category["genre"] : "" ; ?>"><br>
	
			<button type="submit" name="submitForm">Mentés</button>
		</form>
	</div>
<?php
	if(isset($_POST["submitForm"])){
		$db = db::get();
		$genre = $db->escape($_POST["genre"]);
		
	if(empty($genre)){
		echo "Minden mező kitöltése kötelező!";
	}else{
		$insertString = "INSERT INTO category(
				`genre`
				) VALUE(
				'".$genre."'
				);";
			$db->query($insertString);
			//header("Location: listahelye");
		}
	}
?>
</body>
</html>