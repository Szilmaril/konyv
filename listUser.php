<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: ../index.php");
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
		<a class="navbar-brand" href="#">Felhasználólista</a>
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
					<a class="nav-link" href="listUser.php">Felhasználólista szerkesztés</a>
				</li>
			<?php endif; ?>
			</ul>
		</div>
	</nav>
	<?php 
		$selectString = "SELECT * FROM users";
		$db = db::get();
		$allusers = $db->getArray($selectString);
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php if(count($allusers) == 0):?>
			Jelenleg nincs egy kategória sem!
		<?php else:?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Felhasználónév</th>
						<th>E-mail cím</th>
						<th>Születésnap</th>
						<th>Szerkesztés</th>
						<th>Törlés</th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($allusers as $users):?>
				<tr>
					<td><?php echo $users["id"]; ?></td>
					<td><?php echo $users["username"]; ?></td>
					<td><?php echo $users["email"]; ?></td>
					<td><?php echo $users["birthday"]; ?></td>
					<td><a href="updateUser.php?usersid=<?php echo $users["id"];?>">Szerkesztés</a></td>
					<td><a href="deleteUser.php?usersid=<?php echo $users["id"];?> ">Törlés</a></td>
				</tr>
			<?php endforeach;?>
		<?php endif;?>
		
	</body>
</html>