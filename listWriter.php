<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: ../index.php");
	}
	$selectString = "SELECT * FROM writer";
	$db = db::get();
$writers = $db->getArray($selectString);
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
					<li class="nav-item active">
						<a class="nav-link" href="listWriter.php">Író szerkesztés</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="listCategory.php">Műfaj szerkesztés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>

				<div class="container">
			<?php foreach($writers as $writer):?>
		<div class="card" style="width:800px">
			<div class="card-header text-center">
				<h4>
					<?php echo $writer["writer_name"]; ?>
				</h4>
			</div>
			<div class="card-body text-center">
			<img src="../image/<?php echo $writer["writer_picture"];?>" width="600" height="600">
		</div>
		<div class="card-footer">
			<h6>Születésnap: <?php echo $writer["writer_birthday"]; ?></h6><hr>
			<h6>Története:</h6><p><?php echo $writer["life_story"]; ?></p>
			<a href="list.php">Vissza<a>
		</div>
	<?php endforeach; ?>
		</div>
	</body>
</html>