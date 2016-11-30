<?php 
session_start();
require_once("connection.php");


if(isset($_POST["source"]) && $_POST['source']== 'register'){
	signup();
}
if(isset($_POST['source']) && $_POST['source'] == 'login'){
	login();
}

if(isset($_POST['source']) && $_POST['source'] == 'snapshot'){
	uploadSnapShot();
}
if(isset($_POST['source']) && $_POST['source'] == 'comment'){
	commentProcess();
}


//Here exist the functions
function signup(){
	$updated_at = $created_at = date("y-m-d H:i:s");
	$first_name= $_POST["first_name"];
	$last_name= $_POST["last_name"];
	$email= $_POST["email"];
	$password= $_POST["password"];
	$query= "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
	VALUES ('$first_name', '$last_name', '$email', '$password', '$created_at', '$updated_at')";
	$result = run_mysql_query($query);

	//echo "<script>alert ('you are successfully registered. you can now log in') </script>";
	//header("Location: http://localhost:8888/book snap/login.php");
	header( 'Location: http://localhost:8888/book snap/login.php?action=success' );
    
}


function login(){
	$query="SELECT * FROM users WHERE
		email= '{$_POST['email']}'
		AND password= '{$_POST['password']}'";
	$result= fetch_record($query);
	if($result){
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['user_id']= $result['id'];
		$_SESSION['user'] = $result['first_name'];
		header('location: http://localhost:8888/book snap/index.php');
	}else{

		header('location: http://localhost:8888/book snap/login.php?action=loggedin');
	}
}


//function uploadSnapShot(){
//
//	$book_title = $_POST['book_title'];
//	$imagename=$_FILES["image"]["name"];
//	$imagetmp=addslashes (file_get_contents($_FILES['image']['tmp_name']));
//	$query = "INSERT INTO snap (image, book_title) VALUES ('$imagetmp', '$book_title')";
//	$result = run_mysql_query($query);
//	header( 'Location: http://localhost:8888/book snap/index.php' );
//}//else{
	//echo "think about s.m to say later";
//}


function uploadSnapShot(){
	//the book title
	$book_title = $_POST['book_title'];
	//the image process
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	    	echo "<script>
	    	 alert ('File is not an image.');
	    	 window.location.href='http://localhost:8888/book snap/index.php';
	    	</script>";
	        $uploadOk = 0;
	    }
	}
// Check if file already exists
	if (file_exists($target_file)) {
		echo "<script>
	    	 alert ('Sorry, file already exists.');
	    	 window.location.href='http://localhost:8888/book snap/index.php';
	    	</script>";
	    $uploadOk = 0;
	}
// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "<script>
	    	 alert ('Sorry, your file is too large.');
	    	 window.location.href='http://localhost:8888/book snap/index.php';
	    	</script>";
	    $uploadOk = 0;
	}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "<script>
	    	 alert ('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
	    	 window.location.href='http://localhost:8888/book snap/index.php';
	    	</script>";
	    $uploadOk = 0;
	}
// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "<script>
	    	 alert ('Sorry, your file was not uploaded.');
	    	 window.location.href='http://localhost:8888/book snap/index.php';
	    	</script>";
// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	    	echo "<script>
	    	 alert ('The file  has been uploaded');
	    	 window.location.href='http://localhost:8888/book snap/index.php';
	    	</script>";
	    	$query = "INSERT INTO snap (image, book_title) VALUES ('$target_file', '$book_title')";
			$result = run_mysql_query($query);
	        
	    } else {
	    	header('location: http://localhost:8888/book snap/index.php');
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}

function commentProcess(){
	
}


?>