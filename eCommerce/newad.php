<?php 

    session_start();
    $pageTitle = 'New Ads';
    include 'init.php';
    if(isset($_SESSION['user'])) {
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $name         = $_POST['name'];
            $description  = $_POST['description'];
            $price        = '$' . $_POST['price'];
            $country_made = $_POST['country_made'];
            $status       = $_POST['status'];
            $category     = $_POST['category'];
            
            $formErrors = array();
            
            if(empty($name))
                $formErrors[] = 'Name Can\'t Be Empty';
            if(empty($description))
                $formErrors[] = 'Description Can\'t Be Empty';
            if(empty($price))
                $formErrors[] = 'Price Can\'t Be Empty';
            if(empty($country_made))
                $formErrors[] = 'Country Made Can\'t Be Empty';
            if(empty($status))
                $formErrors[] = 'Status Can\'t Be Empty';
            if(empty($category))
                $formErrors[] = 'Category Can\'t Be Empty';
            
            if(empty($formErrors)) {

                $stmt = $conn->prepare("INSERT INTO items(item_name, description, price, country_made, status, date, member_id,category_id) VALUES (:item_name, :description, :price, :country_made, :status, now(), :user_id, :cat_id)");
                $stmt->execute(array(
                                'item_name'    => $name,
                                'description'  => $description,
                                'price'        => $price,
                                'country_made' => $country_made,
                                'status'       => $status,
                                'user_id'      => $_SESSION['uid'],
                                'cat_id'       => $category
                ));
                
                if($stmt) {
                    $succ = "Ad Added Done";
                }
            }
            
        }
?>
    
<div class="container">
    <div class="row">
        <h1 class="text-center">Create New Item</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Create New Item
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Name</label>
                           <div class="col-sm-10">
                               <input type="text" class="form-control live" data-class=".live-name" name="name" placeholder="Name" autocomplete="off" required>
                           </div>
                       </div>
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Description</label>
                           <div class="col-sm-10">
                               <input type="text" class="form-control live" data-class=".live-description" name="description" placeholder="Description" autocomplete="off" required>
                           </div>
                       </div>
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Price</label>
                           <div class="col-sm-10">
                               <input type="number" class="form-control live" data-class=".live-price" name="price" placeholder="Price" autocomplete="off" required>
                           </div>
                       </div>
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Country Made</label>
                           <div class="col-sm-10">
                               <input type="text" class="form-control" name="country_made" placeholder="Country Made" autocomplete="off" required>
                           </div>
                       </div>
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Status</label>
                           <div class="col-sm-10">
                               <select name="status" class="form-control">
                                <option value="0"></option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Very Old</option>
                               </select>
                           </div>
                       </div>
                       <div class="form-group form-group-lg">
                           <label class="col-sm-2 control-label">Category</label>
                           <div class="col-sm-10">
                               <select name="category" class="form-control">
                                <option value="0">...</option>
                                   <?php
                                    $cats = getAll("*", "categories", "", "", "category_id");
                                    foreach($cats as $cat)
                                        echo "<option value='".$cat['category_id']."'>" . $cat['category_name']  . "</option>";
                                   ?>
                               </select>
                           </div>
                       </div>
                       <div class="form-group form-group-lg">
                           <div class="col-sm-10 col-sm-offset-2">
                               <input type="submit" class="form-control btn btn-primary" value="Add">
                           </div>
                       </div>
                   </form>
                </div>
                <div class="col-sm-4">
                    <div class="item-box thumbnail">
                        <div>
                            <img src="item.png" class="img-responsive" style="width:100%">
                        </div>
                        <div class="info">
                            <p class='price'>$<span class="live-price">0</span></p>
                            <h3 class="live-name">Title</h3>
                            <p class="live-description">Description</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="error-ad">
                        <?php
                            if(!empty($formErrors)) {
                                foreach($formErrors as $error) {
                                    echo "<div class='alert alert-danger'>" . $error . "</div>";
                                }
                            }
        
                            if(isset($succ)) {
                                echo "<div class='alert alert-success'>" . $succ . "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    } else {
        header("location: login.php");
        exit();
    }
     include $tmbl . 'footer.php';
                                  
?>