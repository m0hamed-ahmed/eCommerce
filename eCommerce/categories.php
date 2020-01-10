<?php 
    
    session_start();
    $pageTitle = 'Category';
    include 'init.php';

    $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? $_GET['catid'] : 0;

    $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");

    $stmt->execute(array($catid));

    $count = $stmt->rowCount();

    if($count > 0) {

    $cat = $stmt->fetch();
?>

<setion>
    <div class="container">
        <div class="row">
            <h1 class="text-center"><?php echo $cat['category_name'] ?></h1>
            <?php
                $items = getAll("*", "items", "where category_id = $catid", "and approve = 1", "item_id");
                foreach($items as $item) {
            ?>
            <div class="col-sm-6 col-md-3">
                <div class="item-box thumbnail">
                    <div>
                        <img src="item.png" class="img-responsive">
                    </div>
                    <div class="info">
                        <p class='price'><?php echo $item['price'] ?></p>
                        <h3><a href="items.php?itemid=<?php echo $item['item_id'] ?>"><?php echo $item['item_name'] ?></a></h3>
                        <p><?php echo $item['description'] ?></p>
                        <p class=date><?php echo $item['date'] ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</setion>

<?php
    } else {
        echo "<div class='alert alert-danger'>This Is Not ID</div>";
    }
    include $tmbl . 'footer.php';
?>