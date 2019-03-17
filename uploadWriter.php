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
					<li class="nav-item active">
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
        <form class="text-center" action="" method="POST" enctype="multipart/form-data">
            <label>Név: </label>
			<input type="text" name="writer_name" required="true"><br>
			<label>Születésnap: </label>
			<input type="date" name="writer_birthday" required="true"><br>
			<label>Kép: </label>
			<input type="file" name="fileToUpload" required="true"><br>
			<label>Leírás: </label>
			<textarea name="life_story" id="" rows="3" placeholder="leíras" required="true"></textarea><br>
			
            <button type="submit" name="submit" class="btn btn-success">Feltöltés</button>
        </form>
    </div>
    <?php 
      $db = db::get();

        if(isset($_POST["submit"])) {
  
        $writer_name = $db->escape($_POST["writer_name"]);
        $writer_birthday = $db->escape($_POST["writer_birthday"]);
        $life_story = $db->escape($_POST["life_story"]);

        $target_dir = "../image/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	$writer_picture = basename($_FILES["fileToUpload"]["name"]);
        	
            $uploadPictureSql = "INSERT INTO `writer` (
			`writer_name`,
			`writer_picture`,
			`writer_birthday`,
			`life_story`
			) VALUES (
			'".$writer_name."',
			'".$writer_picture."',
			'".$writer_birthday."', 
			'".$life_story."')";
            $query = $db->query($uploadPictureSql);

            #echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}
?>

</body>
</html>