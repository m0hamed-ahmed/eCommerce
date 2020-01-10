<?php

    if(!isset($_SESSION['username'])) {

        header("location: login.php");

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cat_id      = $_POST['cat_id'];
        $name        = $_POST['name'];
        $description = $_POST['description'];
        $ordering    = $_POST['ordering'];
        $parent      = $_POST['parent'];
        $visibility  = $_POST['visibility'];
        $comment     = $_POST['comment'];
        $ads         = $_POST['ads'];
        
        
        if (empty($name)) {
            
            $msg = '<div class="alert alert-danger">Name Can\'t Be Empty</div>';
            
            redirectHome ($msg, "categories.php?do=edit&userid=$cat_id");
            
        } else {
            
            echo "<h1 class='text-center'>Upadte Member</h1>";
            echo "<div class='container'>";
            echo "<div class='row'>";
            
            $stmt = $conn->prepare("UPDATE categories SET category_name = ?, description = ?, ordering = ?, parent = ?, visibility = ?, allow_comment = ?, allow_ads = ? WHERE category_id = ?");
            $stmt->execute(array($name, $description, $ordering, $parent, $visibility, $comment, $ads, $cat_id));

            $msg =  "<div class='alert alert-success'>". $stmt->rowCount() ." Row Updated</div>"; 
            
            redirectHome ($msg, 'categories.php', 1);
            
        }
        

    } else {

        $msg =  "<div class='alert alert-danger'>Sorry, You Cant Browse This Page Directly</div>";
            
        redirectHome ($msg, 'index.php', 1);
    }

?>
        
    </div>
</div>