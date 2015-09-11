$(document).ready(function(){
	$('#myModal').on('shown.bs.modal', function () {
		$('#studentName').focus()
	});
	
	$( "#add_student" ).click(function() {
		$("#add_student_form").valid();

	});

	$('#add_student_form').validate({
		rules: {
			studentName: "required",
			studentEmail: {
			  required: true,
			  email: true
			},
			studentPhone: {
			  required: true,
			  number: true,
			  minlength: 10
			},
			studentMarks: {
			  required: true,
			  number: true,
			  maxlength: 2
			},
		},
		messages: {
			studentName: "Entere the Name",
			studentEmail: {
			  required: "Enter the email",
			  email: "Email address must be in the format of name@domain.com"
			},
			studentPhone: {
			  required: "Enter the Phone Number",
			  number: "Phone must be in Numric Format"
			},
			studentMarks: {
			  required: "Enter the Marks",
			  number: "Marks must be in Numeric Format"
			},
		}
	});
	
	
	$('#add_student').on('click', function(e){
		
		e.preventDefault();
		
		if( $('#studentName').val() != '' && $('#studentEmail').val() != '' && $('#studentPhone').val() != '' && $('#studentMarks').val() != '' ){

			$.ajax({
			url: 'includes/class-student.php',
			method: 'post',
			data: {
				'studentName': $('#studentName').val(),
				'studentEmail': $('#studentEmail').val(),
				'studentPhone': $('#studentPhone').val(),
				'studentMarks': $('#studentMarks').val(),
				'insert_student': "true"
			}
			})
			.done(function( data ) {
				
				if(data=='success'){
					var trdata;
					var cnt = $("#countno").val();
					$('#myModal').modal('hide');
					trdata = "<tr><td>"+cnt+"</td><td>"+$('#studentName').val()+"</td><td>"+$('#studentEmail').val()+"</td><td>"+$('#studentPhone').val()+"</td><td>"+$('#studentMarks').val()+"</td></tr>";
					$('#student_table .table').append(trdata);
					$('#add_student_form').find("input[type=text], input[type=email]").val("");
					$("#countno").val(parseInt(cnt)+1);
					$("#error_msg").val("");
				}else{
					$("#error_msg").val("Data Not Saved.");
				}
			});
		}
		
	});
});