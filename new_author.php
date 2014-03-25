<?php $title="New Authors";
include './includes/header.php';

?>

<a href="index.php">Book list</a>
<a href="login.php">Login</a>
<a href="registration.php">Registration</a>

<form method="post" action="new_author.php">
Author:<input type="text" name="author_name"/><br>
<input type="submit" value="Insert"/>
</form>

<?php
if($_POST) {
 $author_name= trim($_POST['author_name']);
 if(mb_strlen($author_name)<2) {
 echo "Invalid name";
 }
 else {
 $author_esc= mysqli_real_escape_string($db,$author_name);
 
 $q= mysqli_query($db,'SELECT * FROM authors WHERE author_name="'.$author_esc.'"');

if(mysqli_num_rows($q)>0) {
echo "We have the same author."; 
}
else{
mysqli_query($db,'INSERT INTO authors(author_name) VALUES("' . $author_esc . '")');

if(mysqli_error($db)) {
echo 'Error.';
}
else { 
echo 'Successful recording.';
}
}
}
}
$authors = getAuthors($db);
if ($authors===false) {
    echo 'Error';
}
?>
<table border="1">
<tr><td>Authors</td></tr>

<?php
foreach($authors as $row){
echo '<tr><td>'.$row['author_name'].'</td></tr>';
}
?>
</table>
<?php
include './includes/footer.php';
?>
