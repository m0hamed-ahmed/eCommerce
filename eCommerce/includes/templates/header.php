<!DOCTYPE html>
<html>
    <head>
        <meta charser="UTF-8">
        <title><?php getTitle() ?></title>
        <link rel="stylesheet" href="<?php echo $css ?>bootstrap.css">
        <link rel="stylesheet" href="<?php echo $css ?>font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $css ?>front.css">
    </head>
    <body>
        
        <div class="upper-bar">
            <div class="container">
                <?php
                    if (isset($_SESSION['user'])) {
                ?>

                <div class="dropdown pull-right">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="item.png" class="img-circle">
                        <?php echo $_SESSION['user'] ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="newad.php">Add Item</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </div>
                
                <?php
                    } else {
                ?>
                <a href="login.php">
                    <span class="pull-right">Login/Signup</span>
                </a>
                <?php } ?>
            </div>
        </div>
        
        <nav class="navbar navbar-inverse">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Home Page</a>
            </div>

            <div class="collapse navbar-collapse" id="app-nav">
              <ul class="nav navbar-nav navbar-right">
                <?php
                    $cats = getAll("*", "categories", "where parent = 0", "", "category_id", "ASC");
                    foreach($cats as $cat) {
                        echo "<li><a href='categories.php?catid=".$cat['category_id']."'>".$cat['category_name']."</a></li>";
                    }
                ?>
              </ul>
            </div>
          </div>
        </nav>