<?php

    if(!isset($_SESSION['username'])) {
        
        header("location: login.php");
        
    }

    $order = "ASC";

    $order_array = array('ASC', 'DESC');

    if(isset($_GET['order']) && in_array($_GET['order'], $order_array))

        $order = $_GET['order'];

    $categories = getAll("*", "categories", "where parent = 0", "", "ordering", "$order");
?>
<div class="container cats">
    <div class="row">
    <?php if(!empty($categories)) {  ?>
    <h1 class="text-center">Mange Categories</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><i class="fa fa-edit"></i> Our Categories</strong>
                <div class="ordering">
                    <span>Ordering: </span> [
                    <a href="?order=ASC" class="<?php if($order == 'ASC') {echo 'active';} ?>">Asc</a> |
                    <a href="?order=DESC" class="<?php if($order == 'DESC') {echo 'active';} ?>">Desc</a> ]
                </div>
            </div>
            <div class="panel-body">
                <?php

                foreach($categories as $cat) {
                        
                ?>
                <div class="cat">
                    <div class="btn-action">
                        <a href="?do=edit&userid=<?php echo $cat['category_id'] ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="?do=delete&userid=<?php echo $cat['category_id'] ?>" class="btn btn-danger confirm"><i class="fa fa-close"></i> Delete</a>
                    </div>
                    <h3><?php echo $cat['category_name'] ?></h3>
                    <p><?php if($cat['description'] == '') {echo "This Category Has No Description";} ?></p>
                    <?php if($cat['visibility'] == 1) {echo "<span class='visibility'><i class='fa fa-eye'></i> Hidden</span>";} ?>
                    <?php if($cat['allow_comment'] == 1) {echo "<span class='commenting'><i class='fa fa-close'></i> Commented Disabled</span>";} ?>
                    <?php if($cat['allow_ads'] == 1) {echo "<span class='ads'><i class='fa fa-close'></i> Ads Disabled</span>";} ?>
                    
                    <?php
                        $parent = $cat['category_id'];
                        $childCats = getAll("*", "categories", "where parent = $parent", "", "category_id", "ASC"); 
                        if (!empty($childCats)) { 
                    ?>
                        <div class="child-category">
                            <h4>Child Category</h4>
                            <ul class="list-unstyled">
                                <?php
                                    foreach ($childCats as $childCat) {
                                        echo "<li>" . $childCat['category_name'];
                                            echo "<a href='?do=edit&userid=".$childCat['category_id']."'> Edit </a>";
                                            echo "<a href='?do=delete&userid=".$childCat['category_id']."'>Delete</a>";
                                        echo "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                
                <?php } ?>
            </div>
        </div>
        <a href='?do=add' class='btn btn-primary add_cat'><i class='fa fa-plus'></i> Add New Category</a>
        <?php } else {
                    echo "<div class='tbl-empty'>Empty</div>";
                    echo "<a href='?do=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Category</a>";
                } 
        ?>
    </div>
</div>