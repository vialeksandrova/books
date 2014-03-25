<? $title="New Books";
include './includes/header.php';

?>
<a href="index.php">Book list</a>
<a href="login.php">Login</a>
<a href="registration.php">Registration</a>

<form method="post" action="new_book.php">
Book's name:<input type="text" name="book_name"/><br>
<?php
$authors=getAuthors($db);
if($authors===false) {
echo 'Error.';
}
?>
<div>Author:<select multiple name="authors[]"> <!--authors[] се ползва при предаване на повече данни-->
<?php
foreach($authors as $row) {
echo '<option value="'.$row['author_id'].'">'.$row['author_name'].'</option>';
}
?>
</select></div>
<input type="submit" value="Insert"/>
</form>

<?php
if($_POST) {
   $book_name = trim($_POST['book_name']);
    if(!isset($_POST['authors'])) {
        $_POST['authors'] = '';
    }
    $authors = $_POST['authors'];
    $er = array();
    if(mb_strlen($book_name)<2){
        $er[] ='Invalid name';
    }
    if(!is_array($authors) || count($authors)==0) {
        $er[] = 'Error';
    }
    if(!isAuthorIdExists($db,$authors)) {
        $er[]= 'Invalid author';
    }

    if (count($er)>0) {
        foreach($er as $v) {
            echo '<p>'. $v .'</p>';
        }
    } else {
        mysqli_query($db,'INSERT INTO books(book_title) VALUES("' .
                mysqli_real_escape_string($db, $book_name) . '")');
        if(mysqli_error($db)) {
            echo 'Error';
            exit;
        }
		
        $id = mysqli_insert_id($db);
        foreach ($authors as $authorId) {
            mysqli_query($db, 'INSERT INTO books_authors (book_id,author_id)
                VALUES (' . $id . ',' . $authorId . ')');
            if(mysqli_error($db)) {
                echo 'Error';
				echo mysqli_error($db);
                exit;
            }
        }
        echo 'The book is successful recorded';
        
    }
}
?>

<?php
include './includes/footer.php';
?>


