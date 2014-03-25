<?php
session_start();
$title="Login";
include './includes/header.php';

if($_POST){
$username= trim($_POST['username']);
$password= trim($_POST['password']);
 $username_esc= mysqli_real_escape_string($db,$username);
 $password_esc= mysqli_real_escape_string($db,$password);
if(!empty($_POST['username'])&&!empty($_POST['password'])){
$username=$_POST['username'];
$password=$_POST['password'];

$q=mysqli_query($db, "SELECT * FROM users WHERE username='$username_esc' && password='$password_esc'");//проверка съществува ли такъв потребител в базата данни
if(mysqli_num_rows($q)>0) {
echo "Hello, $username!"; 
}
else
{
echo "You shall not pass.";
}
}
}

?>

<a href="login.php">Login</a>
<a href="registration.php">Registration</a>
<a href="index.php">Book list</a>


<form method="post" action="login.php">
<div>Type your username:<input type="text" name="username"></div>
<div>Type your password:<input type="password" name="password"></div>
<input type="submit" value="Sign in">
</form>


<?php
include './includes/footer.php';
?>
