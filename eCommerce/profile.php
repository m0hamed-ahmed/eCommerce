<?php 

    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
    
    if(isset($_SESSION['user'])) {
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? ");
        $stmt->execute(array($_SESSION['user']));
        $user = $stmt->fetch();
        
        $stmt = $conn->prepare("SELECT * FROM items WHERE member_id = ? ");
        $stmt->execute(array($_SESSION['uid']));
        $countAds = $stmt->rowCount();
        
        
        $userid = $user['user_id'];
?>

<h1 class="text-center">My Profile</h1>

<div class="information-profile">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">My Information</div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li><i class="fa fa-unlock fa-fw"></i><span>Name</span>: <?php echo $user['user_name'] ?></li>
                    <li><i class="fa fa-envelope fa-fw"></i><span>Email</span>: <?php echo $user['email'] ?></li>
                    <li><i class="fa fa-user fa-fw"></i><span>Full Name</span>: <?php echo $user['full_name'] ?></li>
                    <li><i class="fa fa-calendar fa-fw"></i><span>Register Date</span>: <?php echo $user['reg_date'] ?></li>
                    <li><i class="fa fa-tags fa-fw"></i><span>Favourite Categories</span>: </li>
                    <li><i class="fa fa-tags fa-fw"></i><span>Number of Ads</span>: <?php echo $countAds ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="ads-profile">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">My Ads</div>
            <div class="panel-body">
                    <?php
                        $items = getAll("*", "items", "where member_id = $userid", "", "item_id");
                        if(!empty($items)) {
                            echo "<div class='row'>";
                            foreach($items as $item) {
                    ?>
                        <div class="col-xs-6 col-sm-3">
                            <div class="item-box thumbnail">
                                <div class="un-approve">
                                    <?php
                                        if($item['approve'] == 0) { 
                                            echo "<div class='review'>The ad is pending review</div>"; 
                                        }
                                    ?>
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
                    <?php 
                            }
                            echo "</div>";
                        } else
                            echo "Sorry, There's No Ads To Show. Create <a href='newad.php'>New Ad</a>";
                    ?>
            </div>
        </div>
    </div>
</div>

<div class="Comments-profile">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">My Comments</div>
            <div class="panel-body">
                <?php
                    $comments = getAll("*", "comments", "where user_id = $userid", "", "item_id");
            
                    if(!empty($comments)) {
                        foreach($comments as $comment) {
                            echo "<p>" . $comment['comment'] . "</p>";
                        }
                    } else {
                        echo "There's Are Not Found Comments";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php 
      } else { 
            header("location: login.php");
        }

    include $tmbl . 'footer.php';
?>