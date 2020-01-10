<?php 

    session_start();
    $pageTitle = 'Homepage';
    include 'init.php';
?>

<div class="container">
    <div class="row">
        <h1 class="text-center">All Items</h1>
        <?php
            $items = getAll("*", "items", "where approve = 1", "", "item_id", "DESC");
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

<?php include $tmbl . 'footer.php'; ?>