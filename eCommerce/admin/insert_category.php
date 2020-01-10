<?php

    if(!isset($_SESSION['username'])) {

        header("location: login.php");

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name        = $_POST['name'];
        $description = $_POST['description'];
        $ordering    = $_POST['ordering'];
        $parent      = $_POST['parent'];
        $visibility  = $_POST['visibility'];
        $comment     = $_POST['comment'];
        $ads         = $_POST['ads'];

        echo "<h1 class='text-center'>Inserted Category</h1>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        
        if (empty($name)) {

            $msg =  "<div class='alert alert-danger'>Category Name Can't Be Empty</div>";

            redirectHome ($msg, 'categories.php?do=add', 1);

        } else {

            $count =  checkItem('category_name', 'categories', 'category_name', $name);

            if($count > 0)
            {

                $msg =  '<div class="alert alert-danger">Sorry, This Users Name Already Found</div>';

                redirectHome ($msg, 'members.php?do=add', 1);

            } else {

                $stmt = $conn->prepare("INSERT INTO categories(category_name, description, ordering, parent, visibility, allow_comment, allow_ads) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($name, $description, $ordering, $parent, $visibility, $comment, $ads));

                $msg = "<div class='alert alert-success'>". $stmt->rowCount() ." Row Inserted</div>";

                redirectHome ($msg, 'categories.php', 1);

                }
            }

            echo "</div>";
        echo "</div>";

    } else {
        
        $msg =  "<div class='alert alert-danger'>Sorry, You Cant Browse This Page Directly</div>";
        
        redirectHome ($msg, 'index.php', 1);
    }

?>