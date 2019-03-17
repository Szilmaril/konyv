<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: ../index.php");
	}
$db = db::get();
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
			<a class="navbar-brand" href="#">Adatszerkesztés</a>
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
						<a class="nav-link" href="listBooks.php">Könyv szerkesztés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listBook.php">Könyv kiadás szerkesztés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listWriter.php">Író szerkesztés</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="listCategory.php">Műfaj szerkesztés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
<?php 
$selectString = "SELECT * FROM category";
$db = db::get();
$categorys = $db->getArray($selectString);
?>
		<?php if(count($categorys) == 0):?>
			Jelenleg nincs egy kategória sem!
		<?php else:?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Műfaj</th>
						<th>Szerkesztés</th>
						<th>Törlés</th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($categorys as $category):?>
				<tr>
					<td><?php echo $category["id"]; ?></td>
					<td><?php echo $category["genre"]; ?></td>
					<td><a href="updateCategory.php?categoryid=<?php echo $category["id"];?>">Szerkesztés</a></td>
					<td><a href=" deleteCategory.php?categoryid=<?php echo $category["id"];?> ">Törlés</a></td>
				</tr>
			<?php endforeach;?>
		<?php endif;?>
		
	</body>
</html>