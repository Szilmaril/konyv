<?php 
session_start();

if (!isset($_SESSION["username"])) {
	header("location: index.php");
}
require_once "db.php";

$writername = $_GET["szerzoid"];
$writername = (int)$writername;
$selectString = "SELECT * FROM writer WHERE szerzoid =".$szerzoid;

$db = db::get();
$writers = $db->getArray($selectString);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once("head.php"); ?>
	</head>
	<body>
		<div class="container">
			<?php foreach($writers as $writer):?>
		<div class="card" style="width:800px">
			<div class="card-header text-center">
				<h4>
					<?php echo $writer["writer_name"]; ?>
				</h4>
			</div>
			<div class="card-body text-center">
			<img src="image/<?php echo $writer["writer_picture"];?>" width="600" height="600">
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