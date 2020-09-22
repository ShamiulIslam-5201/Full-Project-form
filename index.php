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


       // echo time(); //its a time function.

		//add student form issetting
		if(isset($_POST['add'])){

		     $name = $_POST['name'];
			 $roll = $_POST['roll'];
			 $email = $_POST['email'];
			 $cell = $_POST['cell'];
			 $uname = $_POST['uname'];
			 $age = $_POST['age'];
			//echo $photo = $_POST['photo'];
			$cell_len = strlen($cell);

			//file upload
             $file_name = $_FILES['photo']['name'];
             $file_type = $_FILES['photo']['type'];
             $file_tmp = $_FILES['photo']['tmp_name'];
             $file_size = $_FILES['photo']['size'];

             $unique_file_name = md5(time() . rand()) . $file_name;

             move_uploaded_file($file_tmp, 'photo/'. $unique_file_name);



			//form validation
			if(empty($name) || empty($roll) || empty($email) || empty($cell) || empty($uname) || empty($age)){
				$mess = '<p class="alert alert-danger">All fields are required <button class="close" data-dismiss="alert">&times</button></p>';		
			}elseif( filter_var( $roll,   FILTER_VALIDATE_INT) == false ){
				$mess = '<p class="alert alert-danger">Invalid roll number!! <button class="close" data-dismiss="alert">&times</button></p>';
			}elseif( filter_var( $email,   FILTER_VALIDATE_EMAIL) == false ){
				$mess = '<p class="alert alert-danger">Envalid email address!! <button class="close" data-dismiss="alert">&times</button></p>';
			}elseif($cell_len != 11){
				$mess = '<p class="alert alert-danger">Incorrect Phone number!! <button class="close" data-dismiss="alert">&times</button></p>';
			}elseif($age < 18 || $age >30){
				$mess = '<p class="alert alert-danger">Invalid age!! <button class="close" data-dismiss="alert">&times</button></p>';
			}else{
                $mess = '<p class="alert alert-success">Data stable!! <button class="close" data-dismiss="alert">&times</button></p>';
            }

		}
	
	
	?>
	

	<div class="wrap shadow">
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
						<label for="">Gender</label><br>
						<input class=""  name="gender" type="radio" id="male"><label for="male">Male</label>
						<input class=""  name="gender" type="radio" id="female"><label for="female">Male</label>
					</div>

					<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" name="age" type="text">
					</div>

					<div class="form-group">
						<label for="">Location</label>
						<select name="" id="">
							<option value="">-Select-</option>
							<option value="">-Dhaka-</option>
							<option value="">-Rajshahi-</option>
							<option value="">-Chittagong-</option>
							<option value="">-Kumilla-</option>
							<option value="">-Barisal-</option>
							<option value="">-Sylhet-</option>
							<option value="">-Rongpur-</option>
							<option value="">-Dinajpur-</option>
							<option value="">-Khulna-</option>
							<option value="">-Mymensingh-</option>
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