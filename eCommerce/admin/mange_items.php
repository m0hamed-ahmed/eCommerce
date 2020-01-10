<?php

    if (!$_SESSION['username']) {
        
        header("location: login.php");
        
    }

    $stmt = $conn->prepare("SELECT I.*, C.category_name, U.user_name FROM items I INNER JOIN categories C ON I.category_id = C.category_id INNER JOIN users U ON I.member_id = U.user_id ORDER BY item_id");
    $stmt->execute();
    $items = $stmt->fetchAll();

?>
<div class="container">
    <div class="row">
        <?php if(!empty($items)) { ?>
        <h1 class="text-center">Mange Items</h1>
        <div class="table-responsive">
            <table class="table table-bordered text-center mange-table">
                <tr>
                    <td>#ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Date</td>
                    <td>Country Made</td>
                    <td>Category</td>
                    <td>Member</td>
                    <td>Control</td>
                </tr>
                <?php
                
                    foreach($items as $item) {
                ?>
                <tr>
                    <td><?php echo $item['item_id'] ?></td>
                    <td><?php echo $item['item_name'] ?></td>
                    <td><?php echo $item['description'] ?></td>
                    <td><?php echo $item['price'] ?></td>
                    <td><?php echo $item['date'] ?></td>
                    <td><?php echo $item['country_made'] ?></td>
                    <td><?php echo $item['category_name'] ?></td>
                    <td><?php echo $item['user_name'] ?></td>
                    <td>
                        <a href="?do=edit&itemid=<?php echo $item['item_id'] ?>" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                        <a href="?do=delete&itemid=<?php echo $item['item_id'] ?>" class="btn btn-danger confirm"><i class="fa fa-close"></i>Delete</a>
                        <?php if($item['approve'] == 0 ) { ?>
                            <a href="?do=approve&itemid=<?php echo $item['item_id'] ?>" class="btn btn-info"><i class="fa fa-check"></i>Approve</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <a href='?do=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Item</a>
        <?php } else {
                    echo "<div class='tbl-empty'>Empty</div>";
                    echo "<a href='?do=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Item</a>";
                } 
        ?>
    </div>
</div>