<?php
	include("application/functions.php");
	$username = $_GET['username'];
	$type = $_GET['type'];
	$result = $db->query("SELECT * FROM accounts WHERE username = '$username'");
	$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#permit-table {
		    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		}

		#permit-table td, #permit-table th {
		    border: 1px solid #ddd;
		    padding: 8px;
		}

		#permit-table tr:nth-child(even){background-color: #f2f2f2;}

		#permit-table tr:hover {background-color: #ddd;}
		
		#permit-table th {
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: center;
		    background-color: #4CAF50;
		    color: white;
		}
		
		#user-table {
		    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		}

		#user-table td, #user-table th {
		    border: 1px solid #ddd;
		    padding: 8px;
		}

		#user-table tr:nth-child(even){background-color: #f2f2f2;}

		#user-table tr:hover {background-color: #ddd;}
		
		#user-table th {
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: center;
		    background-color: #AAAAFF;
		    color: white;
		}
		button {
		    background-color: #4CAF50; /* Green */
		    border: none;
		    color: white;
		    padding: 10px 16px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 14px;
		    margin-bottom: 10px;
			cursor: pointer;
		}
		button:hover{
			box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
		}
		button#red-btn {
		    background-color: red; /* Green */
		    border: none;
		    color: white;
		    padding: 10px 16px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 14px;
		    margin-bottom: 10px;
			cursor: pointer;
		}
		button#red-btn:hover{
			box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
		}
		button#blue-btn {
		    background-color: #55A; /* Green */
		    border: none;
		    color: white;
		    padding: 10px 16px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 14px;
		    margin-bottom: 10px;
			cursor: pointer;
		}
		button#blue-btn:hover{
			box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
		}
		body {font-family: Arial, Helvetica, sans-serif;}

		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			padding-top: 100px; /* Location of the box */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
			background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}

		/* Modal Content */
		.modal-content {
			position: relative;
			background-color: #fefefe;
			margin: auto;
			padding: 0;
			border: 1px solid #888;
			width: 80%;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
			-webkit-animation-name: animatetop;
			-webkit-animation-duration: 0.4s;
			animation-name: animatetop;
			animation-duration: 0.4s
		}

		/* Add Animation */
		@-webkit-keyframes animatetop {
			from {top:-300px; opacity:0} 
			to {top:0; opacity:1}
		}

		@keyframes animatetop {
			from {top:-300px; opacity:0}
			to {top:0; opacity:1}
		}

		/* The Close Button */
		.close {
			color: white;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: #000;
			text-decoration: none;
			cursor: pointer;
		}

		.modal-header {
			padding: 2px 16px;
			background-color: #5cb85c;
			color: white;
		}

		.modal-body {padding: 2px 16px;}

		.modal-footer {
			padding: 2px 16px;
			color: white;
		}
		input[type=text], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		div {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}
	</style>
