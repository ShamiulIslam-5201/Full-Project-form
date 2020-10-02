<?php include_once "app/auto_load.php"; ?>
<?php 
	
	// destroy user data
	if(isset($_GET['delete_id']) ){

		 $delete_id = $_GET['delete_id'];
		 $delete_photo = $_GET['photo'];

		 $sql = "DELETE FROM students WHERE id ='$delete_id'";
		 $conn -> query($sql);


		 unlink('photo/students/'. $delete_photo);

		 header("location:students.php");
	}

	// active use
		if(isset($_GET['active_id']) ){
			$active_id = $_GET['active_id'];

			$sql = "UPDATE students SET status='active' WHERE id='$active_id' ";
			$conn -> query($sql);

			header("location:students.php");
		}

		// inactive use
		if(isset($_GET['inactive_id']) ){
			$inactive_id = $_GET['inactive_id'];

			$sql = "UPDATE students SET status='inactive' WHERE id='$inactive_id' ";
			$conn -> query($sql);

			header("location:students.php");
		}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/fonts/font_awesome/css/all.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap-table ">

	<a class="btn btn-sm btn-primary" href="index.php">Add new student Students</a>

		<div class="card shadow">
			<div class="card-body">
				<h2>All Students</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Gender</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Location</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<?php 
						
						$data = $conn -> query("SELECT * FROM students");
						
						$i = 1;

						while($students = $data -> fetch_assoc()) :
	
						?>

						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo $students['name']; ?></td>
							<td><?php echo $students['gender']; ?></td>
							<td><?php echo $students['email']; ?></td>
							<td><?php echo $students['cell']; ?></td>
							<td><?php echo $students['location']; ?></td>

							<td><img src="photo/students/<?php echo $students['photo']; ?>" alt=""></td>
							<td>

								<?php if($students['status'] == 'active'): ?>
									<a class="btn btn-sm btn-danger" href="?inactive_id=<?php echo $students['id'];?>"><i class="fas fa-thumbs-down"></i></a>

								<?php elseif($students['status'] == 'inactive'): ?>	
									<a class="btn btn-sm btn-success" href="?active_id=<?php echo $students['id'];?>"><i class="fas fa-thumbs-up"></i></a>

								<?php endif; ?>
									
								<a class="btn btn-sm btn-info" href="profile.php?student_id=<?php echo $students['id'];?>"><i class="fas fa-eye"></i></a>
								
								<a class="btn btn-sm btn-warning" href="#"><i class="fas fa-edit"></i></a>

								<a id="dlt_btn" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $students['id'];?> &photo=<?php echo $students['photo'];?>"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
						
						<?php endwhile; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		$('a#dlt_btn').click(function(){
			let conf = confirm('Are you sure?');

			if(conf == true){
				return true;
			}else{
				return false;
			}
		})
	</script>
</body>
</html>