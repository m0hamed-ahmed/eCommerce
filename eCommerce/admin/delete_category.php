<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    $count =  checkItem('category_name', 'categories', 'category_id', $id);

    if($count > 0) {
        
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = $id ");
        $stmt->execute();
?>

        <h1 class="text-center">Deleted category</h1>
        <div class="container">
            <div class="row">
                <div class='alert alert-success'><?php echo $stmt->rowCount() ?> Row Deleted</div>
                <?php redirectHome ('', 'categories.php', 1) ?>
            </div>
        </div>
        
<?php
            
    } else {
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);        
        
    }


?>