<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		button.submit-btn {
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
			float:left;
		}
		button.submit-btn:hover{
			background-color: orange;
		}
		button.open-btn{
			float:left;
			margin-top: 12px;
			border-style:none;
			background-color: transparent;
			cursor: pointer;
		}
		button.open-btn:hover{
			color: lightblue;
		}
		form{
			width: 20%;
			display: inline-block;
		}
		input, select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		div.hide{
			display:none;
		}
		div.show{
			display:block;
		}
	</style>
</head>
<body>
	<div class="show" id="login-form">
		<form style="margin-bottom: 20px;">
			<label for="username"> Username </label>
			<input type="text" id="login-username" placeholder="username">
			<label for="password"> Password </label>
			<input type="password" id="login-password" placeholder="password">
			<button class="submit-btn" type="button" onclick="login()"> Login </button>
			<p style="float:left; margin-left: 10px; font-size: 1vw;"> Not Registered? </p>
			<button class="open-btn" type="button" onclick="changePage()"> Click Here </button>
		</form>
	</div>
	
	<div class="hide" id="register-form">
		<form style="margin-bottom: 20px;">
			<label for="username"> Username </label>
			<input type="text" id="reg-username" placeholder="username">
			<label for="password"> Password </label>
			<input type="password" id="reg-password" placeholder="password">
			<label for="username"> firstname </label>
			<input type="text" id="reg-firstname" placeholder="firstname">
			<label for="username"> Middlename </label>
			<input type="text" id="reg-middlename" placeholder="middlename">
			<label for="username"> Lastname </label>
			<input type="text" id="reg-lastname" placeholder="lastname">
			<button class="submit-btn" type="button" onclick="doRegister()"> Register </button>
			<p style="float:left; margin-left: 10px; font-size: 1vw;"> Want to Login? </p>
			<button class="open-btn" type="button" onclick="changePage()"> Click Here </button>
		</form>
	</div>
	
	<script type="text/javascript">
		function login(){
			var username = document.getElementById("login-username").value;
			var password = document.getElementById("login-password").value;
			var d = { "username": username, "password": password };
			var data = JSON.stringify(d);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			        myObj = JSON.parse(this.responseText);
			        window.location = "home.php?username=" + myObj['username'] + "&type=" + myObj['type'];
			    }
			};
			xmlhttp.open("POST", "application/login.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("d=" + data);
		}
		function changePage(){
			var loginform = document.getElementById("login-form");
			var regform = document.getElementById("register-form");
			if(loginform.className == "show"){
				loginform.className = "hide";
				regform.className = "show";
			}else{
				loginform.className = "show";
				regform.className = "hide";
			}
		}
		function doRegister(){
			var username = document.getElementById("reg-username").value;
			var password = document.getElementById("reg-password").value;
			var firstname = document.getElementById("reg-firstname").value;
			var middlename = document.getElementById("reg-middlename").value;
			var lastname = document.getElementById("reg-lastname").value;
			var d = { "username": username, "password": password, "firstname": firstname, "middlename":middlename, "lastname": lastname };
			var data = JSON.stringify(d);
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			        if(this.responseText == "success"){
						document.getElementById("login-form").className = "show";
						document.getElementById("register-form").className = "hide";
					}else{
						console.log(this.responseText);
					}
			    }
			};
			xmlhttp.open("POST", "application/register.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("d=" + data);
		}
	</script>
</body>
</html>