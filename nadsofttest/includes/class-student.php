<?php

	class class_student{
		private $user;
		private $password;
		private $dbh;
		
		public function __construct(){
			$this->user = 'root';
			$this->password = '';
			$this->dbh = new PDO('mysql:host=localhost;dbname=nadsofttest_db', $this->user, $this->password);
		}
		
		public function insert_student(array $data){
			
			$sql = "INSERT INTO student(name,email,phone,marks) VALUES (:studentName, :studentEmail, :studentPhone, :studentMarks)";
													  
			$stmt = $this->dbh->prepare($sql);

			$stmt->bindParam(':studentName', $data['studentName'], PDO::PARAM_STR);
			$stmt->bindParam(':studentEmail', $data['studentEmail'], PDO::PARAM_STR);
			$stmt->bindParam(':studentPhone', $data['studentPhone'], PDO::PARAM_STR);
			$stmt->bindParam(':studentMarks', $data['studentMarks'], PDO::PARAM_STR);

			if($stmt->execute()){
				echo "success";
			}else{
				echo "fail";
			}

		}
		
		public function get_student(){

			$sql = "SELECT * FROM student";
													  
			$records = $this->dbh->query($sql);
			
			$table = '<table class="table table-bordered">';
			$table .= '<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Marks</th>
					</tr></thead>';
			$table .= '<tbody>';
			
			$i = 1;
			foreach($records as $row){
				$table .= "<tr>
						<td>{$i}</td>
						<td>{$row['name']}</td>
						<td>{$row['email']}</td>
						<td>{$row['phone']}</td>
						<td>{$row['marks']}</td>
					  </tr>";
					  $i++;
			}
			
			$table .= '</tbody>';
			$table .= '</table>';
			
			$table .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Student</button>
					   <input type="hidden" name="countno" id="countno" value="'.$i.'">';
	
			echo $table;

		}
		
		public function add_student(){
			$add_student = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Add Student</h4>
								  </div>
								  <div class="modal-body">
									<form id="add_student_form" method="post">
									  <div class="form-group">
										<label for="studentName">Name</label>
										<input type="text" class="form-control" id="studentName" name="studentName" autofocus>
									  </div>
									  <div class="form-group">
										<label for="studentEmail">Email</label>
										<input type="email" class="form-control" id="studentEmail" name="studentEmail">
									  </div>
									  <div class="form-group">
										<label for="studentPhone">Phone</label>
										<input type="text" class="form-control" id="studentPhone" name="studentPhone">
									  </div>
									  <div class="form-group">
										<label for="studentMarks">Marks</label>
										<input type="text" class="form-control" id="studentMarks" name="studentMarks">
									  </div>
									
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" id="add_student" class="btn btn-primary">Save changes</button>
								  </div>
								  </form>
								</div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div>';
							
			echo $add_student;
		}
	}

	$data = array_filter($_POST);

	if(isset($data['insert_student']) && !empty($data['insert_student'])){
		if(!empty($data)){
			require_once('class-student.php');
			$addstudent = new class_student();
			$addstudent->insert_student($data);
		}
	}