<?php 
include('server.php');
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM borrowedbooks WHERE borrowedBookId=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
		    $member = $n['memberName'];
    		$book = $n['bookName'];
   	 		$issue = $n['issuedDate'];
    		$return = $n['returnedDate'];
    		$remarks = $n['remarks'];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM borrowedbooks"); ?>

<nav class="navbar navbar-expand-md bg-dark navbar-dark  " >
      <!-- Brand -->
      <a class="navbar-brand" href="#">Borrow Books</a>

      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      
    </nav>



<form method="post" action="server.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">

	<div class="input-group">
		<label>Book Name</label>
		<input type="text" name="bookName" value="<?php echo $member; ?>" required>
	</div>
	
	<div class="input-group">
		<label>Member Name</label>
		<input type="text" name="memberName" value="<?php echo $book; ?>" required>
	</div>
	
	<div class="input-group">
		<label>Issued Date</label>
		<input type="date" name="issuedDate" value="<?php echo $issue; ?>"required>
	</div>
	
	<div class="input-group">
		<label>Returned Date</label>
		<input type="date" name="returnedDate" value="<?php echo $return; ?>"required>
	</div>
	
	<div class="input-group">
		<label>Remarks</label>
		<input type="text" name="remarks" value="<?php echo $remarks; ?>"required>
	</div>
	
	<div class="input-group">

		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save" style="background: #556B2F;">Add</button>
		<?php endif ?>
	</div>
</form>

<table>
	<thead>
		<tr>
			<th>Book Name</th>
			<th>Member Name</th>
			<th>Issued Date</th>
			<th>Returned Date</th>
			<th>Remarks</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['bookName']; ?></td>
			<td><?php echo $row['memberName']; ?></td>
			<td><?php echo $row['issuedDate']; ?></td>
			<td><?php echo $row['returnedDate']; ?></td>
			<td><?php echo $row['remarks']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['borrowedBookId']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['borrowedBookId']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	

</body>
</html>