<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    $count =  checkItem('item_name', 'items', 'item_id', $id);

    if($count > 0) {
        
        $stmt = $conn->prepare("DELETE FROM items WHERE item_id = $id ");
        $stmt->execute();
?>

        <h1 class="text-center">Deleted Item</h1>
        <div class="container">
            <div class="row">
                <div class='alert alert-success'><?php echo $stmt->rowCount() ?> Row Deleted</div>
                <?php redirectHome ('', 'items.php', 1) ?>
            </div>
        </div>
        
<?php
            
    } else {
        
        $msg =  "<div class='alert alert-danger'>This Id Not Exists</div>";
        
        redirectHome ($msg, 'index.php', 1);       
        
    }


?>