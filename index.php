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
		 
      
		//add student form issetting
		if(isset($_POST['add'])){
			//Get value
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
			$file_name = $_FILES['photo']['name'];
			$file_tmp_name = $_FILES['photo']['tmp_name'];
			$file_size = $_FILES['photo']['size'];

			$unique_file_name = md5(time() . rand()) .$file_name;

			
			//form validation
			if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($age) || empty($gender) || empty($shift) || empty($location)){
				$mess = validationMsg('All fields are required', 'danger') ;		
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
				$mess = validationMsg('Invalid email' ) ;	
            }elseif($age <= 5 || $age >= 12){
				$mess = validationMsg('Your Age is not okay for our school', 'warning' ) ;
			}else{

				$conn -> query("INSERT INTO students (name, email, cell, uname, age, gender, shift, location, photo) VALUES ('$name','$email','$cell','$uname','$age','$gender','$shift','$location', '$unique_file_name')");

				move_uploaded_file($file_tmp_name, 'photo/students/' . $unique_file_name);

				$mess = validationMsg('Data Stable', 'success') ;

			}

		}
	
	
	?>
	

	<div class="wrap shadow">
	
		<a class="btn btn-sm btn-primary" href="students.php">All Students</a>

		<div class="card">
			<div class="card-body">
				<h2>Add Student</h2>
				<?php

					if (isset($mess)){
						echo $mess;
					}

				?>
				<form action="" method='POST' enctype='multipart/form-data'>

					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control"  name="name" type="text">
					</div>
					
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control"  name="email" type="email">
					</div>

					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" name="cell" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" name="uname" type="text">
					</div>

					<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" name="age" type="text">
					</div>

					<div class="form-group">
						<label for="">Gender</label><br>
						<input checked value="male"  name="gender" type="radio" id="male"><label for="male">Male</label>
						<input value="female"  name="gender" type="radio" id="female"><label for="female">Female</label>
					</div>

				
					<div class="form-group">
						<label for="">Shift</label>
						<select name="shift" id="">
							<option value="">-Selectt-</option>
							<option value="Morning">-Morning-</option>
							<option value="Evening">-Evening-</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">Location</label>
						<select name="location" id="">
							<option value="">-Select-</option>
							<option value="Dhaka">-Dhaka-</option>
							<option value="Rajshahi">-Rajshahi-</option>
							<option value="Chittagong">-Chittagong-</option>
							<option value="Kumilla">-Kumilla-</option>
							<option value="Barisal">-Barisal-</option>
							<option value="Sylhet">-Sylhet-</option>
							<option value="Rongpur">-Rongpur-</option>
							<option value="Dinajpur">-Dinajpur-</option>
							<option value="Khulna">-Khulna-</option>
							<option value="Mymensingh">-Mymensingh-</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">Photo</label>
						<input class="form-control-file" name="photo" type="file">
					</div>

					<div class="form-group">
						<input name='add' class="btn btn-primary" type="submit" value="Add new student">
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