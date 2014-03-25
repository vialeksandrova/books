<?php
$title="Registration";
include './includes/header.php';
?>
<a href="login.php">Login</a>
<a href="registration.php">Registration</a>
<a href="index.php">Book list</a>

<form method="post" action="registration.php">
<div>Username:<input type="text" name="username"></div>
<div>Password:<input type="password" name="password"></div>
<input type="submit" value="Register">
</form>
<?php
if($_POST){
$username= trim($_POST['username']);
$password= trim($_POST['password']);
 $username_esc= mysqli_real_escape_string($db,$username);
 $password_esc= mysqli_real_escape_string($db,$password);
 $q=mysqli_query($db, "SELECT * FROM users WHERE username='$username_esc'");
if(mysqli_num_rows($q)>0) {
echo "Username is not available";
}
elseif (mb_strlen($username)<3||mb_strlen($password)<3) {
echo "Invalid username or password";
}
else{
$q=mysqli_query($db, "INSERT INTO users(username, password) VALUES ('$username_esc','$password_esc')");
if(mysqli_error($db)) {
echo 'Error';
echo mysqli_error($db);
}
else{
echo "Successful registration";
}
}
}
?>

<?php
include './includes/footer.php';
?>

