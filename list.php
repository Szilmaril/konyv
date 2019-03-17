<?php 
session_start();
require_once ("db.php");

if (!isset($_SESSION["username"])) {
	header("location: index.php");
}

$selectString = "SELECT * FROM book_edition LEFT JOIN category ON category_id = category.id LEFT JOIN writer ON writer_id = writer.id LEFT JOIN book ON book_id = book.id";
$db = db::get();
$book_editions = $db->getArray($selectString);
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once("head.php"); ?>
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
			
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="list.php">Főoldal</a>
					</li>
					<?php if($_SESSION["username"] == "admin"): ?>
					<li class="nav-item">
						<a class="nav-link" href="update/listUser.php">Felhasználó lista</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="upload/uploadBooks.php">Adatfeltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="update/listBooks.php">Adatszerkesztés</a>
					</li>
					<?php endif; ?>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Kilépés</a>
					</li>
				</ul>
			</div>
		</nav>

	<?php foreach($book_editions as $book_edition):?>
		<div class="container text-center">
			<div class="card" style="background-color: rgba(255,255,255,.5);">
				<div class="card-header text-center">
					<h4>
						<a style="text-decoration: none; color: black;" href="selectWriter.php?szerzoid="><?php echo $book_edition["book_title"]; ?></a>
					</h4>
				</div>
				<div class="card-body text-center">
					<img src="image/<?php echo $book_edition["cover_image"];?>" style="width: 50vw; height: 50vh; border-radius: 10px;">
				</div>
				<div class="card-footer">
					<h6>Műfaj: <?php echo $book_edition["genre"]; ?></h6><hr>
					<h6>Megjelenési dátum: <?php echo $book_edition["publishing"]; ?></h6><hr>
					<h6> Nyelv: <?php echo $book_edition["language"]; ?></h6><hr>
					<h6><?php echo $book_edition["story"]; ?></h6><hr>
					<a href="selectWriter.php?szerzoid=<?php echo $book_edition["writer_id"]; ?>"><?php echo $book_edition["writer_name"]; ?></a>
				</div>
			</div>
		</div>

	<?php endforeach;?>
</body>
</html>