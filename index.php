
<? 
$title="Book list";
include './includes/header.php';

?>
<a href="new_book.php">New book</a>
<a href="new_author.php">New author</a>
<a href="login.php">Login</a>
<a href="registration.php">Registration</a>


<?php
if(isset($_GET['author_id'])){//когато кликнем на определен линк с дадено id предадено с get
$author_id=(int)$_GET['author_id'];
$q= mysqli_query($db, 'SELECT * FROM books_authors as ba INNER JOIN books as b ON ba.book_id=b.book_id 
	INNER JOIN books_authors as bba ON bba.book_id=ba.book_id
	INNER JOIN authors as a ON bba.author_id=a.author_id
	WHERE ba.author_id='.$author_id);
}
else{//всичката информация, която виждаме, ако не сме кликнали на даден линк
$q= mysqli_query($db,'SELECT * FROM books as b INNER JOIN books_authors as ba ON b.book_id=ba.book_id INNER JOIN authors as a ON a.author_id=ba.author_id');
}
$result=array();
while($row=mysqli_fetch_assoc($q)) {
$result[$row['book_id']]['book_title']=$row['book_title'];
$result[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
}
echo '<table border="1">';
echo '<tr><td>Book</td><td>Authors</td></tr>';
foreach($result as $row){

echo '<tr><td>'.$row['book_title'].'</td><td>';
$ar=array();
foreach ($row['authors'] as $k=>$va){
$ar[]='<a href="index.php?author_id='.$k.'">'.$va.'</a>';
}
echo implode(',',$ar).'</td></tr>';
}


echo '</table>';
?>


<?php
include './includes/footer.php';
?>

