<?php include_once "app/auto_load.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
<?php
	if(isset($_GET['edit_id'])){
		$edit_id = $_GET['edit_id'];

		$sql = "SELECT * FROM students WHERE id='$edit_id' ";
		$data = $conn -> query($sql);

		$single_data = $data -> fetch_assoc();

		
	}
?>

<?php
		 
      
		//add student form issetting
		if(isset($_POST['update'])){
			//Get value
			$edit_id = $_GET['edit_id'];

			$name = $_POST['name'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];
			$uname = $_POST['uname'];
			$age = $_POST['age'];

			if(isset($_POST['gender'])){
				$gender = $_POST['gender'];
			}

			$shift = $_POST['shift'];

			$location = $_POST['location'];

			//Image upload
			// $file_name = $_FILES['photo']['name'];
			// $file_tmp_name = $_FILES['photo']['tmp_name'];
			// $file_size = $_FILES['photo']['size'];

			// $unique_file_name = md5(time() . rand()) .$file_name;

			
			//form validation
			if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($age) || empty($gender) || empty($shift) || empty($location)){
				$mess = validationMsg('All fields are required', 'danger') ;		
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
				$mess = validationMsg('Invalid email' ) ;	
            }elseif($age <= 17 || $age >= 25){
				$mess = validationMsg('Your Age is not okay for our school', 'warning' ) ;
			}else{

				$sql = "UPDATE students SET name='$name', email='$email', cell='$cell', uname='$uname', age='$age', gender='$gender', shift='$shift', location='$location' WHERE id='$edit_id'  ";

				$conn -> query($sql);

				// move_uploaded_file($file_tmp_name, 'photo/students/' . $unique_file_name);

				$mess = validationMsg('Data Stable', 'success') ;

				

			}

		}
	
	
	?>
	
	

	<div class="wrap shadow">
	
		<a class="btn btn-sm btn-primary" href="students.php">All Students</a>

		<div class="card">
			<div class="card-body">
				<h2>Update Student</h2>
				<?php

					if (isset($mess)){
						echo $mess;
					}

				?>
				<form action="" method='POST' enctype='multipart/form-data'>

					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control"  name="name" value="<?php echo $single_data['name']; ?>" type="text">
					</div>
					
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control"  name="email" value="<?php echo $single_data['email']; ?>" type="email">
					</div>

					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" name="cell" value="<?php echo $single_data['cell']; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" name="uname" value="<?php echo $single_data['uname']; ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" name="age" value="<?php echo $single_data['age']; ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Gender</label><br>
						<input value="male" <?php if($single_data['gender'] == 'male' ){ echo "checked"; } ?> name="gender" type="radio" id="male"><label for="male">Male</label>
						<input value="female" <?php if($single_data['gender'] == 'female' ){ echo "checked"; } ?>  name="gender" type="radio" id="female"><label for="female">Female</label>
					</div>

				
					<div class="form-group">
						<label for="">Shift</label>
						<select name="shift" id="">
							<option value="">-Selectt-</option>
							<option value="Morning" <?php if($single_data['shift'] == 'Morning' ){ echo "selected"; }?> >-Morning-</option>
							<option value="Evening" <?php if($single_data['shift'] == 'Evening' ){ echo "selected"; }?> >-Evening-</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">Location</label>
						<select name="location" id="">
							<option value="">-Select-</option>
							<option <?php if($single_data['location'] == 'Dhaka' ){ echo "selected"; }?> value="Dhaka">-Dhaka-</option>
							<option <?php if($single_data['location'] == 'Rajshahi' ){ echo "selected"; }?> value="Rajshahi">-Rajshahi-</option>
							<option <?php if($single_data['location'] == 'Chittagong' ){ echo "selected"; }?> value="Chittagong">-Chittagong-</option>
							<option <?php if($single_data['location'] == 'Kumilla' ){ echo "selected"; }?> value="Kumilla">-Kumilla-</option>
							<option <?php if($single_data['location'] == 'Barisal' ){ echo "selected"; }?> value="Barisal">-Barisal-</option>
							<option <?php if($single_data['location'] == 'Sylhet' ){ echo "selected"; }?> value="Sylhet">-Sylhet-</option>
							<option <?php if($single_data['location'] == 'Rongpur' ){ echo "selected"; }?> value="Rongpur">-Rongpur-</option>
							<option <?php if($single_data['location'] == 'Dinajpur' ){ echo "selected"; }?> value="Dinajpur">-Dinajpur-</option>
							<option <?php if($single_data['location'] == 'Khulna' ){ echo "selected"; }?> value="Khulna">-Khulna-</option>
							<option <?php if($single_data['location'] == 'Mymensingh' ){ echo "selected"; }?> value="Mymensingh">-Mymensingh-</option>
						</select>
					</div>

					<div class="form-group">
						<img style="width::300px; height:200px;" src="photo/students/<?php echo $single_data['photo']; ?>" alt="">
						<input type="hidden" name="old_photo"  value="<?php echo $single_data['photo']; ?>">
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<input class="form-control-file" name="new_photo" type="file">
					</div>

					<div class="form-group">
						<input name='update' class="btn btn-primary" type="submit" value="Update Now">
					</div>
				</form>
			</div>
		</div>
	</div>







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>