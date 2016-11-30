<?php
session_start();
require_once("connection.php");


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<h1>Wellcome <?php echo $_SESSION['user'] ?>, Here is your Book Snap account</h1>
	<form action="process.php" method="post" enctype="multipart/form-data">
		<input type="file" name="fileToUpload"><br>
		<input type="text" name="book_title" placeholder="The Book Title"><br>
		<input type="hidden" name="source" value="snapshot">
		<input type="submit" name="submit" value="upload your snapshot">
	</form>

	<div>
<?php 
			$query = "SELECT * from snap";
			global $connection;
			$result = $connection->query($query);
			while($row = mysqli_fetch_assoc($result)){
		  		$im= $row['image'];
		  		$book= $row['book_title'];
		  		echo "Name has post this snap from" .$book."<br>";
		  		echo "<img src='".$im."' style='height: 200px; width: 200px;'>"."<br>";
		  		?>
		  		<form action="process.php" method="post">
		  			<input type="hidden" name="source" value="comment">
		  			<input type="submit" name="" value="comment">
		  		</form>
<?php		}
?>

	</div>

</body>
</html>