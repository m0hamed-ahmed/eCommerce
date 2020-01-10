<?php

    if(!isset($_SESSION['username'])) {

        header("location: login.php");

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $item_hidden  = $_POST['item_hidden'];
        $name         = $_POST['name'];
        $description  = $_POST['description'];
        $price        = $_POST['price'];
        $country_made = $_POST['country_made'];
        $status       = $_POST['status'];
        $members      = $_POST['members'];
        $category     = $_POST['category'];

        $errors   = array();

        if (empty($name))  

            $errors[] = 'Name Can\'t Be Empty';

        if (empty($description))

            $errors[] = 'Description Can\'t Be Empty';

        if (empty($price))

            $errors[] = 'Price Can\'t Be Empty';
        
        if (empty($country_made))

            $errors[] = 'Country Made Can\'t Be Empty';
        
        if ($status == 0)

            $errors[] = 'Status Can\'t Be Empty';
        
        if ($members == 0)

            $errors[] = 'Members Can\'t Be Empty';
        
        if ($category == 0)

            $errors[] = 'Category Can\'t Be Empty';
        
        echo "<h1 class='text-center'>Upadte Member</h1>";
        echo "<div class='container'>";
        echo "<div class='row'>";

        foreach($errors as $error)

            echo "<div class='alert alert-danger'>" . $error . "</div>";
        
        if(count($errors) > 0 ) {
            
            redirectHome ('', "items.php?do=edit&itemid=$item_hidden");
            
        }
            
        if (count($errors) == 0) {

            $stmt = $conn->prepare("UPDATE items SET item_name = ? , description = ? , price = ? , country_made = ?, status = ?, category_id = ?, member_id = ? WHERE item_id = ?");
            $stmt->execute(array($name, $description, $price, $country_made, $status, $category, $members, $item_hidden));

            $msg =  "<div class='alert alert-success'>". $stmt->rowCount() ." Row Updated</div>"; 
            
            redirectHome ($msg, "items.php", 1);
        }

    } else {

        $msg =  "<div class='alert alert-danger'>Sorry, You Cant Browse This Page Directly</div>";
            
        redirectHome ($msg, 'index.php', 1);
    }

?>
        
    </div>
</div>