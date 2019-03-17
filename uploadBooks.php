<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: index.php");
	}
	$db = db::get();
	$selectcategoryQuery = "SELECT * FROM category";
	$allcategorys = $db->getArray($selectcategoryQuery);
	$selectbookQuery = "SELECT * FROM book";
	$allbooks = $db->getArray($selectbookQuery);
	$selectwriterQuery = "SELECT * FROM writer";
	$allwriters = $db->getArray($selectwriterQuery);
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
					<li class="nav-item active">
						<a class="nav-link" href="uploadBooks.php">Könyv feltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadBook.php">Könyv kiadás feltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadWriter.php">Író feltöltés</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="uploadCategory.php">Műfaj feltöltés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
<div class="container">	
	<form class="text-center" method="POST">
		<select name="category_id" id="">
			<?php if(count($allcategorys) == 0): ?>
				<option value="">No categories</option>
			<?php endif; ?>
			<?php foreach($allcategorys as $category): ?>
				<option value="<?php echo $category['id']; ?>"><?php echo $category["genre"]; ?></option>
			<?php endforeach; ?>
		</select>
		<select name="book_id" id="">
			<?php if(count($allbooks) == 0): ?>
				<option value="">No categories</option>
			<?php endif; ?>
			<?php foreach($allbooks as $book): ?>
				<option value="<?php echo $book['id']; ?>"><?php echo $book["book_title"]; ?></option>
			<?php endforeach; ?>
		</select>
		<select name="writer_id" id="">
			<?php if(count($allwriters) == 0): ?>
				<option value="">No categories</option>
			<?php endif; ?>
			<?php foreach($allwriters as $writer): ?>
				<option value="<?php echo $writer['id']; ?>"><?php echo $writer["writer_name"]; ?></option>
			<?php endforeach; ?>
		</select>
		<button type="submit" name="submitForm">Mentés</button>
	<form>
</div>
	<?php 
		if(isset($_POST["submitForm"])){
			$category_id = $db->escape($_POST["category_id"]);
			$book_id = $db->escape($_POST["book_id"]);
			$writer_id = $db->escape($_POST["writer_id"]);
			
			$insertString = "INSERT INTO book_edition 
						(
						`writer_id`,
						`book_id`,
						`category_id`
						)
						VALUES 
						(
						'".$writer_id."',
						'".$book_id."',
						'".$category_id."'
						)";
						$db->query($insertString);
		}
	?>	