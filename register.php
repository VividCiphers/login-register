<?php session_start();
require_once 'db.php';
	if (isset($_SESSION['userSession'])!="") {
 header("Location: home.php");
}
	if(isset($_POST['btn-signup'])) {
 
 $uname = strip_tags($_POST['username']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);
 
 $uname = $DBcon->real_escape_string($uname);
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($upass);
 
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
 
 $check_email = $DBcon->query("SELECT email FROM vivid WHERE email='$email'");
 $count=$check_email->num_rows;
 
 if ($count==0) {
  $query = "INSERT INTO vivid(username,email,password) VALUES('$uname','$email','$hashed_password')";
  if ($DBcon->query($query)) {
   $msg = "successfully registered!";
  }else {
   $msg = "error while registering!";
  }
 } else {
  $msg = "sorry email already taken!";
 }
 $DBcon->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register/title>
</head>
<body> 
<div> 
 <div> 
       <form method="post"> 
        <h2>Sign Up</h2><hr /> 
        <?php
  if (isset($msg)) {
   echo $msg;
  }
  ?> 
        <div class="form-group">
        <input type="text" placeholder="Username" name="username" required  />
        </div> 
        <div>
        <input type="email" placeholder="Email address" name="email" required  />
        <span id="check-e"></span>
        </div> 
        <div>
        <input type="password" placeholder="Password" name="password" required  />
        </div> 
      <hr /> 
        <div>
            <button type="submit" name="btn-signup"> Create Account
   </button> 
            <a href="index.php" style="float:right;">Log In Here</a>
        </div>  
      </form>  
    </div> 
</div> 
</body>
</html>