</head>
<body>
	<section id="profile">
		<p> Name: <?php echo $data['lastname'].", ".$data['middlename']." ".$data['firstname']; ?> </p>
		<p> Type: <?php if($type == 'SU') echo "Super Admin"; else if($type == 'OU') echo "Organizational Admin"; else echo "Standard User"; ?> </p>
		<form action="application/logout.php" method="post">
			<button type="submit"> Logout </button>
		</form>
	</section>
	<section>
		<button type="button" id="records-btn" onclick="showhide(this)"> Show Records </button>
		<button type="button" id="myBtn" onclick="showModal()">Add Record</button>
		<?php if($type == 'SU') echo "<button type='button' id='user-btn' onclick='getUsers(this)'> Show Users </button>"; ?>

		<!-- The Modal -->
		<div id="add-modal" class="modal">

		<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="close" onclick="spanClose()">&times;</span>
					<h2>Permit</h2>
				</div>
				<div class="modal-body">
					<input type="text" placeholder="Permit" id="msg">
				</div>
					<div class="modal-footer">
					<button type="button" onclick="addRecords()"> Add Permit </button>
				</div>
			</div>

		</div>
		<div id="edit-modal" class="modal">

		<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="close" onclick="editClose()">&times;</span>
					<h2>Permit No: <span id="edit-number"> </span></h2>
				</div>
				<div class="modal-body">
					<input type="text" id="edit-msg">
				</div>
					<div class="modal-footer">
					<button type="button" onclick="editRecords()"> Edit Permit </button>
				</div>
			</div>

		</div>
	</section>
	<section id="permit" class="hide"></section>
	<section id="users" class="hide"></section>
	<script type="text/javascript">
		function getUsers(x){
			var section = document.getElementById('permit');
			var users = document.getElementById('users');
			if(section.className == "hide"){
				console.log( section.className );
				if(users.className == "show"){
					x.innerHTML = "Show Users";
					users.className = "hide";
					users.innerHTML = "";
				}else if(users.className == "hide"){
					x.innerHTML = "Hide Users";
					users.className = "show";
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							users.innerHTML += this.responseText;
						}
					};
					xmlhttp.open("POST", "application/getUsers.php", true);
					xmlhttp.send();
				}
			}
		}
		function showhide(x){
			var section = document.getElementById('permit');
			var users = document.getElementById('users');
			if(users.className == "hide"){
				if(section.className == "show"){
					x.innerHTML = "Show Records";
					section.className = "hide";
					section.innerHTML = "";
				}else if(section.className == "hide"){
					x.innerHTML = "Hide Records";
					section.className = "show";
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							section.innerHTML += this.responseText;
						}
					};
					xmlhttp.open("POST", "application/getRecords.php", true);
					xmlhttp.send();
				}
			}
		}
		function addRecords(){
			var username = "<?php echo $username; ?>";
			var type = "<?php echo $type; ?>";
			var msg = document.getElementById("msg").value;
			var d = { "username":username, "type":type, "msg":msg };
			var data = JSON.stringify(d);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					spanClose();
					console.log(this.responseText);
				}
			};
			xmlhttp.open("POST", "application/addRecord.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("x=" + data);
		}
		function showModal(){
			// Get the modal
			var modal = document.getElementById('add-modal');

			if(modal.style.display = 'none')
				modal.style.display = "block";
			else
				modal.style.display = "none";
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		}
		function spanClose(){
			var modal = document.getElementById('add-modal');
			modal.style.display = "none";
		}
		function permitDemand(x, id){
			var section = document.getElementById('permit');
			var button = document.getElementById("records-btn");
			var data = "";
			if(x.className == 'accept'){
				var d = { "permission":"accepted", "id": id };
				section.className = "hide";
				button.innerHTML = "Show Records";
				data = JSON.stringify(d);
			}else{
				var d = { "permission":"rejected", "id": id };
				section.className = "hide";
				button.innerHTML = "Show Records";
				data = JSON.stringify(d);
			}
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("permit").innerHTML = "";
				}
			};
			xmlhttp.open("POST", "application/permitRecord.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("x=" + data);
		}
		function showEdit(x, id){
			// Get the modal
			document.getElementById('edit-number').innerHTML = id;
			document.getElementById('edit-msg').value = x.className;
			var modal = document.getElementById('edit-modal');
			
			if(modal.style.display = 'none')
				modal.style.display = "block";
			else
				modal.style.display = "none";
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		}
		function editClose(){
			var modal = document.getElementById('edit-modal');
			modal.style.display = "none";
		}
		function editRecords(){
			var permitno = document.getElementById('edit-number').innerHTML;
			var msg = document.getElementById('edit-msg').value;
			var d = { "no":permitno, "msg":msg };
			var data = JSON.stringify(d);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById('permit').className = "hide";
					document.getElementById("records-btn").innerHTML = "Show Records";
					document.getElementById("permit").innerHTML = "";
					editClose();
				}
			};
			xmlhttp.open("POST", "application/editRecord.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("x=" + data);
		}
		function deleteRecord(id){
			var d = { "no": id };
			var data = JSON.stringify(d);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById('permit').className = "hide";
					document.getElementById("records-btn").innerHTML = "Show Records";
					document.getElementById("permit").innerHTML = "";
				}
			};
			xmlhttp.open("POST", "application/deleteRecord.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("x=" + data);
		}
		function onSelect(x){
			var username = x.className;
			var type = x.value;
			var users = document.getElementById('users');
			var d = { "username":username, "type": type };
			var data = JSON.stringify(d);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById('user-btn').innerHTML = "Show Users";
					users.innerHTML = "";
					users.className = "hide";
					console.log(this.responseText);
				}
			};
			xmlhttp.open("POST", "application/updateUsers.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("d=" + data);
		}
	</script>
</body>
</html>