<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['userSession'])!="") {
 header("Location: home.php");
 exit;
}

if (isset($_POST['btn-login'])) {
 
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);
 
 $email = $DBcon->real_escape_string($email);
 $password = $DBcon->real_escape_string($password);
 
 $query = $DBcon->query("SELECT id, email, password FROM vivid WHERE email='$email'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; // if email/password are correct returns must be 1 row
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['id'];
  header("Location: home.php");
 } else {
  $msg = "Invalid Username or Password!";
 }
 $DBcon->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<body>
      <form method="post">
        <h2>Sign In.</h2><hr />
       <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>    
        <div>
        <input type="email" placeholder="Email address" name="email" required />
        </div>
        <div>
        <input type="password" placeholder="Password" name="password" required />
        </div>
      <hr />
        <div>
            <button type="submit" name="btn-login" id="btn-login">Sign In
            </button> 
            <a href="register.php" style="float:right;">Sign UP Here</a>
        </div>  
      </form>
</div>
</div>
</body>
</html>