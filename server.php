<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'db_ls');

	// initialize variables
	$member = "";
   	$book = "";
    $issue = "";
    $return = "";
    $remarks = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
	
    $member = $_POST['memberName'];
   	$book = $_POST['bookName'];
    $issue = $_POST['issuedDate'];
    $return = $_POST['returnedDate'];
    $remarks = $_POST['remarks'];
	
	$sql = "INSERT INTO borrowedbooks (bookName,memberName,issuedDate,returnedDate,remarks)VALUES(?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssss",$book,$member,$issue,$return,$remarks);
    $stmt->execute();
		
	$_SESSION['message'] = "Address saved"; 
	header('location: index.php');
	}


	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$member = $_POST['memberName'];
   	$book = $_POST['bookName'];
    $issue = $_POST['issuedDate'];
    $return = $_POST['returnedDate'];
    $remarks = $_POST['remarks'];
    
    $sql = "UPDATE borrowedbooks SET bookName = ?,memberName = ?, issuedDate = ?,returnedDate = ?,remarks = ? WHERE borrowedBookId = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssssi",$book,$member,$issue,$return,$remarks,$id);
    $stmt->execute();

	$_SESSION['message'] = "Address updated!"; 
	header('location: index.php');
	}

	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM borrowedbooks WHERE borrowedBookId=$id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: index.php');
	}


	$results = mysqli_query($db, "SELECT * FROM borrowedbooks");


?>