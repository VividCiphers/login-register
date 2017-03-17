<?php
session_start();
require_once 'db.php'; 
if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
} 
$query = $DBcon->query("SELECT * FROM vivid WHERE id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close(); 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>
</head>
<body>
<div style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    <p>Welcome <?php echo $userRow['username']; ?></p>
    <p><a href="login.php?logout">Logout</a></p>
</div> 
</body>
</html>