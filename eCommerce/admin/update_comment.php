<?php

    if(!isset($_SESSION['username'])) {

        header("location: login.php");

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $commentid = $_POST['commentid'];
        $comment   = $_POST['comment'];

        echo "<h1 class='text-center'>Upadte Comment</h1>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        
        if (empty($comment)) {
            
            
            $msg =  "<div class='alert alert-danger'>Comment Can't Be Empty</div>";
            
            redirectHome ($msg, "comments.php?do=edit&commentid=$commentid", 1);
            
        } else {
            
            $stmt = $conn->prepare("UPDATE comments SET comment = ? WHERE comment_id = ?");
            $stmt->execute(array($comment, $commentid));

            $msg =  "<div class='alert alert-success'>". $stmt->rowCount() ." Row Updated</div>"; 
            
            redirectHome ($msg, 'comments.php' , 1);
            
        }
        
    echo "</div>";
echo "</div>";

    } else {

        $msg =  "<div class='alert alert-danger'>Sorry, You Cant Browse This Page Directly</div>";
            
        redirectHome ($msg, 'index.php');
    }

?>