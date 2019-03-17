<?php 
	if(isset($_GET["booksid"])){
		require_once "../db.php";
		$db = db::get();
	}
?>
<?php
		$id = $db->escape($_GET["booksid"]);
		if(isset($_POST["submitForm"])){
			$selectString = "SELECT * FROM book_edition WHERE id=".$id;
			$book_edition = $db->getRow($selectString);
			$selectcategoryQuery = "SELECT * FROM category";
			$allcategorys = $db->getArray($selectcategoryQuery);
			$selectbookQuery = "SELECT * FROM book";
			$allbooks = $db->getArray($selectbookQuery);
			$selectwriterQuery = "SELECT * FROM writer";
			$allwriters = $db->getArray($selectwriterQuery);
			$category_id = $db->escape($_POST["category_id"]);
			$book_id = $db->escape($_POST["book_id"]);
			$writer_id = $db->escape($_POST["writer_id"]);
				$updateString = "UPDATE book_edition SET
					`writer_id`='".$writer_id."'
					`book_id`='".$book_id."'
					`category_id`='".$category_id."'
				WHERE id=".$id;
				$db->query($updateString);
				header("Location: listBooks.php");
	}else{
		header("Location: listBooks.php");
		exit();
	}
?>
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
