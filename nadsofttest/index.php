<html>
	<head>
		<title>Nadsoft Machine Test</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<style>	.error{	color: red; font-size: 12px; padding: 0 0 0 3px; font-weight: normal; } </style>
	</head>
	<body>
		<?php
			require_once('includes/class-student.php'); // This class file contain the db connection and all other data 
			$student = new class_student();
		?>
		<div class="container">
			<div class="row">
				<h1>Student List</h1>
				<div id="student_table">
					<?php $student->get_student(); // This function will fetch the data from the database and return the listing. ?> 
				</div>
				<div id="popup">
					<?php $student->add_student(); // This function will return the html code of the modal box. ?>
				</div>
				<div id="error_msg" class="error_msg error">
				</div>	
			</div>
		</div>

	</body>
</html>	